@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $blog->seo_description }} @endsection
@section('seoKeywords') {{ $blog->seo_keywords }} @endsection

@section('content')

@parallaxHeaderWidget(isset($blog->title) ? $blog->title : 'Blog', null)

<div class="container blog-show">

    <div class='blog-title'>
        <h1>{!! $blog->title !!}</h1>
        <i class="fa fa-clock-o"></i> Posted on <span class='published-at'>{!! \Carbon\Carbon::parse($blog->published_at)->format('d M, Y') !!}</span>
    </div>

    {!! $blog->entry !!}
    
        
    @if (!empty($blog->tags))
    <div class='blog-footer'>
        <span class='footer-label'><i class='fa fa-tags'></i> Tags:</span>
        @foreach(explode(',', $blog->tags) as $tag)
        <a href="{{ url('blog/tags/'.$tag) }}" class="btn btn-xs btn-default">{{ $tag }}</a>
        @endforeach
    </div>
    @endif

</div>

@endsection

@section('quarx')
    @edit('blog', $blog->id)
@endsection
