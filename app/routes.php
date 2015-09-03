<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'auth.basic'), function()
{
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

    Route::resource('event', 'EventController');

    Route::group(array('prefix' => 'event/{leadership_event_id}'), function()
    {
        Route::get ('booking',                array('as'=>'booking.index',  'uses'=>'BookingController@index'));
        Route::get ('booking/create',         array('as'=>'booking.create', 'uses'=>'BookingController@create'));
        Route::post('booking',                array('as'=>'booking.store',  'uses'=>'BookingController@store'));
        Route::get ('booking/show/{booking}', array('as'=>'booking.show',   'uses'=>'BookingController@show'));
        Route::get ('booking/edit/{booking}', array('as'=>'booking.edit',   'uses'=>'BookingController@edit'));
        Route::put ('booking/{booking}',      array('as'=>'booking.update', 'uses'=>'BookingController@update'));
        Route::delete('booking/{booking}',    array('as'=>'booking.destroy','uses'=>'BookingController@destroy'));
        Route::put ('booking/register/{booking}',      array('as'=>'booking.register',   'uses'=>'BookingController@register'));
        Route::put ('booking/unregister/{booking}',    array('as'=>'booking.unregister', 'uses'=>'BookingController@unregister'));

        Route::get ('registration',           array('as'=>'registration',        'uses'=>'RegistrationController@index'));
        Route::post('registration',           array('as'=>'registration.search', 'uses'=>'RegistrationController@search'));
        Route::post('register/{booking}',     array('as'=>'register',            'uses'=>'RegistrationController@register'));

        Route::get ('activity',                array('as'=>'activity.index',  'uses'=>'ActivityController@index'));
        Route::get ('activity/create',         array('as'=>'activity.create', 'uses'=>'ActivityController@create'));
        Route::post('activity',                array('as'=>'activity.store',  'uses'=>'ActivityController@store'));
        Route::get ('activity/show/{activity}', array('as'=>'activity.show',   'uses'=>'ActivityController@show'));
        Route::get ('activity/edit/{activity}', array('as'=>'activity.edit',   'uses'=>'ActivityController@edit'));
        Route::put ('activity/{activity}',      array('as'=>'activity.update', 'uses'=>'ActivityController@update'));
        Route::delete('activity/{activity}',    array('as'=>'activity.destroy','uses'=>'ActivityController@destroy'));

        Route::group(array('prefix' => 'activity/{activity}'), function()
        {
            Route::get ('signup',             array('as'=>'signup',        'uses'=>'SignupController@index'));
            Route::post('signup',             array('as'=>'signup.search', 'uses'=>'SignupController@search'));
            Route::post('signup/{booking}',   array('as'=>'signup.do',     'uses'=>'SignupController@signup'));
            Route::get('signup/clear/{booking}', array('as'=>'signup.clear',  'uses'=>'SignupController@clear'));
        });
    });

});
