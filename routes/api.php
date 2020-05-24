<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/candidates', 'CandidatesController');
Route::resource('/technologies', 'TechnologyStackController');
Route::resource('/positions', 'PositionsController');


Route::group(['middleware' => 'auth:airlock'], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/my/interviews/', 'MyScheduledInterviewsController@index');

    Route::get('/interviews/{interview}/conduct', 'InterviewConductController@index');
    Route::put('/interviews/{interview}/mark', 'InterviewsMarkController@update');
    Route::delete('/interviews/{interview}/mark', 'InterviewsMarkController@destroy');
    Route::post('/interviews/{interview}/answer', 'InterviewAnswersController@store');

    Route::post('/test', function() {
        return response()->json(['message' => 'Hello World from laravel']);
    });
});
