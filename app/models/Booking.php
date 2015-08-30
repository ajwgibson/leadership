<?php

class Booking extends Eloquent 
{
    protected $softDelete = true; 

    protected $fillable = array('first', 'last', 'church', 'role', 'email', 'contact_number');

    public static $rules = array(
        'first'          => 'required|max:100',
        'last'           => 'required|max:100',
        'church'         => 'max:100',
        'role'           => 'max:100',
        'email'          => 'max:100',
        'contact_number' => 'max:100',
    );

    public static $messages = array(
        'first.required'    => "The first name field is required.",
        'first.max'         => "The first name may not be longer than :max characters.",
        'last.required'     => "The last name field is required.",
        'last.max'          => "The last name may not be longer than :max characters.",
    );

    public function leadership_event()
    {
        return $this->belongsTo('LeadershipEvent', 'leadership_event_id');
    }
}