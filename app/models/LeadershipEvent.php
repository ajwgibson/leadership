<?php

use Carbon\Carbon;

class LeadershipEvent extends Eloquent 
{
    protected $softDelete = true; 

    protected $fillable = array('name', 'description', 'start_date', 'end_date', 'notes');

    public static $rules = array(
        'name'           => 'required|max:100',
        'start_date'     => 'required|date',
    );

    public static $messages = array(
        'name.required'    => "The event name field is required.",
        'name.max'         => "The event name may not be longer than :max characters.",
    );

    public function getDates()
    {
        $dates = parent::getDates();
        array_push($dates, 'created_at');
        array_push($dates, 'start_date');
        array_push($dates, 'end_date');
        return $dates;
    }

    public function bookings()
    {
        return $this->hasMany('Booking');
    }

}