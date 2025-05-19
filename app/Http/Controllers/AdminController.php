<?php

namespace App\Http\Controllers;

use App\Models\ovijog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function vumiseba()
    {
        $ovijogs=$ovijogs = ovijog::with('user')->where('type', '1')->get();;
        return view('admin.vumiseba',compact('ovijogs'));
    }
}
