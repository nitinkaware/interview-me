<?php

Auth::routes();

// Api Routes.
Route::namespace('API')->prefix('api/v1')->name('api.')->group(function () {
    Route::post('/my/interviews/', 'MyScheduledInterviewsController@index')->name('my.interviews.index');
    Route::get('/my/interviews/{interview}', 'InterviewConductController@index')->name('my.interviews.conduct.index');
    Route::post('/my/interviews/{interview}/questions/{question}', 'InterviewConductController@store')->name('my.interviews.conduct.store');
});

Route::get('/test', function() {
    info("Hell");
});
Route::get('/{view?}', 'HomeController@index')->where('view', '(.*)')->name('home');

