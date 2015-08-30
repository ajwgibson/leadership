
<p class="required-warning">Required fields are marked with an asterisk.</p>

@include('_form_errors')

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('name', 'Event name', array ('class' => 'control-label required')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('name', $event->name, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {{ Form::label('description', 'Event description', array ('class' => 'control-label')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::textarea('description', $event->description, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
    {{ Form::label(
            'start_date', 
            'Start date', 
            array (
                'class' => 'control-label required',
                'data-datepicker' => 'datepicker' )) }}
    <div class="row">
        <div class="col-sm-2">
            <div class="input-group date dp3" 
                    data-date="{{ empty($event->start_date) ? date('d-m-Y') : $event->start_date->format('d-m-Y') }}" 
                    data-date-format="dd-mm-yyyy">
                {{ Form::text('start_date', empty($event->start_date) ? '' : $event->start_date->format('d-m-Y') , array ('class' => 'form-control')) }}
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
    {{ Form::label(
            'start_date', 
            'End date', 
            array (
                'class' => 'control-label',
                'data-datepicker' => 'datepicker' )) }}
    <div class="row">
        <div class="col-sm-2">
            <div class="input-group date dp3" 
                    data-date="{{ empty($event->end_date) ? date('d-m-Y') : $event->end_date->format('d-m-Y') }}" 
                    data-date-format="dd-mm-yyyy">
                {{ Form::text('end_date', empty($event->end_date) ? '' : $event->end_date->format('d-m-Y') , array ('class' => 'form-control')) }}
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
    {{ Form::label('notes', 'Notes', array ('class' => 'control-label')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::textarea('notes', $event->notes, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::submit($button, array ('class' => 'btn btn-primary')) }} 
</div>




@section('extra_js')

<script type="text/javascript">
    
    // Initialise datepicker inputs
    $('.dp3').datepicker();
    
</script>

@endsection
