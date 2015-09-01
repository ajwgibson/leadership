
<h3>Modify activity</h3>

{{ Form::open(array('method' => 'PUT', 'route' => array('activity.update', $activity->leadership_event()->first()->id, $activity->id))) }}

@include('activities._form', array ( 'button' => 'Update activity' ))

{{ Form::close() }}
