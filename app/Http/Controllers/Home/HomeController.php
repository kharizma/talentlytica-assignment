<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $total_participant = User::where('role','participant')->count();

        return view('home.index',compact('total_participant'));
    }
}
