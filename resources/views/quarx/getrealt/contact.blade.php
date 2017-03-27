@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">GetRealT : Contact</h1>
    </div>


    @include('GetRealT::quarx.getrealt.breadcrumbs', ['location' => ['contact']])
    
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-default panel-help">
                <div class="panel-heading"><b>Contact Widget</b></div>
                <div class="panel-body">
                    The contact section is a provided as a quarx widget.  
                    You can edit the widget directly to customize it, or you can use the form below to create a default contact us widget.
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-default panel-help">
                <div class="panel-heading"><b>Widget Example</b></div>
                <div class="panel-body">
                    <h4>Contact <strong>Us</strong></h4>
                    @widget('Contact')
                </div>
            </div>
        </div>
    </div>
    

    <div class="row">
        {!! Form::open(['route' => 'quarx.getrealt.contact.store', 'class' => 'add']) !!}

            {!! FormMaker::fromObject(GetRealTContact::getContact(), GetRealTContact::getContactForm()) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/getrealt/contact') !!}" class="btn btn-default raw-left">Cancel</a>
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
