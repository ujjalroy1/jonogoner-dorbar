<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Payment;
use App\Mail\TeamRegistrationMail;

use App\Mail\TeamStatusMail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function viewPayments()
    {
        $payments = Payment::all(); // Fetch all payments
        return view('teams.paymentslist', compact('payments'));
    }

    public function approvePayment(Request $request, $id)
    {
        $team = Payment::findOrFail($id);
        $teamName = $team->team_name;

        $teamRecords = Team::where('team_name', $teamName)->get();

        $emails = [];
        foreach ($teamRecords as $record) {
            $emails = array_merge($emails, array_filter([
                $record->coach_email,
                $record->member1_email,
                $record->member2_email,
                $record->member3_email
            ]));
        }

        $emails = array_unique($emails);

        foreach ($emails as $email) {
            Mail::to($email)->send(new TeamStatusMail($team, 'payment'));
        }
        foreach ($teamRecords as $record) {
            $record->payment = 1; // Update payment status
            $record->save(); // Save each record individually
        }
        $team->approved = 1;
        $team->save();

        return redirect()->route('teams_payments')->with('success', 'Team and Payment updated successfully!');
    }

    public function deletePayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('teams_payments')->with('success', 'Payment record deleted.');
    }
}
