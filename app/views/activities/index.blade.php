
@if ($event)

<h3>Activities</h3>

<div class="row">
    <div class="col-sm-12">
        <div style="margin-bottom: 20px;">
            {{ link_to_route('activity.create', 'Add a new activity', 
                    $parameters = array( 'leadership_event_id' => $event->id), array('class' => 'btn btn-primary')) }}
            {{ link_to_route('event.index', 'Back to events', 
                    $parameters = array(), array('class' => 'btn btn-default')) }}
        </div>
    </div>
</div>


<div class="row">

    <div class="col-sm-8">

    @foreach ($event->activities->sortBy('name') as $activity)

        <div class="list-group">

            <div class="list-group-item">
                {{ link_to_route('signup', 'Sign-up', 
                        $parameters = array('leadership_event_id' => $activity->leadership_event()->first()->id, 'id' => $activity->id), 
                        array('class' => 'btn btn-success pull-right')) }}
                <h3 class="list-group-item-heading">{{{ $activity->name }}}</h3>
                
                {{ link_to_route('activity.show', 'View details', 
                        $parameters = array('leadership_event_id' => $activity->leadership_event()->first()->id, 'id' => $activity->id), 
                        array('class' => '')) }}

                @if ($activity->description)
                    <p>{{ nl2br($activity->description) }}</p>
                @endif

                @if ($activity->bookings()->count() > 0)
                <h4>Attendees</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email address</th>
                            <th>Contact number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activity->bookings()->get() as $booking)
                        <tr>
                            <td>{{{ $booking->name() }}}</td>
                            <td>{{{ $booking->email }}}</td>
                            <td>{{{ $booking->contact_number }}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                
            </div>

        </div>

    @endforeach

    </div>

</div>

@else

<div class="panel panel-danger">
    <div class="panel-heading">Error!</div>
    <div class="panel-body">
        <p>There is no event matching the supplied leadership event id.</p>
    </div>
</div>

@endif