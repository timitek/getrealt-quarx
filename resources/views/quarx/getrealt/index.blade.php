@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header text-center">GetRealT</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-default panel-help">
                <div class="panel-heading"><b>About</b></div>
                <div class="panel-body">
                    GetRealT is a powerful tool to deliver your personalized web content and MLS listings by combining <a href="http://www.timitek.com/" target="_blank">GetRETS by timitek</a>
                    with the CMS capabilities of <a href="http://www.timitek.com/quarx" target="_blank">Quarx</a>, backed with the flexibility of the popular PHP framework
                    <a href="https://www.laravel.com/" target="_blank">Laravel</a>.<br /><br />
                    <strong>All combined you have a powerful real estate web website in a box!</strong><br /><br />
                    Get started with the following links.
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-default panel-help">
                <div class="panel-heading"><b><span class="fa fa-link"></span> Links</b></div>
                <div class="panel-body">
                    <ul>
                        <li class="<?= (Request::is('quarx/getrealt/settings') || Request::is('quarx/getrealt/settings/*')) ? 'active' : '' ?>">
                            <a href="<?= url('quarx/getrealt/settings') ?>"><span class="fa fa-gear"></span> Settings</a>
                            - Provide your customer key supplied by timitek and other important settings.
                        </li>
                        <li class="<?= (Request::is('quarx/getrealt/contact') || Request::is('quarx/getrealt/contact/*')) ? 'active' : '' ?>">
                            <a href="<?= url('quarx/getrealt/contact') ?>"><span class="fa fa-address-book"></span> Contact</a>
                            - Set up the contact widget for your home page.
                        </li>
                        <li>
                            <a href="<?= url('quarx/blog/create?taginit=Welcome') ?>"><span class="fa fa-info-circle"></span> Create Welcome Section</a>
                            - Create a welcome section for your home page.
                        </li>
                        <li>
                            <a href="<?= url('quarx/blog/create?taginit=Featured') ?>"><span class="fa fa-info-circle"></span> Create Featured Item</a>
                            - Create a featured item on your home page. <em>(Start your content with an icon for it to be emphasized within the section).</em>
                        </li>
                        <li>
                            <a href="<?= url('quarx/blog/create?taginit=Testimonial') ?>"><span class="fa fa-info-circle"></span> Create Testimonial</a>
                            - Create a testimonial on your home page. <em>(If your post starts with an image, it will appear within the quote).</em>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')

    @parent
    <script type="text/javascript">

        // add js here

    </script>

@endsection