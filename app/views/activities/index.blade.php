
@if ($event)

<h3>Activities</h3>

<div class="row">
    <div class="col-sm-12">
        <div style="margin-bottom: 20px;">
            @if (!($event->closed))
            {{ link_to_route('activity.create', 'Add a new activity', 
                    $parameters = array( 'leadership_event_id' => $event->id), array('class' => 'btn btn-primary')) }}
            @endif
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
                @if (!($event->closed))
                {{ link_to_route('signup', 'Sign-up', 
                        $parameters = array('leadership_event_id' => $activity->leadership_event()->first()->id, 'id' => $activity->id), 
                        array('class' => 'btn btn-success pull-right')) }}
                @endif
                <h3 class="list-group-item-heading">{{{ $activity->name }}}</h3>
                
                {{ link_to_route('activity.show', 'View details', 
                        $parameters = array('leadership_event_id' => $activity->leadership_event()->first()->id, 'id' => $activity->id), 
                        array('class' => '')) }}

                <p>{{ nl2br($activity->description) }}</p>

                <p><strong><em>{{ $activity->bookings()->count() }} attendees</em></strong></p>

                @if (!($event->closed))
                {{ link_to_route('signup.sheet', 'Printable sheet', 
                        $parameters = array('leadership_event_id' => $activity->leadership_event()->first()->id, 'id' => $activity->id), 
                        array('class' => 'btn btn-info')) }}
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