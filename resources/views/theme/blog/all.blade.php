@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget('Blog', null)

<div class="container">

    <div class="row">
        <div class="col-md-8">
            @foreach($blogs as $blog)
                <div class="panel entry-row">
                    <div class="panel-heading">
                        @if (config('app.locale') !== config('quarx.default-language'))
                            @if ($blog->translation(config('app.locale')))
                                <a href="{!! URL::to('blog/'.$blog->translation(config('app.locale'))->data->url) !!}"><p>{!! $blog->translation(config('app.locale'))->data->title !!} - <span>{!! $blog->published_at !!}</span></p></a>
                            @endif
                        @else
                            <a href="{!! URL::to('blog/'.$blog->url) !!}"><p>{!! $blog->title !!} - <span>{!! \Carbon\Carbon::parse($blog->published_at)->format('d M, Y') !!}</span></p></a>
                        @endif
                    </div>
                    <div class="panel-body">
                    {!! str_limit($blog->entry->plain(), 300) !!}
                    </div>
                </div>
            @endforeach

            {!! $blogs !!}
        </div>

        <div class="col-md-4">
            @foreach($tags as $tag)
                <a href="{{ url('blog/tags/'.$tag) }}" class="btn btn-default">{{ $tag }}</a>
            @endforeach
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @edit('blog')
@endsection