<?php

namespace App\Observers;

class ProductTranslationObserver
{



  public function saving(\App\Models\ProductTranslation $translation) {

          $translation->categories = implode(',', $translation->categories);
          $translation->allergens = implode(',', $translation->allergens);
          $translation->dietary = implode(',', $translation->dietary);

  }

}
