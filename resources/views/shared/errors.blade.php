@foreach (['danger', 'warning', 'success', 'info'] as $message)
    @if(Session::has($message))
        <div class="alert alert-{{ $message }}">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session($message) }}
        </div>
    @endif
@endforeach
