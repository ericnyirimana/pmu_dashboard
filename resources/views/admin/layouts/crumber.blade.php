<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">{{ ucfirst(trans('crumb.page_title.' . $crumber[0])) }}</h4>
            @if(Auth::user()->is_owner && !empty($restaurants))
                <select>
                    <option value=""></option>
                    @foreach($restaurants as $k => $v)
                        <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>
            @endif
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
            <div class="clearfix"></div>
        </div>
    </div>
</div>
