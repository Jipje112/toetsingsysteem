<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function databasetestconnection()
    {
        $users = DB::table('users')->get(); // Fetch all users from SQLite or MySQL

        return view('databasetestconnection', compact('users'));
    }
}
