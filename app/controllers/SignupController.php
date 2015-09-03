<?php


class SignupController extends BaseController {


    public function index($leadership_event_id, $activity_id)
    {
        $event = LeadershipEvent::find($leadership_event_id);
        $activity = Activity::find($activity_id);

        $this->layout->with('subtitle', $event->name());

        $this->layout->content = 
            View::make('signup.index')
                ->with('event', $event)
                ->with('activity', $activity);
    }


    public function search($leadership_event_id, $activity_id)
    {
        $name   = Input::get('name');

        if (empty($name)) {
            return Redirect::route('signup', array($leadership_event_id, $activity_id))
                    ->with('message', 'You must provide a name');
        } 

        $event = LeadershipEvent::findOrFail($leadership_event_id);
        $activity = Activity::findOrFail($activity_id);

        $bookings = 
            $event->bookings()->where(function($query) use($name) {
                $query->where('bookings.first', 'LIKE', "%$name%")
                      ->orWhere('bookings.last', 'LIKE', "%$name%");
            })->get();

        $booking_count = $bookings->count();

        if ($booking_count == 0) 
        {
            return Redirect::route('signup', array($leadership_event_id, $activity_id))
                    ->withInput()
                    ->with('message', 'No bookings found!');
        } 
        else
        {
            $this->layout->with('subtitle', $event->name());

            $this->layout->content = 
                View::make('signup.index')
                    ->with('event',    $event)
                    ->with('activity', $activity)
                    ->with('bookings', $bookings);
        }
    }


    public function signup($leadership_event_id, $activity_id, $booking_id)
    {
        $input = Input::all();
        
        $booking = Booking::findOrFail($booking_id);
        $booking->email           = Input::get('email');
        $booking->contact_number  = Input::get('contact_number');
        $booking->notes           = Input::get('notes');
        $booking->save();

        $booking->activities()->attach($activity_id);

        return Redirect::route('signup', array($leadership_event_id, $activity_id))
                    ->with('info', 'Sign-up complete!');
    }

    public function clear($leadership_event_id, $activity_id, $booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        $booking->activities()->detach($activity_id);

        return Redirect::route('signup', array($leadership_event_id, $activity_id))
                    ->with('info', 'Sign-up cleared!');
    }

}