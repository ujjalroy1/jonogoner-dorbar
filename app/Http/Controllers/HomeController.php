<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Payment;
use App\Mail\TeamRegistrationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }
    public function home()
    {
        return view('home.index');
    }
    public function registration()
    {
        return view('reg.reg_form');
    }
    /////registration


    public function registration_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'institution' => 'required|string|max:255',
            'team_name' => 'required|string|max:255|unique:teams,team_name',

            'member1_name' => 'required|string|max:255',
            'member1_id' => 'required|string|unique:teams,member1_id',
            'member1_email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('teams')
                        ->where('member1_email', $value)
                        ->orWhere('member2_email', $value)
                        ->orWhere('member3_email', $value)
                        ->exists();

                    if ($exists) {
                        $fail('This email is already registered in another team.');
                    }
                }
            ],
            'member1_phone' => 'required|string|max:15',
            'member1_tshirt_size' => 'required|string',

            'member2_id' => 'nullable|string|unique:teams,member2_id',
            'member2_email' => [
                'nullable',
                'email',
                function ($attribute, $value, $fail) use ($request) {
                    if (!empty($value)) {
                        // Check uniqueness across teams
                        $exists = DB::table('teams')
                            ->where('member1_email', $value)
                            ->orWhere('member2_email', $value)
                            ->orWhere('member3_email', $value)
                            ->exists();

                        if ($exists) {
                            $fail('This email is already registered in another team.');
                        }

                        // Ensure member2 email is different from member1 email
                        if ($value === $request->member1_email) {
                            $fail('Member 2 email must be different from Member 1 email.');
                        }
                    }
                }
            ],
            'member2_tshirt_size' => 'nullable|string',

            'member3_id' => 'nullable|string|unique:teams,member3_id',
            'member3_email' => [
                'nullable',
                'email',
                function ($attribute, $value, $fail) use ($request) {
                    if (!empty($value)) {
                        // Check uniqueness across teams
                        $exists = DB::table('teams')
                            ->where('member1_email', $value)
                            ->orWhere('member2_email', $value)
                            ->orWhere('member3_email', $value)
                            ->exists();

                        if ($exists) {
                            $fail('This email is already registered in another team.');
                        }

                        // Ensure member3 email is different from member1 and member2 emails
                        if ($value === $request->member1_email) {
                            $fail('Member 3 email must be different from Member 1 email.');
                        }
                        if (!empty($request->member2_email) && $value === $request->member2_email) {
                            $fail('Member 3 email must be different from Member 2 email.');
                        }
                    }
                }
            ],
            'member3_tshirt_size' => 'nullable|string',

            'coach_name' => 'required|string|max:255',
            'coach_email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($request) {
                    // Ensure coach email is different from all member emails
                    if (
                        $value === $request->member1_email ||
                        (!empty($request->member2_email) && $value === $request->member2_email) ||
                        (!empty($request->member3_email) && $value === $request->member3_email)
                    ) {
                        $fail('Coach email must be different from all member emails.');
                    }
                }
            ],
            'coach_phone' => 'required|string|max:15',
            'coach_tshirt_size' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save the team
        $team = Team::create($request->all());

        // Collect email recipients
        $emails = [$team->coach_email, $team->member1_email];
        if (!empty($team->member2_email)) $emails[] = $team->member2_email;
        if (!empty($team->member3_email)) $emails[] = $team->member3_email;

        $emails[] = "dbabhijite@gmail.com";
        $emails[] = "ujjalroy1011@gmail.com";
        foreach ($emails as $email) {
            Mail::to($email)->send(new TeamRegistrationMail($team));
        }

        return redirect()->back()->with('success', 'Team Registered Successfully');
    }

    public function registration_list()
    {
        $teams = Team::where('approve', 1)->get();

        return view('reg.list', compact('teams'));
    }
    public function approve_list()
    {
        $teams = Team::where('approve', 1)->get();

        return view('reg.alist', compact('teams'));
    }
    ///////payment
    public function payment_create()
    {
        $approvedTeams = Team::where('approve', 1)->pluck('team_name', 'id'); // Fetch approved teams
        return view('reg.payment_create', compact('approvedTeams'));
    }

    public function payment_save(Request $request)
    {
        // $request->validate([
        //     'team_id' => 'required|exists:teams,id',
        //     'payment_from' => 'required|string|max:255',
        //     'payment_to' => 'required|string|max:255',
        //     'transaction_id' => 'required|string|max:255|unique:payments'
        // ]);

        $team = Team::findOrFail($request->team_id);

        Payment::create([
            'team_name' => $team->team_name,
            'payment_from' => $request->payment_from,
            'payment_to' => $request->payment_to,
            'transaction_id' => $request->transaction_id,
            'approved' => 0 // Default is 0 (pending)
        ]);

        return redirect()->back()->with('success', 'Payment information submitted successfully!');
    }
    public function complaint()
    {
        return view('home.complaints');
    }
    public function gellary()
    {
        return view('home.gellary');
    }
    public function contact()
    {
        return view('home.contact');
    }

    public function project_showcase()
    {
        $startDate = Carbon::create(2025, 3, 5, 0, 0, 0, config('app.timezone'));
        $endDate = Carbon::create(2025, 3, 10, 23, 59, 59, config('app.timezone'));
        $currentTime = now();

        $registrationStatus = 'closed';

        if ($currentTime->lessThan($startDate)) {
            $registrationStatus = 'pending';
        } elseif ($currentTime->between($startDate, $endDate)) {
            $registrationStatus = 'open';
        }

        return view('reg.project_showcase', compact('registrationStatus', 'startDate', 'endDate'));
    }

    public function gaming_contest()
    {

        $startDate = Carbon::create(2025, 3, 3, 0, 0, 0, config('app.timezone'));
        $endDate = Carbon::create(2025, 3, 10, 23, 59, 59, config('app.timezone'));
        $currentTime = now();


        $registrationStatus = 'closed';

        if ($currentTime->lessThan($startDate)) {
            $registrationStatus = 'pending';
        } elseif ($currentTime->between($startDate, $endDate)) {
            $registrationStatus = 'open';
        }

        // Pass Carbon instances to the view
        return view('reg.gaming_contest', compact('registrationStatus', 'startDate', 'endDate'));
    }
    public function poster_presentation()
    {

        $startDate = Carbon::create(2025, 3, 3, 0, 0, 0, config('app.timezone'));
        $endDate = Carbon::create(2025, 3, 10, 23, 59, 59, config('app.timezone'));
        $currentTime = now();


        $registrationStatus = 'closed';

        if ($currentTime->lessThan($startDate)) {
            $registrationStatus = 'pending';
        } elseif ($currentTime->between($startDate, $endDate)) {
            $registrationStatus = 'open';
        }

        // Pass Carbon instances to the view
        return view('reg.poster_presentation', compact('registrationStatus', 'startDate', 'endDate'));
    }
    public function itquiz()
    {
        $startDate = Carbon::create(2025, 3, 3, 0, 0, 0, config('app.timezone'));
        $endDate = Carbon::create(2025, 3, 10, 23, 59, 59, config('app.timezone'));
        $currentTime = now();


        $registrationStatus = 'closed';

        if ($currentTime->lessThan($startDate)) {
            $registrationStatus = 'pending';
        } elseif ($currentTime->between($startDate, $endDate)) {
            $registrationStatus = 'open';
        }

        // Pass Carbon instances to the view
        return view('reg.itquiz', compact('registrationStatus', 'startDate', 'endDate'));
    }
    public function main_registration()
    {
        return view('reg.main_registration');
    }
}
