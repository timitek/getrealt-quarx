@extends('quarx-frontend::layout.master')

@if (isset($page))
@section('seoDescription') {{ $page->seo_description }} @endsection
@section('seoKeywords') {{ $page->seo_keywords }} @endsection
@endif

@section('content')

@parallaxHeaderWidget(isset($page->title) ? $page->title : config('getrealt.site_name'), null)

<div class="container">

    @if (isset($page))
    {!! $page->entry !!}
    @else

    <div class="welcome-section">
        <div class="row">
            <div class="col-xs-12">
                @blogPostByTagWidget('Welcome', 1)
            </div>
        </div>
    </div>

    <div class="featured-section">
        <div class="row">
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


    <div class="testimony">
        <div class="container">
            <div class="row big-margin animated fadeInUp" data-animate="fadeInUp" style="visibility: visible;">
                <div class="col-xs-12">
                    <h2 class="main-header">What Others Say About Us</h2>
                </div>
                <div class="col-xs-12">
                    <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <!-- Bottom Carousel Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#quote-carousel" data-slide-to="0" class=""></li>
                            <li data-target="#quote-carousel" data-slide-to="1" class=""></li>
                            <li data-target="#quote-carousel" data-slide-to="2" class="active"></li>
                        </ol>

                        <!-- Carousel Slides / Quotes -->
                        <div class="carousel-inner">

                            <!-- Quote 1 -->
                            <div class="item">
                                <blockquote>
                                    <div class="row">
                                        <div class="col-sm-3 text-center">
                                            <img class="img-circle" src="http://randomuser.me/api/portraits/men/{{rand(1,40)}}.jpg" style="width: 100px;height:100px;">
                                        </div>
                                        <div class="col-sm-9">
                                            <p>The first time I used GetRealT, I was able to find my ideal house. Thank you GetRealT!</p>
                                            <small>Someone famous</small>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- Quote 2 -->
                            <div class="item">
                                <blockquote>
                                    <div class="row">
                                        <div class="col-sm-3 text-center">
                                            <img class="img-circle" src="http://randomuser.me/api/portraits/men/{{rand(1,40)}}.jpg" style="width: 100px;height:100px;">
                                        </div>
                                        <div class="col-sm-9">
                                            <p>GetRealT gave me a wonderful experience searching for a new house! Good job guys!</p>
                                            <small>Someone a little bit famous</small>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- Quote 3 -->
                            <div class="item active">
                                <blockquote>
                                    <div class="row">
                                        <div class="col-sm-3 text-center">
                                            <img class="img-circle" src="http://randomuser.me/api/portraits/men/{{rand(1,40)}}.jpg" style="width: 100px;height:100px;">
                                        </div>
                                        <div class="col-sm-9">
                                            <p>Umm.... Thank you GetRealT! ..</p>
                                            <small>Someone infamous</small>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                        </div>

                        <!-- Carousel Buttons Next/Prev -->
                        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                    </div>                          
                </div>
            </div>
        </div>
    </div>



    @endif

</div>
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
