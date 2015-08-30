
<h3>Modify booking</h3>

<dl>
    <dt>Event name</dt>
    <dd>{{{ $booking->leadership_event()->first()->name }}}</dd>
</dl>

{{ Form::open(array('method' => 'PUT', 'route' => array('booking.update', $booking->leadership_event()->first()->id, $booking->id))) }}

@include('bookings._form', array ( 'button' => 'Update booking' ))

{{ Form::close() }}
