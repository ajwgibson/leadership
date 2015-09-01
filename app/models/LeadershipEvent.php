<?php

use Carbon\Carbon;

class LeadershipEvent extends Eloquent 
{
    protected $softDelete = true; 

    protected $fillable = array('description', 'event_date');

    public static $rules = array(
        'event_date'     => 'required|date',
    );

    public static $messages = array(
    );

    public function getDates()
    {
        $dates = parent::getDates();
        array_push($dates, 'created_at');
        array_push($dates, 'event_date');
        return $dates;
    }

    public function bookings()
    {
        return $this->hasMany('Booking');
    }

    public function activities()
    {
        return $this->hasMany('Activity');
    }

    public function name()
    {
        return $this->event_date->format('jS F Y');
    }

    public function expected()
    {
        return $this->bookings()->count();
    }

    public function registered()
    {
        return $this->bookings()->registered()->count();
    }

}