<?php

namespace App\Observers;

class ProductObserver
{



  public function saving(\App\Models\Product $product) {

          $product->price = str_replace(',', '.', $product->price);

  }

}
