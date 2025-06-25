<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controllerquestions extends Controller
{
    public function toetsmaken(Request $request)
    {
        $tests = DB::table('testname')->get();

        $questions = DB::table('questions')
            ->when($request->filter, function ($query, $filter) {
                return $query->where('testnameID', $filter);
            })
            ->get();

        return view('toetsmaken', compact('tests', 'questions'));
    }

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'testnameID' => 'required|exists:testname,id',
        ]);

        DB::table('questions')->insert([
            'question' => $request->question,
            'testnameID' => $request->testnameID,
            'correct_answer' => $request->has('correct_answer') ? 1 : 0,
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

        DB::table('questions')
            ->where('id', $id)
            ->update([
                'question' => $request->question,
                'testnameID' => $request->testnameID,
                'correct_answer' => $request->has('correct_answer') ? 1 : 0,
                'updated_at' => now(),
            ]);

        return redirect()->route('toetsmaken');
    }

    public function deleteQuestion($id)
    {
        DB::table('questions')->where('id', $id)->delete();
        return redirect()->route('toetsmaken');
    }
}
