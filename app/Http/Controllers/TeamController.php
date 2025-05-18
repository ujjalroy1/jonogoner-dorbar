<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Mail\TeamStatusMail;
use Illuminate\Support\Facades\Mail;



class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    public function show($id)
    {
        $team = Team::findOrFail($id);
        return view('teams.show', compact('team'));
    }


    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $oldApprove = $team->approve;
        $oldPayment = $team->payment;

        $team->approve = $request->has('approve') ? 1 : 0;
        $team->payment = $request->has('payment') ? 1 : 0;

        $emails = [$team->coach_email, $team->member1_email, $team->member2_email, $team->member3_email];
        $emails = array_filter($emails);

        if ($oldApprove == 0 && $team->approve == 1) {
            foreach ($emails as $email) {
                Mail::to($email)->send(new TeamStatusMail($team, 'approve'));
            }
        }


        if ($oldPayment == 0 && $team->payment == 1) {
            // dd($emails);
            foreach ($emails as $email) {
                Mail::to($email)->send(new TeamStatusMail($team, 'payment'));
            }
        }
        $team->save();

        return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
    }
    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->back()->with('success', 'Team deleted successfully.');
    }
}
