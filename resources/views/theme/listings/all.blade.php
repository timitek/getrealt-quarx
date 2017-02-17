@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget('Listings', null)

<div class="container">

    <div class="section-pad"></div>

    <div class="row">
        <div class="col-xs-12">
            @searchWidget()
        </div>
    </div>
    
    @listingResultsWidget()

</div>

@endsection

@section('quarx')
    @edit('getrealt')
@endsection