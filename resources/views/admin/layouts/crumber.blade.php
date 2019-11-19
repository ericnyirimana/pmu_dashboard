<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">{{ ucfirst($crumber[0]) }}</h4>

            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Admin</a></li>
                @foreach($crumber as $value)
                <li class="breadcrumb-item active"><a href="{{ route( implode('.', $crumber) ) }}">{{ ucfirst($value) }}</a></li>
                @endforeach

            </ol>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
