<?php


class RegistrationController extends BaseController {


    public function index($leadership_event_id)
    {
        $event = LeadershipEvent::find($leadership_event_id);

        $this->layout->with('subtitle', $event->name());

        $this->layout->content = 
            View::make('registration.index')
                ->with('event', $event);
    }


    public function search($leadership_event_id)
    {
        $name   = Input::get('name');

        if (empty($name)) {
            return Redirect::route('registration')
                    ->with('message', 'You must provide a name');
        } 

        $event = LeadershipEvent::findOrFail($leadership_event_id);

        $bookings = 
            $event->bookings()->where(function($query) use($name) {
                $query->where('bookings.first', 'LIKE', "%$name%")
                      ->orWhere('bookings.last', 'LIKE', "%$name%");
            })->get();

        $booking_count = $bookings->count();

        if ($booking_count == 0) 
        {
            return Redirect::route('registration', array($leadership_event_id))
                    ->withInput()
                    ->with('message', 'No bookings found!');
        } 
        else
        {
            $this->layout->with('subtitle', $event->name());

            $this->layout->content = 
                View::make('registration.index')
                    ->with('event',    $event)
                    ->with('bookings', $bookings);
        }
    }


    public function register($leadership_event_id, $booking_id)
    {
        $input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                Booking::$rules);

        if ($validator->passes()) 
        {
            $booking = Booking::findOrFail($booking_id);
            $booking->registration_date = new Datetime();
            $booking->first           = Input::get('first');
            $booking->last            = Input::get('last');
            $booking->email           = Input::get('email');
            $booking->contact_number  = Input::get('contact_number');
            $booking->church          = Input::get('church');
            $booking->role            = Input::get('role');
            $booking->notes           = Input::get('notes');
            $booking->save();

            return Redirect::route('registration', array($leadership_event_id))
                    ->with('info', 'Registration complete!');
        }
        else
        {
            $event = LeadershipEvent::find($leadership_event_id);
            $bookings = Booking::where('id', $booking_id)->get();

            $bookings->each(function($booking) {
                // Should actually only be one...
                $booking->first          = Input::get('first');
                $booking->last           = Input::get('last');
                $booking->email          = Input::get('email');
                $booking->contact_number = Input::get('contact_number');
                $booking->church         = Input::get('church');
                $booking->role           = Input::get('role');
                $booking->notes          = Input::get('notes');
            });

            $this->layout->with('subtitle', $event->name());
            $this->layout->withErrors($validator);

            $this->layout->content = 
                View::make('registration.index')
                    ->with('event',    $event)
                    ->with('bookings', $bookings)
                    ->with('errors',   $validator->messages());
        }


    }

}