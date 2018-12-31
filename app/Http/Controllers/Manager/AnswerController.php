<?php

namespace App\Http\Controllers\Manager;

use App\Answer;
use App\Image;
use App\Question;
use App\Services\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function index()
    {
        $questions = Question::with('image')->orderBy('updated_at' , 'DESC')->get();

//        return $questions;
        return view('Manager.Question.list' , compact('questions'));
    }

    public function store(Request $request)
    {
        $image = '';
        if ($request->hasFile('image')) {
            if ($request->hasFile('image')) {

                $image = UploadService::upload($request->file('image') , 'answer');

            }
        }

        $answer = new Answer();

        $answer->title = $request->title;
        $answer->description = $request->description;
        $answer->user_id = Auth::id();
        $answer->image_id = (isset($image) and $image != '')? $image['id'] : null;
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

    public function removeAnswer(Answer $answer)
    {
        $answer->delete();
        return redirect()->back();
    }

    public function show(Question $question)
    {
        $answers = Answer::with('user' , 'image')->where('question_id' , $question['id'])->orderBy('updated_at' , 'DESC')->get();
//        return $answers;
        return view('Manager.Question.answers' , compact('answers'));
    }
}
