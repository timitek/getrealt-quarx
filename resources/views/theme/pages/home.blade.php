@extends('quarx-frontend::layout.master')

@if (isset($page))
@section('seoDescription') {{ $page->seo_description }} @endsection
@section('seoKeywords') {{ $page->seo_keywords }} @endsection
@endif

@section('content')

@parallaxHeaderWidget(isset($page->title) ? $page->title : 'Home Page', null)

<div class="container">

    @if (isset($page))
    {!! $page->entry !!}
    @else

    <div class="light-gray-bg inner-shadow">
        <!-- What we are good with -->
        <div class="container">
            <div class="row med-margin">
                <div class="col-xs-12">
                    <h2 class="main-header no-border">Learn about our  <span>Multi System</span></h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Ut enim massa, sodales tempor convallis et.</p>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <div class="feature">
                        <div class="feature-img">
                            <span class="glyphicon glyphicon-cloud"></span>
                        </div>
                        <div class="feature-content">
                            <h3><strong>Cloud</strong> System</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Lorem ipsum dolor sit amet, consectetur adipiscing metus elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="feature">
                        <div class="feature-img">
                            <span class="glyphicon glyphicon-fire"></span>
                        </div>
                        <div class="feature-content">
                            <h3><strong>Fire</strong> System</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Lorem ipsum dolor sit amet, consectetur adipiscing metus elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="feature">
                        <div class="feature-img">
                            <span class="glyphicon glyphicon-flash"></span>
                        </div>
                        <div class="feature-content">
                            <h3><strong>Lightning</strong> System</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing metus elit. Lorem ipsum dolor sit amet, consectetur adipiscing metus elit.</p>
                        </div>
                    </div>
                </div>
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
