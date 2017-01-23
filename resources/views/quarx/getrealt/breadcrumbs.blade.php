<div class="row">
    <ol class="breadcrumb">
        <li><a href="{!! url('quarx/getrealt') !!}">GetRealT</a></li>

        @foreach($location as $local)

            <li>{!! ucfirst($local) !!}</li>

        @endforeach
        <li class="active"></li>
    </ol>
</div>