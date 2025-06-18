<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Show dashboard with list of students
    public function showDashboard()
    {
        $students = DB::table('students')->get();
        return view('dashboard', compact('students'));
    }

    // Store a new student into the database
    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
        ]);

        DB::table('students')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('students.dashboard')->with('success', 'Student created!');
    }
}
