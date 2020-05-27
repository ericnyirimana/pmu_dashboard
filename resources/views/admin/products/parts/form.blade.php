<div class="row">

    <div class="col-12">
        <h4>{{ $product->type }}</h4>
        <field-hide field="type" :model="$product"/>
    </div>

</div>
<div class="row">
    <company-restaurant-select :model="$product"/>
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
        <field-media-list label="image" field="media_id" :model="$product" />
    </div>
</div>

<div class="d-flex flex-row row mt-5">
    <div class="col-12">
        <div class="form-group d-flex align-items-center justify-content-between">
            <button type="submit" class="btn btn-block w-lg btn-success col-5" @if($product->hasActivePickups())
            disabled @endif>
                {{ ucfirst(trans('button.save_draft')) }}
            </button>
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
                <button type="submit"  name="status_product" value="PENDING" class="btn w-lg btn-primary col-5" @if($product->hasActivePickups())
                disabled @endif>
                    {{ ucfirst(trans('button.send_approves')) }}
                </button>
            @endif
        </div>
    </div>
</div>
