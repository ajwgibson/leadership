
<h3>{{{ $activity->name }}} attendees</h3>

<a href="javascript:window.print();" class="btn btn-success hidden-print">
    <i class="glyphicons print"></i>&nbsp;Print sheet
</a>

{{ link_to_route(
            'activity.index', 
            'Back to activities', 
            $parameters = array('leadership_event_id' => $activity->leadership_event()->first()->id), 
            $attributes = array('class' => 'btn btn-default hidden-print')) }}


<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Contact details</th>
            <th>Church &amp; Role</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($activity->bookings()->orderBy('bookings.last')->orderBy('bookings.first')->get() as $booking)
        <tr>
            <td>{{{ $booking->name() }}}</td>
            <td>{{{ $booking->email }}}<br/>
                {{{ $booking->contact_number }}}</td>
            <td>{{{ $booking->church }}}<br/>
                {{{ $booking->role }}}</td>
            <td>{{{ nl2br($booking->notes) }}}</td>
        </tr>
    @endforeach
    </tbody>
</table>