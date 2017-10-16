<?php
/**
 * Created by PhpStorm.
 * User: eliberio
 * Date: 24/10/16
 * Time: 11:18 AM
 */


Route::namespace('Surveys')->group(function () {
Route::group(['prefix' =>'surveys', 'as'=>'surveys.'],function(){
    Route::pattern('categories_survey', '[0-9]+');
    Route::resource('categories_surveys','CategorySurveyController',['except' => [ 'create','destroy','show']]);
    Route::get('categories_surveys/datatables','CategorySurveyController@datatables')->name('category.datatable');

    Route::pattern('categories_question', '[0-9]+');
    Route::resource('categories_questions','CategoryQuestionController',['except' => [ 'create','destroy','show']]);
    Route::get('categories_questions/datatables','CategoryQuestionController@datatables')->name('categories_questions.datatable');

    Route::pattern('types_question', '[0-9]+');
    Route::resource('types_questions','TypeQuestionController',['except' => [ 'create','destroy','show']]);
    Route::get('types_questions/datatables','TypeQuestionController@datatables')->name('types_questions.datatable');

    Route::pattern('question', '[0-9]+');
    Route::resource('questions','QuestionController',['except' => [ 'create','destroy']]);
    Route::get('questions/datatables','QuestionController@datatables');


    Route::pattern('admin_survey', '[0-9]+');
    Route::resource('admin_surveys','SurveyController',['except' => [ 'create','destroy']]);
    Route::get('admin_surveys/datatables','SurveyController@datatables');
    Route::get('admin_surveys/questions/{id}','SurveyController@questions')->name('admin_surveys.questions');
    Route::get('admin_surveys/questionsdt/{survey_id}','SurveyController@questionsdt');
    Route::post('admin_surveys/assigment_question','SurveyController@assigmentQuestion');


    Route::get('report_global','ReportSurveyController@index')->name('report_global');
    Route::post('report_global','ReportSurveyController@getProcessReport')->name('report_global.process');

    Route::get('response_survey/{survey_name?}','ResponseSurveyController@index')->name('response_survey.index');
    Route::get('response_survey/{survey}/accept','ResponseSurveyController@indexSurvey')->name('response_survey.accept');
    Route::post('response_survey/question/{surveyQuestion}','ResponseSurveyController@responseSurveyQuestion')->name('response_survey.question');

});
});

