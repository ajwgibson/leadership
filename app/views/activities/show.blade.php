<h3>Activity details</h3>

<div class="col-sm-8">
    <dl class="dl-horizontal show">

        <dt>Activity name</dt>
        <dd>{{ $activity->name }}</dd>

        <dt>Description</dt>
        <dd>{{ nl2br($activity->description) }}</dd>
    </dl>
</div>

<div class="col-sm-4">

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'activity.edit', 
            'Edit this activity', 
            $parameters = array( 'id' => $activity->id, 'leadership_event_id' => $activity->leadership_event()->first()->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('activity.destroy', $activity->leadership_event()->first()->id, $activity->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this activity', 
            array(
                'class' => 'btn btn-danger',
                'data-toggle' => 'modal',
                'data-target' => '#modal' )) }}
    </div>

    {{ Form::close() }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'activity.index', 
            'Back to activities', 
            $parameters = array('leadership_event_id' => $activity->leadership_event()->first()->id), 
            $attributes = array('class' => 'btn btn-default')) }}
    </div>

</div>



<div id="modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-danger" style="font-size: 2em;">
            <span class="glyphicon glyphicon-warning-sign"></span> Warning
        </p>
        <p>
            You are about to delete this activity, are you sure you want to continue?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No, cancel</button>
        <button type="button" id="continue" class="btn btn-danger">Yes, continue</button>
      </div>
    </div>
  </div>
</div>


@section('extra_js')

<script type="text/javascript">
    
    $('#continue').click(function() {
        $('form.delete').submit();
    });
    
</script>

@endsection