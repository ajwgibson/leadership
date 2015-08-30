
{{ Form::open(array('route' => 'event.store')) }}

@include('events._form', array ( 'button' => 'Save new event' ))

{{ Form::close() }}
