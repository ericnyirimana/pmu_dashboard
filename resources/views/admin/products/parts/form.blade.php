<div class="row">
@if((Route::currentRouteName() == 'products.edit' && !Auth::user()->is_super) && ($product->is_waiting || $product->is_approved))
<div class="alert alert-primary" role="alert">
{{ ucfirst(trans('labels.alert_info_dishes')) }} <a href="mailto:ristoranti@pickmealup.com">ristoranti@pickmealup.com</a>
</div>
@endif
    <div class="col-12">
        <h4>{{ $product->type }}</h4>
        <field-hide field="type" :model="$product"/>
    </div>

</div>
<div class="row">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit))
    <company-restaurant-select :model="$product" disabled/>
@else
    <company-restaurant-select :model="$product" />
@endif
</div>

<div class="row">
    @if($product->type == 'Dish')
        @include('admin.products.parts.dish')
    @endif
    @if($product->type == 'Drink')
        @include('admin.products.parts.drink')
    @endif
</div>

<div class="row">
    <div class="col-4">
        <field-media-list label="image" field="media_id" :model="$product" disabled/>
    </div>
</div>

<div class="d-flex flex-row row mt-5">
    <div class="col-12">
        <div class="form-group d-flex align-items-center justify-content-between">
        @if($product->is_draft || ($product->is_waiting && Auth::user()->is_super) || ($product->is_approved && Auth::user()->is_super) || Route::currentRouteName() == 'products.create.dish' || Route::currentRouteName() == 'products.create.drink')
            <button type="submit" class="btn btn-block w-lg btn-success col-5 js-draft" @if($product->hasActivePickups() || ((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit) && !($product->is_draft)))
            disabled @endif>
                {{ ucfirst(trans('button.save_draft')) }}
            </button>
        @endif
            @if(Auth::user()->is_super)
                @if(!$product->is_approved)
                <button type="submit" name="status_product" value="APPROVED" class="btn w-lg btn-primary col-5" @if($product->hasActivePickups())
                disabled @endif>
                    {{ ucfirst(trans('button.approves')) }}
                </button>
                @else
                 <button type="submit" name="status_product" value="DISABLED" class="btn w-lg btn-primary col-5" @if($product->hasActivePickups())
                 disabled @endif>
                     {{ ucfirst(trans('button.disable'))  }}
                 </button>
                @endif
            @elseif(!Auth::user()->is_super && !$product->is_approved)
                @if(!$product->is_waiting)
                <button type="submit"  name="status_product" value="PENDING" class="btn w-lg btn-primary col-5 js-pending" @if($product->hasActivePickups())
                disabled @endif>
                    {{ ucfirst(trans('button.send_for_approves')) }}
                </button>
                @endif
            @endif
        </div>
    </div>
</div>
@if(!Auth::user()->is_super && !$product->is_approved)
    @include('admin.products.parts.modal-confirmation')
@endif
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.js-draft').click(function(e){
                e.preventDefault()// cancel form submission
                    $('[name="foods[]"]').prop("required", false);
                    $("#name").prop("required", false);
                    $("#price").prop("required", false);
                    $(".submit-form").submit();
            });
            $('.js-pending').click(function(e){
                @if($product->type == 'Drink')
                if($("#name").val().length && $("#price").val().length) {
                    $('#confirm-submit').modal('show');
                    $('.submit-form').append('<input type="hidden" name="status_product" value="PENDING" id="status_product"/>');
                    e.preventDefault()// cancel form submission
                }
                @else
                if($("#name").val().length && $("#price").val().length && $('[name="foods[]"]').val().length) {
                    $('#confirm-submit').modal('show');
                    $('.submit-form').append('<input type="hidden" name="status_product" value="PENDING" id="status_product"/>');
                    e.preventDefault()// cancel form submission
                }
                @endif
            });

            $('#submit-piatti').click(function(){
                /* when the submit button in the modal is clicked, submit the form */
                $('.submit-form').submit();
            });


        });
    </script>
@endpush