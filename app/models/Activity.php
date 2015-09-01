<?php

use Carbon\Carbon;

class Activity extends Eloquent 
{
    protected $softDelete = true; 

    protected $fillable = array('name', 'activity_date', 'description');

    public static $rules = array(
        'name'              => 'required|max:100',
        'activity_date'     => 'date',
    );

    public static $messages = array(
    );

    public function getDates()
    {
        $dates = parent::getDates();
        array_push($dates, 'created_at');
        array_push($dates, 'activity_date');
        return $dates;
    }

    public function leadership_event()
    {
        return $this->belongsTo('LeadershipEvent', 'leadership_event_id');
    }

}