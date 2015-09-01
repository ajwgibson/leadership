
<div>
    {{ link_to_route('event.create', 'Add a new event', array(), array('class' => 'btn btn-primary')) }}
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Event date</th>
            <th>Description</th>
            <th>Bookings</th>
            <th>Registrations</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($events as $event)
        <tr>
            <td>{{{ $event->name() }}}</td>
            <td>{{ nl2br($event->description) }}</td>
            <td>{{{ $event->expected() }}}</td>
            <td>{{{ $event->registered() }}}</td>
            <td>
                {{ link_to_route('event.show', 'View details', $parameters = array( 'id' => $event->id), array('class' => '')) }},
                {{ link_to_route('booking.index', 'Manage bookings', $parameters = array( 'leadership_event_id' => $event->id), array('class' => '')) }},
                {{ link_to_route('registration', 'Registration', $parameters = array( 'leadership_event_id' => $event->id), array('class' => '')) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

