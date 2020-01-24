<?php

namespace App\Traits;



Trait TranslationTrait {



      public function saveTranslation($model, $fields) {

            $model->translation()->delete();

            $fields['code'] = \App::getLocale();

            $model->translation()->create($fields);

            return $model;

      }

}
