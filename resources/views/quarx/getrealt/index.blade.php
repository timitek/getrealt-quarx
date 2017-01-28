@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">GetRealT</h1>
    </div>


    @include('GetRealT::quarx.getrealt.breadcrumbs', ['location' => ['settings']])

    <div class="row">
        {!! Form::open(['route' => 'quarx.getrealt.store', 'class' => 'add']) !!}

            {!! FormMaker::fromObject(GetRealT::getSettings(), GetRealT::getSettingsForm()) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/getrealt') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

@section('javascript')

    @parent
    <script type="text/javascript">

        // add js here

    </script>

@endsection


