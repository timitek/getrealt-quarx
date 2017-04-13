@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget(isset($event->title) ? $event->title : 'Calendar', null)

<div class="container">

    <div class="row visible-md visible-lg">
        <div class="col-md-12 calendar-content">
            {!! $calendar->asHtml([ 'class' => 'calendar', 'dates' => $events ]); !!}
        </div>
    </div>

    <div class="row visible-xs visible-sm">
        <div class="col-md-9 blog-all">

            @if ($events && count($events))
                @foreach($events as $key => $daysEvents)
                    <div class="panel entry-row">
                        <div class="panel-heading">
                            <div class='blog-title'>
                                <i class="fa fa-calendar"></i> 
                                <a href="{!! url('events/date/'.$key) !!}">
                                    {!! \Carbon\Carbon::parse($key)->format('d M, Y') !!}
                                </a> 
                            </div>
                        </div>
                        <div class="panel-body">
                            @foreach($daysEvents as $event)
                                <div>
                                    <a href="{!! url('events/event/'.$event->id) !!}">
                                        {!! $event->title !!} 
                                    </a>
                                    @if ($event->start_date != $event->end_date)
                                    <span class='published-at'>
                                        -
                                        <small>from</small> <strong>{!! \Carbon\Carbon::parse($event->start_date)->format('d M, Y') !!}</strong>
                                        <small>through</small> <strong>{!! \Carbon\Carbon::parse($event->end_date)->format('d M, Y') !!}</strong>
                                    </span>                            
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="panel entry-row">
                    <div class="panel-heading">
                        <div class='blog-title'>
                            <i class="fa fa-calendar"></i>
                            No Events At This Time 
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {!! $calendar->links('cal-link btn btn-default'); !!}
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @edit('events')
@endsection