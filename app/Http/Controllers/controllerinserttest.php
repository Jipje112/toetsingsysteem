<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controllerinserttest extends Controller
{
    public function toetsmaken()
    {
        $tests = DB::table('testname')->get();
        return view('toetsmaken', compact('tests'));
    }

    public function store(Request $request)
    {
        DB::table('testname')->insert([
            'name' => $request->input('name'),
            'userID' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->route('toetsmaken');
    }

    public function update(Request $request, $id)
    {
        DB::table('testname')->where('id', $id)->update([
            'name' => $request->input('name'),
            'updated_at' => now()
        ]);
        return redirect()->route('toetsmaken');
    }

    public function delete($id)
    {
        DB::table('testname')->where('id', $id)->delete();
        return redirect()->route('toetsmaken');
    }
}
