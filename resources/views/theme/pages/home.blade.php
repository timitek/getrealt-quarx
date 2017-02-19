@extends('quarx-frontend::layout.master')

@if (isset($page))
@section('seoDescription') {{ $page->seo_description }} @endsection
@section('seoKeywords') {{ $page->seo_keywords }} @endsection
@endif

@section('content')

@parallaxHeaderWidget(isset($page->title) ? $page->title : config('getrealt.site_name'), null)

@if (isset($page))
<div class="container">
    {!! $page->entry !!}
</div>
@else
<div class="container">
    <div class="row animated fadeInLeft">
        <div class="col-xs-12">
            <div class="welcome-section">
                @blogPostByTagWidget('Welcome', 1)
            </div>
        </div>
    </div>
</div>

<div class="featured-section">
    <div class="container">
        <div class="row animated fadeInRight">
            <div class="col-sm-4">
                @blogPostByTagWidget('Featured', 1)
            </div>
            <div class="col-sm-4">
                @blogPostByTagWidget('Featured', 2)
            </div>
            <div class="col-sm-4">
                @blogPostByTagWidget('Featured', 3)
            </div>
        </div>
    </div>
</div>

<div class="testimonial-section">
    <div class="container">
        <div class="row animated fadeInUp" data-animate="fadeInUp" style="visibility: visible;">
            <div class="col-xs-12">
                <h2 class="main-header">What Others Say About Us</h2>
            </div>
            <div class="col-xs-12">
                @testimonialsWidget()
            </div>
        </div>
    </div>
</div>

@endif


@endsection

@section('javascript')

@parent
<script type="text/javascript">
    $('.heading').parallax({
        speed: 0.35
    });
</script>

@endsection

@section('quarx')
@if (isset($page))
@edit('pages', $page->id)
@endif
@endsection
