<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerQuestions extends Controller
{
    public function toetsmaken(Request $request)
    {
        $tests     = DB::table('testname')->get();
        $questions = DB::table('questions')
            ->when($request->filter, fn($q) => $q->where('testnameID', $request->filter))
            ->get();

        return view('toetsmaken', compact('tests', 'questions'));
    }

    // --- Tests CRUD ---
    public function storeTest(Request $r)
    {
        $r->validate(['name' => 'required|string']);
        DB::table('testname')->insert([
            'name'       => $r->name,
            'created_at' => now(), 'updated_at' => now()
        ]);
        return redirect()->route('toetsmaken');
    }

    public function updateTest(Request $r, $id)
    {
        $r->validate(['name' => 'required|string']);
        DB::table('testname')->where('id', $id)->update([
            'name'       => $r->name,
            'updated_at' => now()
        ]);
        return redirect()->route('toetsmaken');
    }

    public function deleteTest($id)
    {
        DB::table('testname')->where('id', $id)->delete();
        return redirect()->route('toetsmaken');
    }

    // --- Questions CRUD ---
    public function storeQuestion(Request $r)
    {
        $r->validate([
            'question'   => 'required|string',
            'testnameID' => 'required|exists:testname,id'
        ]);
        DB::table('questions')->insert([
            'question'       => $r->question,
            'testnameID'     => $r->testnameID,
            'correct_answer' => $r->has('correct_answer') ? 1 : 0,
            'created_at'     => now(), 'updated_at' => now()
        ]);
        return redirect()->route('toetsmaken');
    }

    public function updateQuestion(Request $r, $id)
    {
        $r->validate([
            'question'   => 'required|string',
            'testnameID' => 'required|exists:testname,id'
        ]);
        DB::table('questions')->where('id', $id)->update([
            'question'       => $r->question,
            'testnameID'     => $r->testnameID,
            'correct_answer' => $r->has('correct_answer') ? 1 : 0,
            'updated_at'     => now()
        ]);
        return redirect()->route('toetsmaken');
    }

    public function deleteQuestion($id)
    {
        DB::table('questions')->where('id', $id)->delete();
        return redirect()->route('toetsmaken');
    }
}
