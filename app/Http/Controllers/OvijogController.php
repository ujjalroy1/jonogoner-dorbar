<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Ovijog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OvijogController extends Controller
{
    // Display all complaints
    public function index()
    {
        $ovijogs = Ovijog::where('user_id', Auth::user()->id)->get();
        // dd($ovijogs);
        return view('home.complaints', compact('ovijogs'));
    }
    public function tracking()
    {
        $ovijogs = Ovijog::where('user_id', Auth::user()->id)->get();
        return view('home.complaints_tracking', compact('ovijogs'));
    }

    // Store a new complaint
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'attachment.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $storedFiles = [];

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $path = $file->store('attachments', 'public');
                $storedFiles[] = [
                    'path' => $path,
                    'original' => $file->getClientOriginalName(),
                ];
            }
        }

        Ovijog::create([
            'user_id' => Auth::user()->id,
            'type' => $request->type,
            'address' => $request->address,
            'description' => $request->description,
            'attachment' => json_encode($storedFiles),
            'hide' => $request->has('hide') ? 1 : 0,
            'status' => "pending",
            'feedback' => 0,
            'comment' => "",
        ]);

        return redirect()->route('ovijogs.index')->with('success', 'Complaint registered successfully.');
    }
    // Delete a complaint
    public function destroy($id)
    {
        $ovijog = Ovijog::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $ovijog->delete();

        return redirect()->route('complaints.tracking')->with('success', 'Complaint deleted.');
    }
    public function updateFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $ovijog = Ovijog::findOrFail($id);
        $ovijog->feedback = $request->feedback;
        $ovijog->comment = $request->comment;
        $ovijog->save();

        return back()->with('success', 'Feedback submitted successfully.');
    }


    public function all_ovijogs($id)
    {
        if ($id == 1) {
            $data = ovijog::with('user')->get();

            return view('home.sobovijog', compact('data'));
        } else if ($id == 2) {

            $data = ovijog::with('user')->where('status', 'solved')->get();

            return view('home.sobovijog', compact('data'));
        } else if ($id == 3) {

            $data = ovijog::with('user')->where('status', 'processing')->get();

            return view('home.sobovijog', compact('data'));
        } else {
            $data = ovijog::with('user')->onlyTrashed()->get();

            return view('home.sobovijog', compact('data'));
        }
    }
    public function all_notice()
    {
        $notices=Notice::all();
        return view('home.all_notice',compact('notices'));
    }
}
