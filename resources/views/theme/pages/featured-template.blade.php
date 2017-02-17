@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $page->seo_description }} @endsection
@section('seoKeywords') {{ $page->seo_keywords }} @endsection

@section('content')

@parallaxHeaderWidget(isset($page->title) ? $page->title : 'Featured Page', null)

<div class="container">

    {!! $page->entry !!}

</div>

@endsection

@section('quarx')
    @edit('pages', $page->id)
@endsection
