@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $blog->seo_description }} @endsection
@section('seoKeywords') {{ $blog->seo_keywords }} @endsection

@section('content')

@parallaxHeaderWidget(isset($blog->title) ? $blog->title : 'Blog', null)

<div class="container">

    <h1>{!! $blog->title !!} - <span>{!! $blog->published_at !!}</span></h1>
    {!! $blog->entry !!}

</div>

@endsection

@section('quarx')
    @edit('blog', $blog->id)
@endsection
