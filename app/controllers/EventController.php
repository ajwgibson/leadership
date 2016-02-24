<?php

use Carbon\Carbon;

class EventController extends BaseController {


    public function index()
    {
        $this->layout->with('subtitle', '');

        $filtered = false;
        $include_closed = Session::get('events_filter_include_closed', '');

        if ($include_closed) {
            $filtered = true;
            $events = LeadershipEvent::orderBy('event_date', 'descending')->get();
        } else {
            $events = LeadershipEvent::where('closed', false)->orderBy('event_date', 'descending')->get();            
        }

        $this->layout->content = 
            View::make('events.index')
                ->with('events', $events)
                ->with('filtered', $filtered)
                ->with('filter_include_closed', $include_closed);
    }


    public function filter()
    {
        $filter_include_closed = Input::get('filter_include_closed');
        
        Session::put('events_filter_include_closed', $filter_include_closed);

        return Redirect::route('event.index');
    }

    
    public function resetFilter()
    {
        if (Session::has('events_filter_include_closed')) Session::forget('events_filter_include_closed');

        return Redirect::route('event.index');
    }


    public function create()
    {
        $event = new LeadershipEvent();

        $this->layout->with('subtitle', 'add a new event');

        $this->layout->content =
            View::make('events.create')
                    ->with('event', $event);
    }


    public function store()
    {
        $input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                LeadershipEvent::$rules,
                LeadershipEvent::$messages);

        if ($validator->passes())
        {
            $event = new LeadershipEvent();
            $event->event_date = Carbon::createFromFormat('d-m-Y', Input::get('event_date'));
            $event->description = Input::get('description');
            $event->save();

            return Redirect::route('event.index');
        }

        return Redirect::route('event.create')
            ->withInput()
            ->withErrors($validator);
    }


    public function show($id)
    {
        $event = LeadershipEvent::findOrFail($id);

        $this->layout->with('subtitle', 'event details');
        $this->layout->content = 
            View::make('events.show')
                    ->with('event', $event);
    }


    public function edit($id)
    {
        $event = LeadershipEvent::findOrFail($id);

        $this->layout->with('subtitle', 'change event details');
        $this->layout->content = 
            View::make('events.edit')
                    ->with('event', $event);
    }


    public function update($id)
    {
        $input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                LeadershipEvent::$rules,
                LeadershipEvent::$messages);

        if ($validator->passes()) {

            $event = LeadershipEvent::findOrFail($id);
            $event->event_date = Carbon::createFromFormat('d-m-Y', Input::get('event_date'));
            $event->description = Input::get('description');
            $event->save();

            return Redirect::route('event.show', $id);
        }

        return Redirect::route('event.edit', $id)
            ->withInput()
            ->withErrors($validator);
    }


    public function destroy($id)
    {
        LeadershipEvent::destroy($id);

        return Redirect::route('event.index');
    }

    public function close($id)
    {
        $event = LeadershipEvent::findOrFail($id);
        $event->closed = true;
        $event->save();
        return Redirect::route('event.show', $id)
                ->with('info', 'This event has been closed');
    }

    public function open($id)
    {
        $event = LeadershipEvent::findOrFail($id);
        $event->closed = false;
        $event->save();
        return Redirect::route('event.show', $id)
                ->with('info', 'This event has been reopened');
    }

}