<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\ovijog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function vumiseba()
    {
        $ovijogs = ovijog::with('user')->where('type', '1')->get();
        return view('admin.vumiseba', compact('ovijogs'));
    }
    public function status_change(Request $request, $id)
    {
        $data = ovijog::find($id);

        if ($data) {
            $data->status = $request->status;
            $data->save();

            return redirect()->back()->with('success', 'Status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Data not found.');
        }
    }

    public function vumiseba_delete($id)
    {
        $data = ovijog::find($id);

        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Data not found.');
        }
    }
    public function type_change(Request $request, $id)
    {
        $data = ovijog::find($id);

        if ($data) {
            $data->type = $request->type;
            $data->save();

            return redirect()->back()->with('success', 'Status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Data not found.');
        }
    }
    public function admin_notice()
    {
        return view('admin.notice_board');
    }
    public function notice_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);
        // Create a new notice instance and set values
        $notice = new Notice();
        $notice->title = $request->input('title');
        $notice->description = $request->input('description');
        $notice->date = $request->input('date');

        // Save to database
        $notice->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'নোটিশ সফলভাবে সংরক্ষণ করা হয়েছে!');
    }
    public function notice_show()
    {
         $notices = Notice::all();
        return view('admin.notice_show', compact('notices'));
    }
    public function notice_edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('admin.noticeedit', compact('notice'));
    }
    public function notice_update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|string',
        ]);

        $notice = Notice::findOrFail($id);
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->date = $request->date;
        $notice->save();

        return redirect()->route('notice.show')->with('success', 'নোটিশ সফলভাবে আপডেট করা হয়েছে!');
    }
     public function notice_destroy($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();
        return redirect()->route('notice.show')->with('success', 'নোটিশ সফলভাবে ডিলিট করা হয়েছে!');
    }
}
