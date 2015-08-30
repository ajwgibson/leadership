
{{ Form::model($event, array('method' => 'PUT', 'route' => array('event.update', $event->id))) }}

@include('events._form', array ( 'button' => 'Update this event' ))

{{ Form::close() }}
