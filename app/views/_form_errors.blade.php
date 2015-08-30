@if ($errors->any())
<div class="panel panel-danger">
    <div class="panel-heading">Validation Errors</div>
    <div class="panel-body">
        <ul>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </ul>
    </div>
</div>
@endif