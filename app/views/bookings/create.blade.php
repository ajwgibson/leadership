
<h3>New booking for {{{ $event->name }}}</h3>

{{ Form::open(array('route' => array('booking.store', $event->id))) }}

@include('bookings._form', array ( 'button' => 'Save new booking' ))

{{ Form::close() }}
