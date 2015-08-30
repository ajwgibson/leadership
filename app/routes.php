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
    });

});