@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget('Events', null)

<div class="container">

    @foreach($events as $event)
        @if (config('app.locale') !== config('quarx.default-language'))
            <a href="{!! url('events/event/'.$event->id) !!}">{{ $event->translationData(config('app.locale'))->title }}</a><br>
        @else
            <a href="{!! url('events/event/'.$event->id) !!}">{{ $event->title }}</a><br>
        @endif
    @endforeach

</div>

@endsection

@section('quarx')
    @('events')
@endsection