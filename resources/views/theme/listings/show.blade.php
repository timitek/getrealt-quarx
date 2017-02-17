@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $listing->description }} @endsection
@section('seoKeywords') {{ $listing->description }} @endsection

@section('content')

@parallaxHeaderWidget(isset($listing->address) ? $listing->address : 'Listing', $headerImage)

<div class="container">

    <!-- Featured Listings -->
    <div class="row">


        @if ($listing->photoCount > 0)
        <!-- Images -->
        <div class="col-md-8">

            <!-- Flexslider: Carousel -->
            <div id="carousel" class="flexslider hidden-xs hidden-sm">
                <ul class="slides">
                    @for ($i = 0; $i < $listing->photoCount; $i++)
                    <li>
                        <img src="{{ GetRETS::getListing()->imageUrl($listing->listingSourceURLSlug, $listing->listingTypeURLSlug, $listing->listingID, $i) }}" />
                    </li>
                    @endfor
                </ul>
            </div>

            <!-- Flexslider: Slider -->
            <div id="slider" class="flexslider">
                <ul class="slides">
                    @for ($i = 0; $i < $listing->photoCount; $i++)
                    <li>
                        <img src="{{ GetRETS::getListing()->imageUrl($listing->listingSourceURLSlug, $listing->listingTypeURLSlug, $listing->listingID, $i) }}" />
                    </li>
                    @endfor
                </ul>
            </div>

            <hr class="visible-xs" />
            <hr class="visible-sm" />
        </div>
        @endif

        <!-- Right Widget -->
        <div class="{{ $listing->photoCount > 0 ? 'col-md-4' : 'col-xs-12' }}">
            <h5 class="listing-heading"><i class="fa fa-link"></i> <strong>ID:</strong> {{ $listing->listingID }}</h5>
            <div class="listing-result">
                <div class="listing-result-attributes">
                    <div>
                        <span class="label label-primary">
                            @if ( strcmp("Land", $listing->listingTypeURLSlug) === 0 )
                            <i class="fa fa-tree"></i>
                            @elseif ( strcmp("Commercial", $listing->listingTypeURLSlug) === 0 )
                            <i class="fa fa-building-o"></i>
                            @else
                            <i class="fa fa-home"></i>
                            @endif
                            {{ $listing->listingTypeURLSlug }}
                        </span> 
                        @if ($listing->beds) 
                        <span class="label label-primary"><i class="fa fa-bed"></i> {{ $listing->beds }} Bed</span> 
                        @endif
                        @if ($listing->baths) 
                        <span class="label label-primary"><i class="fa fa-bath"></i> {{ $listing->baths }} Bath</span> 
                        @endif
                    </div>
                    @if ($listing->squareFeet || $listing->lot || $listing->acres)
                    <div class="listing-result-dimensions">
                        @if ($listing->squareFeet) 
                        <span class="listing-result-dimension">
                            <strong><abbr title="Square Feet">Sqft.:</abbr></strong> {{ $listing->squareFeet }}
                        </span>
                        @endif
                        @if ($listing->lot) 
                        <span class="listing-result-dimension">
                            <strong>Lot:</strong> {{ $listing->lot }}
                        </span>
                        @endif
                        @if ($listing->acres) 
                        <span class="listing-result-dimension">
                            <strong>Acres:</strong> {{ $listing->acres }}
                        </span>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="listing-result-price">{{ $listing->listPrice }}</div>
            </div>

            <hr />
            <h5 class="listing-heading"><i class="fa fa-list-alt"></i> <strong>Remarks</strong></h5>
            <p>
                {!! $listing->description !!}
            </p>
            <hr />

            @if (!empty($listing->features))
            <h5 class="listing-heading"><i class="fa fa-star"></i> <strong>Features</strong></h5>
            <div class="listing-features">
                @foreach($listing->features as $feature)
                <span class="label label-primary feature-{{ rand(1,5) }}">{{ $feature }}</span>
                @endforeach
            </div>
            @endif

            <h5 class="listing-heading"><i class="fa fa-cogs"></i> <strong>Actions</strong></h5>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#contactModal">
                        <i class="fa fa-envelope"></i> Contact Agent
                    </button>
                </div>
            </div>


        </div>
    </div>

    <div id="map"></div>

    <div class="row listing-result">
        <div class="listing-result-provider"><strong>Provided By:</strong> {{ $listing->providedBy }}</div>
    </div>

</div>

@endsection

@section('quarx')
@edit('getrealt')
@endsection

@section('javascript')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAX72AIlCzzSJ6lDPlSEj_3I2BERp3PTm0"></script>
<script>
    $(function () {
        // FlexSlider
        $(window).load(function () {
            // The slider being synced must be initialized first
            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 210,
                itemMargin: 5,
                asNavFor: '#slider'
            });

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel"
            });
        });


        function initMap() {

            var geocoder = new google.maps.Geocoder();

            if (geocoder) {
                var address = "{{ $listing->address }}";
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (status !== google.maps.GeocoderStatus.ZERO_RESULTS) {

                            var location = results[0].geometry.location;

                            var mapCanvas = document.getElementById('map');
                            var markerImage = '{{ asset("assets/themes/getrealt/images/marker.png") }}';


                            var mapOptions = {
                                center: location,
                                zoom: 16,
                                panControl: false,
                                scrollwheel: false,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };

                            var map = new google.maps.Map(mapCanvas, mapOptions);


                            var marker = new google.maps.Marker({
                                position: location,
                                map: map,
                                icon: markerImage
                            });

                            var contentString = '<div class="info-window">' +
                                    '<h3>Info Window Content</h3>' +
                                    '<div class="info-content">' +
                                    '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>' +
                                    '</div>' +
                                    '</div>';

                            var infowindow = new google.maps.InfoWindow({
                                content: contentString,
                                maxWidth: 400
                            });

                            marker.addListener('click', function () {
                                infowindow.open(map, marker);
                            });

                            var styles = [{"featureType": "landscape", "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]}, {"featureType": "poi", "stylers": [{"saturation": -100}, {"lightness": 51}, {"visibility": "simplified"}]}, {"featureType": "road.highway", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "road.arterial", "stylers": [{"saturation": -100}, {"lightness": 30}, {"visibility": "on"}]}, {"featureType": "road.local", "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]}, {"featureType": "transit", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "administrative.province", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": -25}, {"saturation": -100}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]}];

                            map.set('styles', styles);

                        } else {
                            alert("No results found");
                        }
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
            }

        }

        google.maps.event.addDomListener(window, 'load', initMap);
    });

</script>
@endsection