<?php

namespace App\Http\Controllers\User;


use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware(['role:user']);
    }
    
    public function index()
    {
        $questions = Question::with('user' , 'answers')->orderBy('updated_at' , 'DESC')->get();

        return view('User.Question.index' , compact('questions'));
    }

    public function store(Request $request)
    {
        if(isset($request->question_id) and $request->question_id != ''){
            $question = Question::where('id' , $request->question_id)->first();
        }else{
            $question = new Question();
        }

        $question->title = $request->title;
        $question->description = $request->description;
        $question->user_id = Auth::id();

        $question->save();

        return redirect()->back();
    }

    public function edit(Question $question)
    {
        $questions = Question::with('user' , 'answers')->orderBy('updated_at' , 'DESC')->get();

        return view('User.Question.index' , compact('question' , 'questions'));
    }
}
