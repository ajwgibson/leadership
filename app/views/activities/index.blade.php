
@if ($event)

<h3>Activities</h3>

<div>
    {{ link_to_route('activity.create', 'Add a new activity', $parameters = array( 'leadership_event_id' => $event->id), array('class' => 'btn btn-primary')) }}
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($event->activities->sortBy('name') as $activity)
        <tr>
            <td>{{{ $activity->name }}}</td>
            <td>
                {{ link_to_route('activity.show', 'View details', 
                        $parameters = array('leadership_event_id' => $activity->leadership_event()->first()->id, 'id' => $activity->id), 
                        array('class' => '')) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@else

<div class="panel panel-danger">
    <div class="panel-heading">Error!</div>
    <div class="panel-body">
        <p>There is no event matching the supplied leadership event id.</p>
    </div>
</div>

@endif