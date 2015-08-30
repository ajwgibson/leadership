<h3>Booking details</h3>

<div class="col-sm-8">
    <dl class="dl-horizontal show">

        <dt>First name</dt>
        <dd>{{ $booking->first }}</dd>

        <dt>Last name</dt>
        <dd>{{ $booking->last }}</dd>

        <dt>Email address</dt>
        <dd>{{ $booking->email }}</dd>

        <dt>Contact number</dt>
        <dd>{{ $booking->contact_number }}</dd>

        <dt>Church</dt>
        <dd>{{ $booking->church }}</dd>

        <dt>Role</dt>
        <dd>{{ $booking->roles }}</dd>
    </dl>
</div>

<div class="col-sm-4">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('booking.destroy', $booking->leadership_event()->first()->id, $booking->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'booking.edit', 
            'Edit this booking', 
            $parameters = array( 'id' => $booking->id, 'leadership_event_id' => $booking->leadership_event()->first()->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this booking', 
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
            You are about to delete this booking, are you sure you want to continue?
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