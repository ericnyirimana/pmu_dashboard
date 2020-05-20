<div class="container-plate-preview" data-id="{{ $product->id }}" id="item-{{ $product->id }}">
    <figure><i class="fa fa-file-image-o fa-2x"></i></figure>
    {{--<figure>{{ $product->media_id }}</figure>--}}
    <div class="plate-preview-text">
        <h4>{{ $product->translate->name }}</h4>
        <p>{{ $product->translate->description }}</p>
    </div>
    <div class="plate-preview-price">
        € {{ $product->price }}
    </div>
    <div class="plate-preview-actions">
        <div class="plate-action-icon plate-move">
            <i class="fa fa-arrows text-dark"></i>
        </div>
        @if(!$product->hasActivePickups())
            <div class="plate-action-icon plate-edit plate-remove" data-type="item"
                 data-name="{{ $product->translate->name }}" data-section_id="{{ $section->id }}"
                 data-product_id="{{ $product->id }}" data-toggle="modal" data-target=".remove-register">
                <i class="fa fa-trash text-danger"></i>
            </div>
        @endif
    </div>
</div>
