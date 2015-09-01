
<p class="required-warning">Required fields are marked with an asterisk.</p>

@include('_form_errors')

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('name', 'Activity name', array ('class' => 'control-label required')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('name', $activity->name, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {{ Form::label('description', 'Activity description', array ('class' => 'control-label')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::textarea('description', $activity->description, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::submit($button, array ('class' => 'btn btn-primary')) }} 
</div>

