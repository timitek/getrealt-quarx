<nav class="navbar navbar-default navbar-fixed-top clearfix">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('') }}">Home</a>
        </div>
        <div class="collapse navbar-collapse" id="navBar">
            <ul class="nav navbar-nav">
                @php
                    $mainMenu = Quarx::menu('main');
                @endphp
                
                @if (!empty($mainMenu))
                    {!! str_replace( '</a>', '</a></li>', str_replace( '<a ', '<li><a ', $mainMenu)) !!}
                @else
                    <li><a href="{{ url('blog') }}">Blog</a></li>
                    <li><a href="{{ url('gallery') }}">Gallery</a></li>
                    <li><a href="{{ url('faqs') }}">FAQs</a></li>
                    <li><a href="{{ url('events') }}">Events</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>