<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:user']], function () {
    Route::get('question', 'User\QuestionController@index')->name('questions');
    Route::post('save', 'User\QuestionController@store')->name('saveQuestion');
    Route::get('edit/{question}', 'User\QuestionController@edit')->name('editQuestion');
    Route::get('answersList/{question}', 'User\QuestionController@answersList')->name('answersList');
});


Route::group(['middleware' => ['role:admin']], function () {
    Route::get('questionList', 'Manager\AnswerController@index')->name('questionList');
    Route::post('saveAnswer', 'Manager\AnswerController@store')->name('saveAnswer');
    Route::get('removeQuestion/{question}', 'Manager\AnswerController@remove')->name('removeQuestion');
    Route::get('removeAnswer/{answer}', 'Manager\AnswerController@removeAnswer')->name('removeAnswer');
    Route::get('answers/{question}', 'Manager\AnswerController@show')->name('showAnswers');
});
