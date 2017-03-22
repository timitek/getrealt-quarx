@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget('Blog', null)

<div class="container blog-all">

    <div class="row">
        <div class="col-md-9">
            @foreach($blogs as $blog)
                <div class="panel entry-row">
                    <div class="panel-heading">
                        <div class='blog-title'>
                            <a href="{!! URL::to('blog/'.$blog->url) !!}">
                                {!! $blog->title !!} 
                            </a>
                            <div class='published-at'><i class="fa fa-clock-o"></i> {!! \Carbon\Carbon::parse($blog->published_at)->format('d M, Y') !!}</div>
                        </div>
                    </div>
                    <div class="panel-body">
                    {!! str_limit($blog->entry->plain(), 300) !!}
                    </div>
                </div>
            @endforeach

            {!! $blogs !!}
        </div>

        <div class="col-md-3">
            <div class='tags-header'>
                <span class='tag-label'><i class='fa fa-tags'></i> Tags</span>
            </div>
            <div class="blog-tags">
                @foreach($tags as $tag)
                <a href="{{ url('blog/tags/'.$tag) }}" class="label label-primary tag-{{ rand(1,5) }}">{{ $tag }}</a>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @edit('blog')
@endsection