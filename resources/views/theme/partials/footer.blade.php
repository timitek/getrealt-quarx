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
            <div class="recent-posts col-md-3 col-sm-4 hidden-xs">
                <h4>Recent <strong>Posts</strong></h4>
                @recentBlogPostsWidget('main', 5)
            </div>
            <!-- /col #2 -->

            <!-- col #3 -->
            <div class="recent-posts col-md-3 col-sm-4 hidden-xs">
                <h4>Recent <strong>News</strong></h4>
                @recentBlogPostsWidget('news', 5)
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