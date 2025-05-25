<?php

namespace App\Http\Controllers;

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
            'status' => 0,
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

        return redirect()->route('ovijogs.index')->with('success', 'Complaint deleted.');
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
}
