
<div class="row">
    <div class="col-sm-12">
        <p style="margin-bottom: 20px;">
            {{ link_to_route('event.create', 'Add a new event', array(), array('class' => 'btn btn-primary')) }}
        </p>
    </div>
</div>


<div class="row">

    <div class="col-sm-12">

        @foreach ($events as $event)
        <div class="panel panel-default">

            <div class="panel-heading">
                {{ link_to_route('registration', 'Registration', 
                                $parameters = array( 'leadership_event_id' => $event->id), array('class' => 'btn btn-success pull-right')) }}
                <h3 class="panel-title">{{{ $event->name() }}}</h3>
                <p>
                    {{ link_to_route('event.show', 'View details', $parameters = array( 'id' => $event->id), array('class' => '')) }}
                </p>
                
            </div>
            
            <div class="panel-body">

                @if ($event->description)
                    <p>{{ nl2br($event->description) }}</p>
                @endif

                <div class="row">

                    <div class="col-sm-6">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Bookings &amp; registrations</h4>
                            </div>

                            <div class="panel-body">

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="badge">{{ $event->expected() }}</span>
                                        Bookings
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">{{ $event->registered() }}</span>
                                        Registrations
                                    </li>
                                </ul>

                                {{ link_to_route('booking.index', 'Manage bookings', 
                                        $parameters = array( 'leadership_event_id' => $event->id), array('class' => 'btn btn-default pull-right')) }}

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Activities</h4>
                            </div>

                            <div class="panel-body">

                                <ul class="list-group">
                                    @foreach ($event->activities()->orderBy('name')->get() as $activity)
                                    <li class="list-group-item">
                                        <span class="badge">{{ $activity->bookings()->count() }}</span>
                                        {{{ $activity->name }}}
                                    </li>
                                    @endforeach
                                </ul>

                                {{ link_to_route('activity.index', 'Manage activities', 
                                        $parameters = array( 'leadership_event_id' => $event->id), array('class' => 'btn btn-default pull-right')) }}

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        @endforeach
    </div>

</div>


