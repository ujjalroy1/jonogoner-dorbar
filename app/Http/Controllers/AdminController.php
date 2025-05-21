<?php

namespace App\Http\Controllers;

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
}
