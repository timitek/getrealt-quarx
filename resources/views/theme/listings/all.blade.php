@extends('quarx-frontend::layout.master')

@section('content')

@parallaxHeaderWidget('Listings', null)

<div class="container">

    <div class="section-pad"></div>


    @if (!empty(config('getrets.customer_key')))
        <div class="row">
            <div class="col-xs-12">
                @searchWidget()
            </div>
        </div>
        
        @listingResultsWidget()
    @else
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger" role="alert">
                    <h1>Customer Key Required!</h1>
                    <p class="lead">
                        <a class="btn btn-xs btn-default" href="{{ url('quarx/getrealt/settings') }}">View Settings</a>
                        <br /><br />
                        If you do not have a customer key, you can obtain an evaluation key from <a href="http://www.timitek.com/" target="_blank">www.timitek.com</a><br />
                    </p>
                </div>
            </div>
        </div>
    @endif

</div>

@endsection

@section('quarx')
    @edit('getrealt')
@endsection