@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget(isset($event->title) ? $event->title : 'Calendar', null)

<div class="container">

    <div class="row">
        <div class="col-md-12 calendar-content">
            {!! $calendar->asHtml([ 'class' => 'calendar', 'dates' => $events ]); !!}
            {!! $calendar->links('cal-link btn btn-default'); !!}
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @edit('events')
@endsection