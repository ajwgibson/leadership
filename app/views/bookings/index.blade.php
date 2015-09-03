
@if ($event)

<h3>Bookings</h3>

<div>
    {{ link_to_route('booking.create', 'Add a new booking', 
            $parameters = array( 'leadership_event_id' => $event->id), array('class' => 'btn btn-primary')) }}
    {{ link_to_route('event.index', 'Back to events', 
            $parameters = array(), array('class' => 'btn btn-default')) }}
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Church</th>
            <th>Role</th>
            <th>Email address</th>
            <th>Contact number</th>
            <th>Registered?</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($event->bookings->sortBy('first') as $booking)
        <tr>
            <td>{{{ $booking->first }}} {{{ $booking->last }}}</td>
            <td>{{{ $booking->church }}}</td>
            <td>{{{ $booking->role }}}</td>
            <td>{{{ $booking->email }}}</td>
            <td>{{{ $booking->contact_number }}}</td>
            <td>{{{ $booking->is_registered() ? 'Yes' : 'No' }}}</td>
            <td>
                {{ link_to_route('booking.show', 'View details', 
                        $parameters = array('leadership_event_id' => $booking->leadership_event()->first()->id, 'id' => $booking->id), 
                        array('class' => '')) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@else

<div class="panel panel-danger">
    <div class="panel-heading">Error!</div>
    <div class="panel-body">
        <p>There is no event matching the supplied leadership event id.</p>
    </div>
</div>

@endif