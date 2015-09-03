

<h3>Activity sign-up for "{{{ $activity->name }}}"</h3>

<div class="row">

    <div class="col-sm-8">

        {{ Form::open(array('route' => array('signup.search', $event->id, $activity->id), 'class' => 'form-inline')) }}

        <div class="form-group">
            {{ Form::label('name', 'First or last name', array ('class' => 'control-label')) }}
            {{ Form::text('name', Input::get('name'), array ('class' => 'form-control')) }}
            
        </div>
        <div class="form-group">
            {{ Form::submit('Search', array ('class' => 'btn btn-default')) }} 
        </div>
        <p class="help-block">
            <em>Type a first or last name, but not both. If you're not sure of the correct spelling try just part of the name.</em>
        </p>

        {{ Form::close() }}

        <hr>

        @if (isset($bookings))

            <p style="margin-top: 20px;">The following bookings have matched the search criteria. Pick one to continue or search again.</p>

            @include('_form_errors')

            @foreach ($bookings as $booking)
            
            <div class="panel panel-info panel-search-result">

                <div class="panel-heading">
                    <h3 class="panel-title text-uppercase">{{{ $booking->name() }}}</h3>
                </div>
                
                <div class="panel-body">

                    @if ($booking->isSignedUpForActivity($activity->id))

                    <p>
                        {{{ $booking->name() }}} has already signed up for this activity. 
                    </p>

                    @else

                    <p class="help-block">Please confirm the details are correct and amend if necessary before clicking the "Sign-up" button.</p>

                    {{ Form::open(array('route' => array('signup.do', $event->id, $activity->id, $booking->id), 'class' => 'form-horizontal')) }}

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        {{ Form::label('email', 'Email address', array ('class' => 'col-sm-4 control-label')) }}
                        <div class="col-sm-8">
                          {{ Form::text('email', $booking->email, array ('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                        {{ Form::label('contact_number', 'Contact number', array ('class' => 'col-sm-4 control-label')) }}
                        <div class="col-sm-8">
                            {{ Form::text('contact_number', $booking->contact_number, array ('class' => 'form-control')) }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            {{ Form::submit('Sign-up', array ('class' => 'btn btn-success')) }} 
                        </div>
                    </div>

                    @endif

                </div>

            </div>

            {{ Form::close() }}

            @endforeach

        @endif

    </div>

    <div class="col-sm-4">

        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="badge alert-info pull-right">{{ $activity->bookings()->count() }}</span>
                <h3 class="panel-title">Signed up</h3>
            </div>
            <div class="panel-body">
                <ol class="list-group">
                    @foreach ($activity->bookings()->get() as $signup)
                    <li class="list-group-item">
                        {{ $signup->name() }} 
                        {{ link_to_route('signup.clear', 'x', 
                                $parameters = array($event->id, $activity->id, $signup->id), 
                                array('class' => 'close clear-danger')) }}
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>

    </div>

</div>



@section('extra_js')

<script type="text/javascript">
    
    
    
</script>

@endsection
