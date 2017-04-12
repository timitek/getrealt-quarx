@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget('Gallery', null)

<div class="container blog-all">

    <div class="row">
        <div class="col-md-9">
            <div class="row">
                @foreach ($images as $key=>$image)
                <div class="col-md-6">
                    <div class="panel entry-row">
                        <div class="panel-heading">
                            <div class='blog-title'>
                                @if (!empty($image->title_tag))
                                <a href="{{ $image->url }}" target="_blank">
                                    {!! empty($image->title_tag) ? (empty($image->name) ? '[Unnamed]' : $image->name) : $image->title_tag !!} 
                                </a>
                                @endif
                                <div class='published-at'><i class="fa fa-clock-o"></i> {!! \Carbon\Carbon::parse($image->created_at)->format('d M, Y') !!}</div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <a href="{{ $image->url }}" target="_blank">
                                <img class="thumbnail img-responsive" alt="{{ $image->alt_tag }}" src="{{ $image->url }}" />
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-3">
            <div class='tags-header'>
                <span class='tag-label'><i class='fa fa-tags'></i> Tags</span>
            </div>
            <div class="blog-tags">
                @foreach($tags as $tag)
                <a href="{{ url('gallery/'.$tag) }}" class="label label-primary tag-{{ rand(1,5) }}">{{ $tag }}</a>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @edit('images')
@endsection