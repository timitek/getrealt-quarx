@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget('Pages', null)

<div class="container">

    @foreach($pages as $page)
        <a href="{!! url('page/'.$page->url) !!}">{{ $page->title }}</a><br>
    @endforeach

</div>

@endsection

@section('quarx')
    @edit('pages')
@endsection