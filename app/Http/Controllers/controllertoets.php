<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controllertoets extends Controller
{
    // Shared GET: View page with tests and optionally questions
    public function toetsmaken(Request $request)
    {
        $tests = DB::table('testname')->get();

        $questions = DB::table('questions')
            ->when($request->filter, fn($q) => $q->where('testnameID', $request->filter))
            ->get();

        return view('toetsmaken', compact('tests', 'questions'));
    }

    // 🟢 TEST CRUD

    public function storeTest(Request $request)
    {
        DB::table('testname')->insert([
            'name' => $request->input('name'),
            'userID' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->route('toetsmaken');
    }

    public function updateTest(Request $request, $id)
    {
        DB::table('testname')->where('id', $id)->update([
            'name' => $request->input('name'),
            'updated_at' => now()
        ]);
        return redirect()->route('toetsmaken');
    }

    public function deleteTest($id)
    {
        DB::table('testname')->where('id', $id)->delete();
        return redirect()->route('toetsmaken');
    }

    // 🟡 QUESTION CRUD

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'testnameID' => 'required|exists:testname,id',
        ]);

        DB::table('questions')->insert([
            'question' => $request->question,
            'testnameID' => $request->testnameID,
            'correct_answer' => $request->correct_answer,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('toetsmaken');
    }

    public function updateQuestion(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'testnameID' => 'required|exists:testname,id',
        ]);

        DB::table('questions')->where('id', $id)->update([
            'question' => $request->question,
            'testnameID' => $request->testnameID,
            'correct_answer' => $request->correct_answer,
            'updated_at' => now(),
        ]);

        return redirect()->route('toetsmaken');
    }

    public function deleteQuestion($id)
    {
        DB::table('questions')->where('id', $id)->delete();
        return redirect()->route('toetsmaken');
    }
    // In Controllertoets.php
  public function showStudentPage()
    {
        $tests = DB::table('testname')->get(); // or however your tests are stored
        return view('student', compact('tests'));
    }

}

