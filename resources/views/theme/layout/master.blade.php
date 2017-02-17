<!doctype html>

<html lang="en" ng-app="getrealt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <title>Website</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/getrealt/css/' . config('getrealt.theme') . '.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/getrealt/flexslider/flexslider.css') }}">
        <script type="text/javascript" data-pace-options='{ "startOnPageLoad": false }' src="{{ asset('assets/themes/getrealt/js/pace.min.js') }}"></script>
        @yield('stylesheets')
    </head>

    <body>

        @theme('partials.navigation')

        <div class="site-wrapper @if(Request::is('/')) homepage @endif">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>










        <footer class="footer">
            <div class="container">
                <div class="row">

                    <!-- col #1 -->
                    <div class="logo_footer dark col-md-3">
                        <h4>Contact <strong>Us</strong></h4>
                        <p class="block">
                            4th Street, Suite 88<br>
                            New York NY 10887<br>
                            Email: youremail@yourdomain.com<br>
                            Phone: +40 (0) 111 1234 567<br>
                            Fax: +40 (0) 111 1234 568<br>
                        </p>

                        <p class="block"><!-- social -->
                            <a class="social social-fb" href="#"><i class="fa fa-facebook"></i></a>
                            <a class="social social-linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                            <a class="social social-instagram" href="#"><i class="fa fa-instagram"></i></a>
                            <a class="social social-pinterest" href="#"><i class="fa fa-pinterest"></i></a>
                            <a class="social social-twitter" href="#"><i class="fa fa-twitter"></i></a>
                            <a class="social social-tumblr" href="#"><i class="fa fa-tumblr"></i></a>
                            <a class="social social-youtube" href="#"><i class="fa fa-youtube"></i></a>
                        </p><!-- /social -->
                    </div>
                    <!-- /col #1 -->

                    <!-- col #2 -->
                    <div class="spaced col-md-3 col-sm-4 hidden-xs">
                        <h4>Recent <strong>Posts</strong></h4>
                        <ul class="list-unstyled">
                            <li>
                                <a class="block" href="#">New CSS3 Transitions this Year</a>
                                <small>June 29, 2014</small>
                            </li>
                            <li>
                                <a class="block" href="#">Inteligent Transitions In UX Design</a>
                                <small>June 29, 2014</small>
                            </li>
                            <li>
                                <a class="block" href="#">Lorem Ipsum Dolor</a>
                                <small>June 29, 2014</small>
                            </li>
                        </ul>
                    </div>
                    <!-- /col #2 -->

                    <!-- col #3 -->
                    <div class="spaced col-md-3 col-sm-4 hidden-xs">
                        <h4>Recent <strong>Tweets</strong></h4>
                        <ul class="list-unstyled fsize13">
                            <li>
                                <i class="fa fa-twitter"></i> <a href="#">@John Doe</a> Pilsum dolor lorem sit consectetur adipiscing orem sequat <small class="ago">8 mins ago</small>
                            </li>
                            <li>
                                <i class="fa fa-twitter"></i> <a href="#">@John Doe</a> Remonde sequat ipsum dolor lorem sit consectetur adipiscing  <small class="ago">8 mins ago</small>
                            </li>
                            <li>
                                <i class="fa fa-twitter"></i> <a href="#">@John Doe</a> Imperdiet condimentum diam dolor lorem sit consectetur adipiscing <small class="ago">8 mins ago</small>
                            </li>
                        </ul>
                    </div>
                    <!-- /col #3 -->

                    <!-- col #4 -->
                    <div class="spaced col-md-3 col-sm-4">
                        <h4>About <strong>Us</strong></h4>
                        <p>
                            Incredibly beautiful responsive Bootstrap Template for Corporate and Creative Professionals.
                        </p>

                        <h4><small><strong>Subscribe to our Newsletter</strong></small></h4>
                        <form method="get" action="#" class="input-group">
                            <input required="" type="email" class="form-control" name="email" id="email" value="" placeholder="E-mail Address">
                            <span class="input-group-btn">
                                <button class="btn btn-primary">SUBMIT</button>
                            </span>
                        </form>

                    </div>
                    <!-- /col #4 -->

                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <p class="pull-left">&copy; {{ date('Y') }}</p>
                        @can('quarx')
                        <a class="btn btn-xs btn-default pull-right" href="{{ url('quarx/dashboard') }}">Quarx</a>
                        @yield('quarx')
                        @else
                        <a class="btn btn-xs btn-default pull-right" href="{{ url('login') }}">Login</a>
                        @endcan
                    </div>
                </div>

            </div>
        </footer>

    </body>

    <script type="text/javascript">
        var _token = '{!! Session::token() !!}';
        var _url = '{!! url("/") !!}';
    </script>
    @yield("pre-javascript")
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap-tpls.min.js"></script>    
    <script type="text/javascript" src="{{ asset('assets/themes/getrealt/flexslider/jquery.flexslider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/themes/getrealt/js/parallax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/themes/getrealt/js/polly.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/themes/getrealt/js/rest.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/themes/getrealt/js/getrealt.js') }}"></script>
    @yield('javascript')
</html>
