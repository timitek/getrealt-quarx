/*
 elixir((mix) => {
 mix.webpack('../../themes/getrealt/assets/js/app.js', './public/themes/getrealt/js');
 });
 */

(function () {

    var listingService = function ($q, $http, restService) {

        this.index = function (advancedSearch, keywords, minPrice, maxPrice, beds, baths, includeResidential, includeLand, includeCommercial) {
            var deferred = $q.defer();

            var params = {
                'keywords': keywords
            };

            if (advancedSearch) {
                if (advancedSearch) {
                    params.advancedSearch = advancedSearch;
                }
                if (minPrice) {
                    params.minPrice = minPrice;
                }
                if (maxPrice) {
                    params.maxPrice = maxPrice;
                }
                if (includeResidential) {
                    params.includeResidential = includeResidential;
                }
                if (includeLand) {
                    params.includeLand = includeLand;
                }
                if (includeCommercial) {
                    params.includeCommercial = includeCommercial;
                }
                if (beds) {
                    params.beds = beds;
                }
                if (baths) {
                    params.baths = baths;
                }
            }

            restService.go({
                url: '/getrealt/listings',
                method: 'POST',
                params: params
            }).then(function (data) {
                deferred.resolve(data.data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;
            });

            return deferred.promise;
        };


        this.show = function (id) {
            var deferred = $q.defer();

            restService.go({
                url: '/getrealt/listings/' + id
            }).then(function (data) {
                deferred.resolve(data.data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;
            });

            return deferred.promise;
        };

        this.sendLead = function (info) {
            var deferred = $q.defer();

            restService.go({
                url: '/getrealt/listings/sendLead',
                method: 'POST',
                params: info
            }).then(function (data) {
                deferred.resolve(data.data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;
            });

            return deferred.promise;
        };
    };

    var postsService = function ($q, $http, restService) {

        this.store = function (details) {
            var deferred = $q.defer();

            restService.go({
                url: '/getrealt/posts',
                method: 'POST',
                params: details
            }).then(function (data) {
                deferred.resolve(data.data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;
            });

            return deferred.promise;
        };

        this.edit = function (id) {
            var deferred = $q.defer();

            restService.go({
                url: '/getrealt/posts/' + id
            }).then(function (data) {
                deferred.resolve(data.data);
            }, function (data) {
                deferred.reject(data.data);
                throw data;
            });
            return deferred.promise;
        };
    };

    var searchWidget = function ($scope, eventFactory, listingService) {

        // Input variables
        $scope.advancedSearch = false;
        $scope.keywords = null;
        $scope.minPrice = null;
        $scope.maxPrice = null;
        $scope.beds = null;
        $scope.baths = null;
        $scope.includeResidential = true;
        $scope.includeLand = true;
        $scope.includeCommercial = true;

        $scope.listings = null;

        $scope.search = function () {
            if ($scope.advancedSearch || $scope.keywords) {
                eventFactory.searchingListings(true);
                listingService.index(
                        $scope.advancedSearch,
                        $scope.keywords,
                        $scope.minPrice,
                        $scope.maxPrice,
                        $scope.beds,
                        $scope.baths,
                        $scope.includeResidential,
                        $scope.includeLand,
                        $scope.includeCommercial
                        ).then(function (data) {
                    $scope.listings = data;
                    eventFactory.searchingListings(false);
                    eventFactory.refreshListings($scope.listings);
                });
            }
        };
    };

    var listingsWidget = function ($scope, eventFactory) {
        $scope.listings = null;

        eventFactory.onSearchingListings($scope, function (searching) {
            $scope.searching = searching;
        });

        eventFactory.onRefreshListings($scope, function (listings) {
            $scope.listings = listings;
        });
    };

    var eventFactory = function ($rootScope) {
        var REFRESH_LISTINGS = 'refreshListings';
        var refreshListings = function (listings) {
            $rootScope.$broadcast(REFRESH_LISTINGS, listings);
        };
        var onRefreshListings = function ($scope, handler) {
            $scope.$on(REFRESH_LISTINGS, function (event, message) {
                handler(message);
            });
        };

        var SEARCHING_LISTINGS = 'searchingListings';
        var searchingListings = function (searching) {
            $rootScope.$broadcast(SEARCHING_LISTINGS, searching);
        };
        var onSearchingListings = function ($scope, handler) {
            $scope.$on(SEARCHING_LISTINGS, function (event, message) {
                handler(message);
            });
        };


        return {
            refreshListings: refreshListings,
            onRefreshListings: onRefreshListings,
            searchingListings: searchingListings,
            onSearchingListings: onSearchingListings
        };

    };

    var listingDetails = function ($scope, $uibModal, listingService) {

        $scope.listingSource = null;
        $scope.listingType = null;
        $scope.listingID = null;
        $scope.address = null;

        $scope.initMap = function () {

            var geocoder = new google.maps.Geocoder();

            if (geocoder) {
                geocoder.geocode({'address': $scope.address}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (status !== google.maps.GeocoderStatus.ZERO_RESULTS) {

                            var location = results[0].geometry.location;

                            var mapCanvas = document.getElementById('map');
                            mapCanvas.style.display = 'block';

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
                                icon: '/assets/themes/getrealt/images/marker.png'
                            });

                            var directionsLink = 'http://www.google.com/maps/dir/current+position/' + encodeURI($scope.address);
                            var streetViewLink = 'http://maps.google.com/maps?q=&layer=c&cbll=' + results[0].geometry.location.lat() + ',' + results[0].geometry.location.lng();

                            var contentString = '<div class="info-window">' +
                                    '<h5><i class="fa fa-map-marker"></i> ' + results[0].formatted_address + '</h5>' +
                                    '<div class="info-content">' +
                                    '<p>' +
                                    '<i class="fa fa-car"></i>: <a href="' + directionsLink + '" target="_blank">Get Directions</a><br />' +
                                    '<i class="fa fa-street-view"></i>: <a href="' + streetViewLink + '" target="_blank">Street View</a><br />' +
                                    '</p>' +
                                    '</div>' +
                                    '</div>';

                            var infowindow = new google.maps.InfoWindow({
                                content: contentString,
                                maxWidth: 400
                            });

                            marker.addListener('click', function () {
                                infowindow.open(map, marker);
                            });

                            var styles = [{"featureType": "administrative", "stylers": [{"visibility": "off"}]}, {"featureType": "poi", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road", "elementType": "labels", "stylers": [{"visibility": "simplified"}]}, {"featureType": "water", "stylers": [{"visibility": "simplified"}]}, {"featureType": "transit", "stylers": [{"visibility": "simplified"}]}, {"featureType": "landscape", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road.highway", "stylers": [{"visibility": "off"}]}, {"featureType": "road.local", "stylers": [{"visibility": "on"}]}, {"featureType": "road.highway", "elementType": "geometry", "stylers": [{"visibility": "on"}]}, {"featureType": "water", "stylers": [{"color": "#84afa3"}, {"lightness": 52}]}, {"stylers": [{"saturation": -17}, {"gamma": 0.36}]}, {"featureType": "transit.line", "elementType": "geometry", "stylers": [{"color": "#3f518c"}]}];

                            map.set('styles', styles);

                        } else {
                            //alert("No results found");
                        }
                    } else {
                        //alert("Geocode was not successful for the following reason: " + status);
                    }
                });
            }

        };

        $scope.initSliders = function () {
            // The slider being synced must be initialized first
            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 210,
                itemMargin: 5,
                smoothHeight: true,
                asNavFor: '#slider'
            });

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                smoothHeight: true,
                sync: "#carousel"
            });
        };


        $scope.contactAgent = function () {
            var modalInstance = $uibModal.open({
                templateUrl: 'contactAgent.html',
                controller: 'contactAgentModal',
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                size: 'lg',
                resolve: {
                    parentController: function () {
                        return $scope;
                    }
                }
            });

            modalInstance.result.then(
                    function (results) {
                        var info = results.contactInfo;
                        // closed
                        if (info && (info.name || info.phone || info.email || info.message)) {
                            info.listingSource = $scope.listingSource;
                            info.listingType = $scope.listingType;
                            info.listingID = $scope.listingID;
                            
                            listingService.sendLead(info).then(function (data) {
                                $uibModal.open({
                                    templateUrl: 'messageConfirmation.html',
                                    controller: 'messageConfirmationModal',
                                    ariaLabelledBy: 'modal-title',
                                    ariaDescribedBy: 'modal-body',
                                    size: 'sm',
                                    resolve: {
                                        message: function () {
                                            return (data.success ? "Message Sent!" : "Oops! Our messaging is down right now.  Try contacting us directly please!");
                                        }
                                    }
                                });
                                
                            });
                        }
                    },
                    function () {
                        // dismissed
                    });

        };

        $scope.start = function (listingSource, listingType, listingID, address) {
            $scope.listingSource = listingSource;
            $scope.listingType = listingType;
            $scope.listingID = listingID;
            $scope.address = address;
            
            google.maps.event.addDomListener(window, 'load', $scope.initMap);
            
            $scope.initSliders();
        };

    };
    
    var contactAgentModal = function ($scope, $uibModalInstance, parentController) {
        $scope.name = null;
        $scope.phone = null;
        $scope.email = null;
        $scope.message = null;
        
        $scope.send = function () {
            
            var contactInfo = {
                name: $scope.name,
                phone: $scope.phone,
                email: $scope.email,
                message: $scope.message
            };
            
            $uibModalInstance.close({
                contactInfo: contactInfo
            });
        };
        
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
        
    };
    
    var messageConfirmationModal = function ($scope, $uibModalInstance, message) {
        $scope.message = message;

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
        
    };
    
    var iconModal = function ($scope, $uibModalInstance) {
        $scope.icons = ['glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'outdent', 'indent', 'video-camera', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'users', 'link', 'cloud', 'flask', 'scissors', 'files-o', 'paperclip', 'floppy-o', 'square', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'sort', 'sort-desc', 'sort-asc', 'envelope', 'linkedin', 'undo', 'gavel', 'tachometer', 'comment-o', 'comments-o', 'bolt', 'sitemap', 'umbrella', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'reply-all', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'caret-square-o-down', 'caret-square-o-up', 'caret-square-o-right', 'eur', 'gbp', 'usd', 'inr', 'jpy', 'rub', 'krw', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gratipay', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'university', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper-pp', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'car', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-image-o', 'file-archive-o', 'file-audio-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-ring', 'circle-o-notch', 'rebel', 'empire', 'git-square', 'git', 'hacker-news', 'tencent-weibo', 'qq', 'weixin', 'paper-plane', 'paper-plane-o', 'history', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb', 'futbol-o', 'tty', 'binoculars', 'plug', 'slideshare', 'twitch', 'yelp', 'newspaper-o', 'wifi', 'calculator', 'paypal', 'google-wallet', 'cc-visa', 'cc-mastercard', 'cc-discover', 'cc-amex', 'cc-paypal', 'cc-stripe', 'bell-slash', 'bell-slash-o', 'trash', 'copyright', 'at', 'eyedropper', 'paint-brush', 'birthday-cake', 'area-chart', 'pie-chart', 'line-chart', 'lastfm', 'lastfm-square', 'toggle-off', 'toggle-on', 'bicycle', 'bus', 'ioxhost', 'angellist', 'cc', 'ils', 'meanpath', 'buysellads', 'connectdevelop', 'dashcube', 'forumbee', 'leanpub', 'sellsy', 'shirtsinbulk', 'simplybuilt', 'skyatlas', 'cart-plus', 'cart-arrow-down', 'diamond', 'ship', 'user-secret', 'motorcycle', 'street-view', 'heartbeat', 'venus', 'mars', 'mercury', 'transgender', 'transgender-alt', 'venus-double', 'mars-double', 'venus-mars', 'mars-stroke', 'mars-stroke-v', 'mars-stroke-h', 'neuter', 'genderless', 'facebook-official', 'pinterest-p', 'whatsapp', 'server', 'user-plus', 'user-times', 'bed', 'viacoin', 'train', 'subway', 'medium', 'y-combinator', 'optin-monster', 'opencart', 'expeditedssl', 'battery-full', 'battery-three-quarters', 'battery-half', 'battery-quarter', 'battery-empty', 'mouse-pointer', 'i-cursor', 'object-group', 'object-ungroup', 'sticky-note', 'sticky-note-o', 'cc-jcb', 'cc-diners-club', 'clone', 'balance-scale', 'hourglass-o', 'hourglass-start', 'hourglass-half', 'hourglass-end', 'hourglass', 'hand-rock-o', 'hand-paper-o', 'hand-scissors-o', 'hand-lizard-o', 'hand-spock-o', 'hand-pointer-o', 'hand-peace-o', 'trademark', 'registered', 'creative-commons', 'gg', 'gg-circle', 'tripadvisor', 'odnoklassniki', 'odnoklassniki-square', 'get-pocket', 'wikipedia-w', 'safari', 'chrome', 'firefox', 'opera', 'internet-explorer', 'television', 'contao', '500px', 'amazon', 'calendar-plus-o', 'calendar-minus-o', 'calendar-times-o', 'calendar-check-o', 'industry', 'map-pin', 'map-signs', 'map-o', 'map', 'commenting', 'commenting-o', 'houzz', 'vimeo', 'black-tie', 'fonticons', 'reddit-alien', 'edge', 'credit-card-alt', 'codiepie', 'modx', 'fort-awesome', 'usb', 'product-hunt', 'mixcloud', 'scribd', 'pause-circle', 'pause-circle-o', 'stop-circle', 'stop-circle-o', 'shopping-bag', 'shopping-basket', 'hashtag', 'bluetooth', 'bluetooth-b', 'percent', 'gitlab', 'wpbeginner', 'wpforms', 'envira', 'universal-access', 'wheelchair-alt', 'question-circle-o', 'blind', 'audio-description', 'volume-control-phone', 'braille', 'assistive-listening-systems', 'american-sign-language-interpreting', 'deaf', 'glide', 'glide-g', 'sign-language', 'low-vision', 'viadeo', 'viadeo-square', 'snapchat', 'snapchat-ghost', 'snapchat-square', 'pied-piper', 'first-order', 'yoast', 'themeisle', 'google-plus-official', 'font-awesome', 'handshake-o', 'envelope-open', 'envelope-open-o', 'linode', 'address-book', 'address-book-o', 'address-card', 'address-card-o', 'user-circle', 'user-circle-o', 'user-o', 'id-badge', 'id-card', 'id-card-o', 'quora', 'free-code-camp', 'telegram', 'thermometer-full', 'thermometer-three-quarters', 'thermometer-half', 'thermometer-quarter', 'thermometer-empty', 'shower', 'bath', 'podcast', 'window-maximize', 'window-minimize', 'window-restore', 'window-close', 'window-close-o', 'bandcamp', 'grav', 'etsy', 'imdb', 'ravelry', 'eercast', 'microchip', 'snowflake-o', 'superpowers', 'wpexplorer', 'meetup'];
        $scope.selectedIcon = 'fa-smile-o';
        $scope.selectedIconText = 'smile-o';

        $scope.searchText = '';

        $scope.selectIcon = function (icon) {
            $scope.selectedIconText = icon;
            $scope.selectedIcon = 'fa-' + icon;
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };

        $scope.insert = function () {
            $uibModalInstance.close({
                icon: $scope.selectedIcon,
                text: $scope.selectedIconText
            });
        };
        
    };

    var postModal = function ($scope, $uibModalInstance, $uibModal, postsService, tags, id) {
        $scope.id = id;
        $scope.title = null;
        $scope.entry = null;
        $scope.tags = tags;
        $scope.iconDetails = null;
        $scope.main = false;
        $scope.news = false;

        $scope.save = function () {

            $scope.entry = $('#postModal-entry').redactor('code.get');
            
            var tags = $scope.tags.split(',');
            if ($scope.main) {
                if (tags.indexOf("Main") < 0) {
                    tags.push('Main');
                }
            }
            if ($scope.news) {
                if (tags.indexOf("News") < 0) {
                    tags.push('News');
                }
            }

            var postDetails = {
                id: $scope.id,
                title: $scope.title,
                entry: $scope.entry,
                tags: tags.join(','),
                icon: ($scope.iconDetails ? $scope.iconDetails.icon : null)
            };
            
            $uibModalInstance.close({
                postDetails: postDetails
            });
        };

        $scope.clearIcon = function () {
            $scope.iconDetails = null;
        };

        $scope.selectIcon = function () {
            var modalInstance = $uibModal.open({
                templateUrl: 'iconModal.html',
                controller: 'iconModal',
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                size: 'lg'
            });

            modalInstance.result.then(
                function (results) {
                    // closed
                    $scope.iconDetails = results;
                },
                function () {
                    // dismissed
                });
    
        };


        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };

        if (id) {
            postsService.edit(id)
            .then(function (data) {
                var tags = data.tags.split(',');
                var i = tags.indexOf("Main");
                if (i > -1) {
                    $scope.main = true;
                    tags.splice(i, 1);
                }
    
                i = tags.indexOf("News");
                if (i > -1) {
                    $scope.news = true;
                    tags.splice(i, 1);
                }
    
                $scope.entry = (data.entry ? data.entry.value : null);
                if ($scope.entry && $scope.entry.length > 7 && $scope.entry.substring(0, 6).toLowerCase() === "<p><i ") {
                    var entryParts = $scope.entry.split('</i>')
                    $scope.iconDetails = {
                        icon: entryParts[0].split('"')[1].replace('fa ', ''),
                        text: entryParts[0].split('"')[1].replace('fa fa-', ''),
                    };
                    entryParts[0] = null;
                    $scope.entry = '<p>' + entryParts.join('');
                }

                $scope.id = id;
                $scope.title = data.title;
                $scope.tags = tags.join(',');
                $('textarea.redactor').redactor('code.set', $scope.entry);
            });
        }

    };

    var frontEndController = function ($scope, $uibModal, postsService) {
        var self = this;

        self.editPost = function (tags, id) {
            var modalInstance = $uibModal.open({
                templateUrl: 'postModal.html',
                controller: 'postModal',
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                size: 'lg',
                resolve: {
                    tags: function () {
                        return tags;
                    },
                    id: function () {
                        return id
                    }
                }
            });

            modalInstance.result.then(
                function (results) {
                    // closed
                    var details = results.postDetails;
                    if (details) {                        
                        postsService.store(details)
                            .then(function (data) {
                                location.reload();
                            });
                    }
                },
                function () {
                    // dismissed
                });

            modalInstance.rendered.then(
                function () {
                    // Now that it's opened run redactor
                    $('textarea.redactor').redactor(_redactorConfig);
                },
                function () {
                    // dismissed
                });
    
        };
        
        self.start = function () {
        };
    };

    angular.module('getrealt', ['getrealt.rest', 'ui.bootstrap'])
        .factory('eventFactory', ['$rootScope', eventFactory])
        .service('listingService', ['$q', '$http', 'restService', listingService])
        .service('postsService', ['$q', '$http', 'restService', postsService])
        .controller('searchWidget', ['$scope', 'eventFactory', 'listingService', searchWidget])
        .controller('listingsWidget', ['$scope', 'eventFactory', listingsWidget])
        .controller('listingDetails', ['$scope', '$uibModal', 'listingService', listingDetails])
        .controller('contactAgentModal', ['$scope', '$uibModalInstance', 'parentController', contactAgentModal])
        .controller('messageConfirmationModal', ['$scope', '$uibModalInstance', 'message', messageConfirmationModal])
        .controller('iconModal', ['$scope', '$uibModalInstance', iconModal])
        .controller('postModal', ['$scope', '$uibModalInstance', '$uibModal', 'postsService', 'tags', 'id', postModal])
        .controller('frontEndController', ['$scope', '$uibModal', 'postsService', frontEndController])
        .directive('ngEnter', function () {
            return function (scope, element, attrs) {
                element.bind("keydown keypress", function (event) {
                    if (event.which === 13) {
                        scope.$apply(function () {
                            scope.$eval(attrs.ngEnter, { 'event': event });
                        });

                        event.preventDefault();
                    }
                });
            };
        });

})();


