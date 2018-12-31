<?php

namespace App\Http\Controllers\User;


use App\Answer;
use App\Image;
use App\Question;
use App\Services\UploadService;
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
        $questions = Question::with('user' , 'answers' , 'image')->where('user_id' , Auth::id())->orderBy('updated_at' , 'DESC')->get();

        return view('User.Question.index' , compact('questions'));
    }

    public function store(Request $request)
    {
        if(isset($request->question_id) and $request->question_id != ''){
            $question = Question::where('id' , $request->question_id)->first();
        }else{
            $question = new Question();
        }

        $image = '';
        if ($request->hasFile('image')) {

            $image = UploadService::upload($request->file('image') , 'question');

        }

        $question->title = $request->title;
        $question->description = $request->description;
        $question->image_id = (isset($image) and $image != '')? $image['id'] : null;
        $question->user_id = Auth::id();

        $question->save();

        return redirect()->back();
    }

    public function edit(Question $question)
    {
        $questions = Question::with('user' , 'answers' , 'image')->where('user_id' , Auth::id())->orderBy('updated_at' , 'DESC')->get();

        return view('User.Question.index' , compact('question' , 'questions'));
    }

    public function answersList(Question $question)
    {
        $answers = Answer::with('user' , 'image')->where('question_id' , $question['id'])->orderBy('updated_at' , 'DESC')->get();

        return view('Manager.Question.answers' , compact('answers'));
    }
}
