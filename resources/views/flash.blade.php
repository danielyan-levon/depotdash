@if (session()->has('message'))
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>
                Confirm
            </span>                
        </div>
        <div class="panel-body">
            <div class="alert alert-info">{{ session('message') }}</div>
        </div>
    </div>
</div>
@endif