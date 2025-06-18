<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function databasetestconnection()
    {
        $students = DB::table('students')->get();

        // 📦 Send the students to your view (e.g., 'dashboard.blade.php')
        return view('dashboard', compact('students'));
    }
}
