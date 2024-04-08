
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
        <div class="alert alert-{{ $msg }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get($msg) }}
        </div>
    @endif
@endforeach
