@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget('Events', null)

<div class="container blog-all">


    <div class="row">
        <div class="col-md-9">
            @foreach($events as $event)
                <div class="panel entry-row">
                    <div class="panel-heading">
                        <div class='blog-title'>
                            <a href="{!! url('events/event/'.$event->id) !!}">
                                {!! $event->title !!} 
                            </a>
                            - <i class="fa fa-calendar"></i> 
                            <span class='published-at'>
                                {!! \Carbon\Carbon::parse($event->start_date)->format('d M, Y') !!}
                                @if ($event->start_date != $event->end_date)
                                    - {!! \Carbon\Carbon::parse($event->end_date)->format('d M, Y') !!}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="panel-body">                    
                    {!! str_limit($event->details->plain(), 300) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @('events')
@endsection