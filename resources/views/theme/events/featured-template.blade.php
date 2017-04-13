@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $event->seo_description }} @endsection
@section('seoKeywords') {{ $event->seo_keywords }} @endsection

@section('content')

@parallaxHeaderWidget(isset($event->title) ? $event->title : 'Featured Event', null)

<div class="container blog-show">

    <div class="jumbotron">
        <h1>Featured Event</h1>
        <h2>{!! $event->title !!}</h2>
    </div>

    <div class='blog-title'>
        <i class="fa fa-calendar"></i> 
        <span class='published-at'>
            {!! \Carbon\Carbon::parse($event->start_date)->format('d M, Y') !!}
            @if ($event->start_date != $event->end_date)
                - {!! \Carbon\Carbon::parse($event->end_date)->format('d M, Y') !!}
            @endif
        </span>
    </div>

    {!! $event->details !!}

</div>

@endsection

@section('quarx')
    @edit('events', $event->id)
@endsection
