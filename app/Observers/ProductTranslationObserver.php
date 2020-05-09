<?php

namespace App\Observers;

class ProductTranslationObserver
{



  public function saving(\App\Models\ProductTranslation $translate) {

          if(!empty($translate->categories)) {
              $translate->categories = implode(',', $translate->categories);
          }
          if(!empty($translate->allergens)) {
              $translate->allergens = implode(',', $translate->allergens);
          }
          if(!empty($translate->dietary)) {
              $translate->dietary = implode(',', $translate->dietary);
          }

  }

}
