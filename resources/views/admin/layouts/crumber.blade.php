<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">{{ ucfirst($crumber[0]) }}</h4>
            @php /* endphp
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Admin</a></li>

                @php $lastKey = array_key_last($crumber); @endphp

                @foreach($crumber as $k=>$value)
                      <li class="breadcrumb-item active">
                        @if ($k != $lastKey)<a href="{{ route( $value.'.index' ) }}">{{ ucfirst($value) }}</a>
                        @else
                          {{ ucfirst($value) }}
                        @endif
                      </li>
                @endforeach

            </ol>
            @php */ @endphp
            <div class="clearfix"></div>
        </div>
    </div>
</div>
