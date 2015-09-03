<?php

class Booking extends Eloquent 
{
    protected $softDelete = true; 

    protected $fillable = array('first', 'last', 'church', 'role', 'email', 'contact_number', 'notes');

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

    public function getDates()
    {
        $dates = parent::getDates();
        array_push($dates, 'created_at');
        array_push($dates, 'registration_date');
        return $dates;
    }

    public function leadership_event()
    {
        return $this->belongsTo('LeadershipEvent', 'leadership_event_id');
    }

    public function scopeRegistered($query)
    {
        return $query->whereNotNull('registration_date');
    }

    public function name()
    {
        return $this->first . ' ' . $this->last;
    }

    public function is_registered()
    {
        return isset($this->registration_date);
    }

    public function activities()
    {
        return $this->belongsToMany('Activity', 'signups');
    }

    public function isSignedUpForActivity($activity_id)
    {
        return $this->activities()->where('activities.id', $activity_id)->count();
    }
}