<?php

namespace App\Observers;

class ProductTranslationObserver
{



  public function saving(\App\Models\ProductTranslation $translation) {

          if(!empty($translation->categories)) {
              $translation->categories = implode(',', $translation->categories);
          }
          if(!empty($translation->allergens)) {
              $translation->allergens = implode(',', $translation->allergens);
          }
          if(!empty($translation->dietary)) {
              $translation->dietary = implode(',', $translation->dietary);
          }

  }

}
