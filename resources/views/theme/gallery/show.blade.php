@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget($title . ' Gallery', null)

<div class="container">

    @foreach ($images as $image)
    <div class='row'>
        <div class='col-xs-12 blog-show'>
            <div class="body-content">
                <div class='blog-title'>
                    @if (!empty($image->title_tag))
                    <h1>{!! empty($image->title_tag) ? (empty($image->name) ? '[Unnamed]' : $image->name) : $image->title_tag !!}</h1>
                    @endif
                    <i class="fa fa-clock-o"></i> Posted on <span class='published-at'>{!! \Carbon\Carbon::parse($image->created_at)->format('d M, Y') !!}</span>
                </div>

                    <img class="img-responsive" alt="{{ $image->alt_tag }}" src="{{ $image->url }}" />

                @if (!empty($image->name))
                    <h3>{!! $image->name !!}</h3>
                @endif

                @if (!empty($image->tags))
                <div class='blog-footer'>
                    <span class='footer-label'><i class='fa fa-tags'></i> Tags:</span>
                    @foreach(explode(',', $image->tags) as $tag)
                    <a href="{{ url('gallery/'.$tag) }}" class="btn btn-xs btn-default">{{ $tag }}</a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    @endforeach

</div>

@endsection

@section('quarx')
    @edit('images')
@endsection