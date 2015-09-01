
<p class="required-warning">Required fields are marked with an asterisk.</p>

@include('_form_errors')

<div class="form-group {{ $errors->has('event_date') ? 'has-error' : '' }}">
    {{ Form::label(
            'event_date', 
            'Event date', 
            array (
                'class' => 'control-label required',
                'data-datepicker' => 'datepicker' )) }}
    <div class="row">
        <div class="col-sm-2">
            <div class="input-group date dp3" 
                    data-date="{{ empty($event->event_date) ? date('d-m-Y') : $event->event_date->format('d-m-Y') }}" 
                    data-date-format="dd-mm-yyyy">
                {{ Form::text('event_date', empty($event->event_date) ? '' : $event->event_date->format('d-m-Y') , array ('class' => 'form-control')) }}
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
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

<div class="form-group">
    {{ Form::submit($button, array ('class' => 'btn btn-primary')) }} 
</div>




@section('extra_js')

<script type="text/javascript">
    
    // Initialise datepicker inputs
    $('.dp3').datepicker();
    
</script>

@endsection
