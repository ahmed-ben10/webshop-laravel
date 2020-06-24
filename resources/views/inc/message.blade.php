@if($message = session()->get('danger'))
    <div class="alert alert--danger">
        {{$message}}
    </div>
@endif
@if($message = session()->get('success'))
    <div class="alert alert--success">
        {{$message}}
    </div>
@endif
