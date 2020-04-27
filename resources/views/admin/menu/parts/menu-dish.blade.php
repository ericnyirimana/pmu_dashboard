<div class="row mt-3 container-sections" id="section-{{ $section->id }}"  data-id="{{ $section->id }}">
    <div class="col-12">
        <div class="row bg-dark p-3">
            <div class="col-12 section-header">
                <h4 class="title-section text-white">{{ $section->translate->name }}</h4>
                <div class="actions-section">
                    <i class="fa fa-trash text-danger remove-section" data-type="section" data-name="{{ $section->translate->name }}" data-register="{{ $section->id }}" data-toggle="modal" data-target=".remove-register"></i>
                    <i class="fa fa-edit text-white edit-section" data-type="{{ $section->type }}" data-name="{{ $section->translate->name }}" data-id="{{ $section->id }}"></i>
                    <i class="fa fa-arrows text-white move-section"></i></div>
            </div>

            <div class="col-12 p-3 sortable_dish" id="sortable_dish_{{ $section->id }}">
                  @if( isset($section->products) )
                      @foreach($section->products as $product)
                        @include('admin.menu.parts.menu-dish-item')
                      @endforeach
                  @endif
            </div>
            <div class="col-12 pb-2">
                  @if($section->type == 'Dish')
                  <button type="button" class="btn btn-primary btn-block btn-open-dish" data-section="{{ $section->id }}" ><i class="fa fa-plus"></i> {{ ucfirst(trans('button.add_plate')) }}</button>
                  @else
                  <button type="button" class="btn btn-primary btn-block btn-open-drink" data-section="{{ $section->id }}"><i class="fa fa-plus"></i> {{ ucfirst(trans('button.add_drink')) }}</button>
                  @endif
            </div>
       </div>
    </div>
</div>
