<?php


class BookingController extends BaseController {


    public function index($leadership_event_id)
    {
        $event = LeadershipEvent::find($leadership_event_id);

        $this->layout->with('subtitle', $event->name());

        $this->layout->content = 
            View::make('bookings.index')
                ->with('event', $event);
    }


    public function create($leadership_event_id)
    {
        $event = LeadershipEvent::find($leadership_event_id);

        $booking = new Booking();

        $this->layout->with('subtitle', $event->name());

        $this->layout->content =
            View::make('bookings.create')
                    ->with('event', $event)
                    ->with('booking', $booking);
    }


    public function store($leadership_event_id)
    {
        $event = LeadershipEvent::findOrFail($leadership_event_id);

        $input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                Booking::$rules,
                Booking::$messages);

        if ($validator->passes())
        {
            $booking = new Booking($input);
            $event->bookings()->save($booking);

            return Redirect::route('booking.index', array($leadership_event_id));
        }

        return Redirect::route('booking.create', array($leadership_event_id))
            ->withInput()
            ->withErrors($validator);
    }


    public function show($leadership_event_id, $id)
    {
        $event = LeadershipEvent::find($leadership_event_id);

        $booking = Booking::findOrFail($id);

        $this->layout->with('subtitle', $event->name());

        $this->layout->content = 
            View::make('bookings.show')
                    ->with('booking', $booking);
    }


    public function edit($leadership_event_id, $id)
    {
        $event = LeadershipEvent::find($leadership_event_id);

        $booking = Booking::findOrFail($id);

        $this->layout->with('subtitle', $event->name());
        
        $this->layout->content = 
            View::make('bookings.edit')
                    ->with('booking', $booking);
    }


    public function update($leadership_event_id, $id)
    {
        $input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                Booking::$rules,
                Booking::$messages);

        if ($validator->passes()) {

            $booking = Booking::findOrFail($id);
            $booking->update($input);
            $booking->save();

            return Redirect::route('booking.show', array($leadership_event_id, $id));
        }

        return Redirect::route('booking.edit', array($leadership_event_id, $id))
            ->withInput()
            ->withErrors($validator);
    }


    public function destroy($leadership_event_id, $id)
    {
        Booking::destroy($id);

        return Redirect::route('booking.index', array($leadership_event_id));
    }


    public function register($leadership_event_id, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->registration_date = new Datetime();
        $booking->save();
        return Redirect::route('booking.show', array($leadership_event_id, $id))
                ->with('info', 'Registered booking!');
    }


    public function unregister($leadership_event_id, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->registration_date = null;
        $booking->save();
        return Redirect::route('booking.show', array($leadership_event_id, $id))
                ->with('info', 'Unregistered booking!');
    }

}