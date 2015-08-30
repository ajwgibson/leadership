
<p class="required-warning">Required fields are marked with an asterisk.</p>

@include('_form_errors')

<div class="form-group {{ $errors->has('first') ? 'has-error' : '' }}">
    {{ Form::label('first', 'First name', array ('class' => 'control-label required')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('first', $booking->first, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('last') ? 'has-error' : '' }}">
    {{ Form::label('last', 'Last name', array ('class' => 'control-label required')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('last', $booking->last, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {{ Form::label('email', 'Email address', array ('class' => 'control-label')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('email', $booking->email, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
    {{ Form::label('contact_number', 'Contact number', array ('class' => 'control-label')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('contact_number', $booking->contact_number, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('church') ? 'has-error' : '' }}">
    {{ Form::label('church', 'Church', array ('class' => 'control-label')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('church', $booking->church, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
    {{ Form::label('role', 'Role', array ('class' => 'control-label')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('role', $booking->role, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::submit($button, array ('class' => 'btn btn-primary')) }} 
</div>