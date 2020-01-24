<div class="container-plate-preview" data-id="{{ $product->id }}">
    <figure><i class="fa fa-file-image-o fa-2x"></i></figure>
    <div class="plate-preview-text">
      <h4>{{ $product->translation->name }}</h4>
      <p>{{ $product->translation->description }}</p>
    </div>
    <div class="plate-preview-price">
        € {{ $product->price }}
    </div>
    <div class="plate-preview-actions">
          <div class="plate-action-icon plate-move">
              <i class="fa fa-arrows"></i>
          </div>
          <div class="plate-action-icon plate-edit">
              <i class="fa fa-trash"></i>
          </div>
    </div>
</div>
