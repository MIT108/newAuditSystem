<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function index(){
        $questions = Question::get();
        $user_departments = Department::where('user_id', auth()->user()->id)->get();

        return view('pages/question/index')->with('questions', $questions)->with('user_departments', $user_departments);
    }

    public function create(Request $request){
        $fields = $request->validate([
            'description' => 'required|String',
            'title' => 'Integer'
        ]);
        $message = '';
        $error = false;
        if (!isset($fields['title'])) {
            $fields += ['title' => 0];
        }
        try {
            Question::create($fields);
            $message = 'question created successfully';
        } catch (\Throwable $th) {
            $message= $th->getMessage();
            $error = true;
        }


        if ($error) {
            return redirect()->back()->with('error', $message);

        } else {
            return redirect()->back()->with('success', $message);
        }
    }
}
