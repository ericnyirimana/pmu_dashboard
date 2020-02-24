<?php

namespace App\Traits;



Trait TranslationTrait {



      public function saveTranslation($model, $fields) {

            $model->translate()->delete();

            $fields['code'] = \App::getLocale();

            $model->translate()->create($fields);

            return $model;

      }

}
