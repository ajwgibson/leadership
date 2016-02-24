


<div class="row">

    <div class="pull-right">
        <a class="btn" data-toggle="collapse" data-target="#filter">
            @if ($filtered)
            <span class="glyphicon glyphicon-warning-sign"></span>
            @endif
            Filter events
            <span class="caret"></span>
        </a>
    </div>

    <div class="col-sm-6">
        <p style="">
            {{ link_to_route('event.create', 'Add a new event', array(), array('class' => 'btn btn-primary')) }}
        </p>
    </div>

</div>

<div class="clearfix"></div>

<div id="filter" class="filter collapse">

    {{ Form::open(array('route' => array('event.filter'))) }}

    <div class="col-sm-12 panel panel-default">

        <div class="col-sm-3 col-sm-offset-9">

            <div class="form-group">
                {{ Form::label('filter_include_closed', 'Event status', array('class' => 'control-label')) }}
                <div>
                    <label class="checkbox-inline">{{ Form::checkbox('filter_include_closed', true, $filter_include_closed) }} Include closed events</label><br/>
                </div>
            </div>

        </div>

        <div class="col-sm-3 col-sm-offset-9">
            {{ Form::submit('Apply filters', array('class' => 'btn btn-info')) }}

            {{ link_to_route(
                'event.resetfilter', 
                'Reset filters', 
                $parameters = array( ), 
                $attributes = array( 'class' => 'btn btn-default' ) ) }}

        </div>

    </div>

    {{ Form::close() }}

</div>

<div class="row" style="margin-top: 20px;">

    <div class="col-sm-12">

        @if (count($events) == 0)
        <p><em><strong>No events found.</strong></em></p>
        @endif

        @foreach ($events as $event)
        <div class="panel panel-default">

            <div class="panel-heading">
                @if ($event->closed)
                <button class="btn btn-info pull-right" disabled="disabled">Event closed</button>
                @else
                {{ link_to_route('registration', 'Registration', 
                                $parameters = array( 'leadership_event_id' => $event->id), array('class' => 'btn btn-success pull-right')) }}
                @endif
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

                                {{ link_to_route('booking.index', $event->closed ? 'View bookings' : 'Manage bookings', 
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

                                {{ link_to_route('activity.index', $event->closed ? 'View activities' : 'Manage activities', 
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


