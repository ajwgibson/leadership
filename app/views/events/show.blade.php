
<div class="col-sm-8">
    <dl class="dl-horizontal show">
        <dt>Event date</dt>
        <dd>{{{ $event->name() }}}</dd>

        <dt>Event description</dt>
        <dd>{{ nl2br($event->description) }}</dd>
    </dl>
</div>

<div class="col-sm-4">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('event.destroy', $event->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'event.edit', 
            'Edit this event', 
            $parameters = array( 'id' => $event->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ link_to_route(
        'booking.index', 
        'Manage bookings', 
        $parameters = array( 'leadership_event_id' => $event->id), 
        array('class' => 'btn btn-default')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this event', 
            array(
                'class' => 'btn btn-danger',
                'data-toggle' => 'modal',
                'data-target' => '#modal' )) }}
    </div>

    {{ Form::close() }}

</div>



<div id="modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-danger" style="font-size: 2em;">
            <span class="glyphicon glyphicon-warning-sign"></span> Warning
        </p>
        <p>
            You are about to delete this event, are you sure you want to continue?
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