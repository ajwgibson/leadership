
<h3>New activity</h3>

{{ Form::open(array('route' => array('activity.store', $event->id))) }}

@include('activities._form', array ( 'button' => 'Save new activity' ))

{{ Form::close() }}
