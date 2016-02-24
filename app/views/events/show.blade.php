
<div class="col-sm-8">
    <dl class="dl-horizontal show">
        <dt>Event date</dt>
        <dd>{{{ $event->name() }}}</dd>

        <dt>Event description</dt>
        <dd>{{ nl2br($event->description) }}</dd>

        <dt></dt>
        <dd>
            @if ($event->closed)
            <span class="bg-info"><em><strong>Note: this event is now closed.</strong></em></span>
            @endif
        </dd>
    </dl>
    
</div>

<div class="col-sm-4">

    

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'event.edit', 
            'Edit this event', 
            $parameters = array( 'id' => $event->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    @if ($event->closed)

    {{ Form::open(
        array(
            'method' => 'PUT', 
            'route' => array('event.open', $event->id),
            'class' => '' ) ) }}

    <div style="margin-bottom:10px;">
        {{ Form::submit(
            'Reopen this event', 
            array('class' => 'btn btn-info')) }}
    </div>

    {{ Form::close() }}

    @else

    {{ Form::open(
        array(
            'method' => 'PUT', 
            'route' => array('event.close', $event->id),
            'class' => '' ) ) }}

    <div style="margin-bottom:10px;">
        {{ Form::submit(
            'Close this event', 
            array('class' => 'btn btn-info')) }}
    </div>

    {{ Form::close() }}

    @endif

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('event.destroy', $event->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this event', 
            array(
                'class' => 'btn btn-danger',
                'data-toggle' => 'modal',
                'data-target' => '#modal' )) }}
    </div>

    {{ Form::close() }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'event.index', 
            'Back to events', 
            $parameters = array(), 
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