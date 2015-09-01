<?php

use Carbon\Carbon;

class ActivityController extends BaseController {


    public function index($leadership_event_id)
    {
        $event = LeadershipEvent::find($leadership_event_id);

        $this->layout->with('subtitle', $event->name());

        $this->layout->content = 
            View::make('activities.index')
                ->with('event', $event);
    }


    public function create($leadership_event_id)
    {
        $event = LeadershipEvent::find($leadership_event_id);

        $activity = new Activity();

        $this->layout->with('subtitle', $event->name());

        $this->layout->content =
            View::make('activities.create')
                    ->with('event', $event)
                    ->with('activity', $activity);
    }


    public function store($leadership_event_id)
    {
        $event = LeadershipEvent::findOrFail($leadership_event_id);

        $input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                Activity::$rules,
                Activity::$messages);

        if ($validator->passes())
        {
            $activity = new Activity($input);
            $event->activities()->save($activity);

            return Redirect::route('activity.index', array($leadership_event_id));
        }

        return Redirect::route('activity.create', array($leadership_event_id))
            ->withInput()
            ->withErrors($validator);
    }


    public function show($leadership_event_id, $id)
    {
        $event = LeadershipEvent::find($leadership_event_id);

        $activity = Activity::findOrFail($id);

        $this->layout->with('subtitle', $event->name());

        $this->layout->content = 
            View::make('activities.show')
                    ->with('activity', $activity);
    }


    public function edit($leadership_event_id, $id)
    {
        $event = LeadershipEvent::find($leadership_event_id);

        $activity = Activity::findOrFail($id);

        $this->layout->with('subtitle', $event->name());
        
        $this->layout->content = 
            View::make('activities.edit')
                    ->with('activity', $activity);
    }


    public function update($leadership_event_id, $id)
    {
        $input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                Activity::$rules,
                Activity::$messages);

        if ($validator->passes()) {

            $activity = Activity::findOrFail($id);
            $activity->update($input);
            $activity->save();

            return Redirect::route('activity.show', array($leadership_event_id, $id));
        }

        return Redirect::route('activity.edit', array($leadership_event_id, $id))
            ->withInput()
            ->withErrors($validator);
    }


    public function destroy($leadership_event_id, $id)
    {
        Activity::destroy($id);

        return Redirect::route('activity.index', array($leadership_event_id));
    }


}