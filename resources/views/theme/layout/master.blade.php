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
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/getrealt/css/' . (empty(config('getrealt.theme')) ? 'united' : config('getrealt.theme')) . '.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/themes/getrealt/flexslider/flexslider.css') }}">
        <script type="text/javascript" data-pace-options='{ "startOnPageLoad": false, "ajax": { "trackMethods": ["GET", "POST"] } }' src="{{ asset('assets/themes/getrealt/js/pace.min.js') }}"></script>
        @yield('stylesheets')
    </head>

    <body>

        @theme('partials.navigation')

        <div class="site-wrapper @if(Request::is('/')) homepage @endif">
            @yield('content')
        </div>

        @theme('partials.footer')

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
    <script type="text/javascript" src="{{ asset('assets/themes/getrealt/js/vendor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/themes/getrealt/js/getrealt-frontend.min.js') }}"></script>
    @yield('javascript')
</html>
