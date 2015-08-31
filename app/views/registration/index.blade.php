

<h3>Registration</h3>

<div class="row">

    <div class="col-sm-9">

        {{ Form::open(array('route' => array('registration.search', $event->id), 'class' => 'form-inline')) }}

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

        @if (isset($bookings))

            <p style="margin-top: 20px;">The following {{ $bookings->count() }} bookings have matched the search criteria. Pick one to continue or search again.</p>

            @include('_form_errors')

            @foreach ($bookings as $booking)
            
            <div class="panel panel-primary panel-search-result">

                <div class="panel-heading">
                    <h3 class="panel-title text-uppercase">{{{ $booking->name() }}}</h3>
                </div>
                
                <div class="panel-body">

                    @if ($booking->registration_date)

                    <p>{{{ $booking->name() }}} has already registered.</p>

                    @else

                    <p class="help-block">Please confirm the details are correct and amend if necessary before clicking the "Register" button.</p>

                    {{ Form::open(array('route' => array('register', $event->id, $booking->id), 'class' => 'form-horizontal')) }}

                    <div class="form-group {{ $errors->has('first') ? 'has-error' : '' }}">
                        {{ Form::label('first', 'First name', array ('class' => 'col-sm-4 control-label required')) }}
                        <div class="col-sm-8">
                          {{ Form::text('first', $booking->first, array ('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('last') ? 'has-error' : '' }}">
                        {{ Form::label('last', 'Last name', array ('class' => 'col-sm-4 control-label required')) }}
                        <div class="col-sm-8">
                          {{ Form::text('last', $booking->last, array ('class' => 'form-control')) }}
                        </div>
                    </div>

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

                    <div class="form-group {{ $errors->has('church') ? 'has-error' : '' }}">
                        {{ Form::label('church', 'Church', array ('class' => 'col-sm-4 control-label')) }}
                        <div class="col-sm-8">
                            {{ Form::text('church', $booking->church, array ('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                        {{ Form::label('role', 'Role', array ('class' => 'col-sm-4 control-label')) }}
                        <div class="col-sm-8">
                            {{ Form::text('role', $booking->role, array ('class' => 'form-control')) }}
                        </div>
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            {{ Form::submit('Register', array ('class' => 'btn btn-primary')) }} 
                        </div>
                    </div>

                    @endif

                </div>

            </div>

            {{ Form::close() }}

            @endforeach

        @endif

    </div>

    <div class="col-sm-3">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Registration counters</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">Expected   <span class="badge alert-info">{{{ $event->expected() }}}</span></li>
                    <li class="list-group-item">Registered <span class="badge alert-info">{{{ $event->registered() }}}</span></li>
                </ul>
            </div>
        </div>

    </div>

</div>
