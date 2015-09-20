@extends('layout')
@section('title')
	{{ $title }}
@stop
@section('content')
<div class="jumbotron">
    <div class="container">
        @if ($redirect)
        <script type="application/javascript">
            setTimeout(
                function() {
                    location.href = '{{ $redirect }}';
                },
                10000
            );
        </script>
        {{ $message }}
        <p class="like-h">Нажмите <a href="{{ $redirect }}">эту ссылку</a>, если ваш браузер не поддерживает автоматический редирект.</p>
        @endif
    </div>
</div>
@stop