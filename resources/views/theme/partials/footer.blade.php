<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-4">
                <h4>Contact <strong>Us</strong></h4>
                @widget('contact')
            </div>

            <div class="footer-bp-widget hidden-xs col-sm-6 col-md-4">
                <h4>Recent <strong>Posts</strong></h4>
                @recentBlogPostsWidget('main', 5)
            </div>

            <div class="footer-bp-widget hidden-xs hidden-sm col-md-4">
                <h4>Recent <strong>News</strong></h4>
                @recentBlogPostsWidget('news', 5)
            </div>

        </div>

        <div class="row footer-final">
            <div class="col-xs-12">
                <span>&copy; {{ date('Y') }} • All Right Reserved</span>
                @can('quarx')
                <a class="btn btn-xs btn-default pull-right" href="{{ url('quarx/dashboard') }}">Admin</a>
                @yield('quarx')
                @else
                <a class="btn btn-xs btn-default pull-right" href="{{ url('login') }}">Login</a>
                @endcan
            </div>
        </div>

    </div>
</footer>