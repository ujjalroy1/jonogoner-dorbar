<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\Payment;
use App\Mail\TeamRegistrationMail;
use App\Mail\CustomMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class MessageController extends Controller
{
    public function showForm()
    {
        return view('showform');
    }
    public function sendMessage(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'message_file' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $messageFilePath = resource_path('views\\messages\\' . $request->message_file . '.blade.php');
        if (!File::exists($messageFilePath)) {
            return redirect()->back()->with('error', 'Message file not found.');
        }

        // dd($messageFilePath);

        $messageContent = File::get($messageFilePath);

        // Initialize recipient array
        $recipients = [];

        // Send email to team members if the checkbox is selected
        if ($request->has('team_members')) {
            $members = DB::table('teams')
                ->select('member1_email AS email')
                ->union(DB::table('teams')->select('member2_email AS email'))
                ->union(DB::table('teams')->select('member3_email AS email'))
                ->get();

            foreach ($members as $member) {
                $recipients[] = $member->email;
            }
        }


        if ($request->has('coach')) {
            $coaches = DB::table('teams')->select('coach_email AS email')->get();

            foreach ($coaches as $coach) {
                $recipients[] = $coach->email;
            }
        }
        // dd($recipients);
        foreach ($recipients as $recipient) {
            if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                Mail::to($recipient)->send(new CustomMessageMail($messageContent));
            }
        }

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
