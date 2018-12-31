<?php

namespace App\Http\Controllers\Manager;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('updated_at' , 'DESC')->get();

        return view('Manager.Question.list' , compact('questions'));
    }

    public function store(Request $request)
    {
        $answer = new Answer();

        $answer->title = $request->title;
        $answer->description = $request->description;
        $answer->user_id = Auth::id();
        $answer->question_id = $request->question_id;

        $answer->save();
        
        return redirect()->back();
    }

    public function remove(Question $question)
    {
        $question->delete();
        $question->answers()->delete();
        return redirect()->back();
    }
}
