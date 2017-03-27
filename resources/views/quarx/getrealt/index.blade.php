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
                    With many of the Quarx modules you can perform a Rollback or Revert to an earlier moment in history. In pages for example if you click Rollback, you will go back to the most recently saved version of the post. However, you can only go back once, or rather undo, it does not keep digging through history. If you would like to go further back, visit the pages History and you will find different edits, you can revert to any of these with just a single click.
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
                        </li>
                        <li class="<?= (Request::is('quarx/getrealt/contact') || Request::is('quarx/getrealt/contact/*')) ? 'active' : '' ?>">
                            <a href="<?= url('quarx/getrealt/contact') ?>"><span class="fa fa-address-book"></span> Contact</a>
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