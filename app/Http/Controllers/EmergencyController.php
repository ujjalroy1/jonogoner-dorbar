<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmergencyNotification;

class EmergencyController extends Controller
{
    public function create()
    {
        return view('emergency.create');
    }
    public function index()
    {
        $emergencies = Emergency::paginate(10);
        return view('emergency.index', compact('emergencies'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:ambulance,police,fire_service,other',
            'description' => 'required|string|max:1000',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx',
            'rating' => 'nullable|integer|between:1,5',
            'comment' => 'nullable|string|max:500',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $emergency = Emergency::create([
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'description' => $validated['description'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'attachment' => $attachmentPath,
            'rating' => $validated['rating'] ?? null,
            'comment' => $validated['comment'] ?? null,
        ]);

        Mail::to('dbabhijite@gmail.com')->send(new EmergencyNotification($emergency));
        return redirect()->back()->with('success', 'Emergency message sent successfully!');
    }
    public function updateStatus(Request $request, Emergency $emergency)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed',
        ]);

        $emergency->update(['status' => $request->status]);

        return redirect()->route('emergency.index')->with('success', 'Status updated successfully.');
    }

    public function destroy(Emergency $emergency)
    {
        if ($emergency->attachment) {
            Storage::disk('public')->delete($emergency->attachment);
        }

        $emergency->delete();

        return redirect()->route('emergency.index')->with('success', 'Emergency message deleted successfully.');
    }
}
