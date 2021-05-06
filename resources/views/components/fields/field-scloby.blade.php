<div class="row">
    <div class="col-md-3 col-lg-3 pt-4">
        <div class="form-group form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="scloby" id="scloby" @if($model == null) value="disable" @else value="active" checked @endif/>
            <label class="form-check-label" for="scloby">
                {{ ucfirst(trans('labels.enable_scloby')) }}
            </label>
        </div>
    </div>
    <div class="col-md-9 col-lg-9">
        <div class="form-group">
            <label for="scloby_token">
                Scloby Token
            </label>
            <input class="form-control" type="text" placeholder="Token" name="scloby_token" id="scloby_token"  @if($model !== null && isset($model['access_token']))  value="{{ $model['access_token']['S'] }}" @else disabled @endif/>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="form-group">
        @if(Auth::user()->is_super)
            <label for="scloby_token">
                Department ID
            </label>
        @endif
            <input class="form-control" @if(Auth::user()->is_super) type="number" @else type="hidden" @endif placeholder="Department ID" name="department_id" id="department_id"  @if($model !== null && isset($model['department_id']))  value="{{ $model['department_id']['N'] }}" @else value="0" disabled @endif/>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="form-group">
        @if(Auth::user()->is_super)
            <label for="scloby_token">
                Category ID
            </label>
        @endif
            <input class="form-control" @if(Auth::user()->is_super) type="number" @else type="hidden" @endif placeholder="Category ID" name="category_id" id="category_id"  @if($model !== null && isset($model['category_id']))  value="{{ $model['category_id']['N'] }}" @else value="0" disabled @endif/>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#scloby', function () {
                if($(this).prop("checked") == true){
                    $( "#scloby_token" ).prop( "disabled", false);
                    $( "#department_id" ).prop( "disabled", false);
                    $( "#category_id" ).prop( "disabled", false);
                    $(this).val('active');
                }
                else{
                    $( "#scloby_token" ).prop( "disabled", true);
                    $( "#department_id" ).prop( "disabled", true);
                    $( "#category_id" ).prop( "disabled", true);
                    $(this).val('disable');
                }
            });
        });
    </script>
@endpush