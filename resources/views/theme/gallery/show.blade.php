@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget('Gallery (' . $title . ')', null)

<div class="container">

    <div class="col-md-8">
        @foreach ($images as $image)
            <img alt="{{ $image->alt_tag }}" src="{{ $image->url }}" />
        @endforeach
    </div>
    <div class="col-md-4">
        @foreach($tags as $tag)
            <a href="{{ url('gallery/'.$tag) }}" class="btn btn-default">{{ $tag }}</a>
        @endforeach
    </div>

</div>

@endsection

@section('quarx')
    @edit('images')
@endsection