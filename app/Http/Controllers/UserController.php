<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $notices=Notice::all();

        return view('home.userindex',compact('notices'));
    }
}
