<div class="row">

  <div class="col-12">
      <h4>{{ $product->type }}</h4>
      <field-hide field="type" :model="$product" />
  </div>

</div>
<div class="row">
  <company-restaurant-select :model="$product" />
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
          <field-media-list label="Image" field="media_id" :model="$product" required />
    </div>
</div>

<div class="d-flex flex-row row mt-5">
  <div class="col-12">
        {{--@if(Auth::user()->is_super)--}}
          {{--<div class="form-group">--}}
              {{--<button type="submit" class="btn btn-block w-lg btn-success float-left col-6">{{ ucfirst(trans('button.save')) }}</button>--}}
              {{--<button type="submit" class="btn btn-block w-lg btn-primary float-right col-6">{{ ucfirst(trans('button.approves')) }}</button>--}}
          {{--</div>--}}
        {{--@else--}}
          {{--<div class="form-group">--}}
              {{--<button type="submit" class="btn btn-block w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>--}}
              {{--<button type="submit" class="btn btn-block w-lg btn-primary float-right col-6">{{ ucfirst(trans('button.send_approves')) }}</button>--}}
      {{--</div>--}}
        {{--@endif--}}
      <button type="submit" class="btn btn-block w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>

  </div>
</div>
