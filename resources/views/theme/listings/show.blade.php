@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $listing->description }} @endsection
@section('seoKeywords') {{ $listing->description }} @endsection

@section('content')

<div class="container">

    <h1>{!! $listing->description !!}</h1>

</div>

@endsection

@section('quarx')
    @edit('getrealt')
@endsection
