<?php

namespace App\Observers;
use Illuminate\Support\Str;

class IdentifierObserver
{


    public function creating($model) {

            $model->identifier = (string) Str::uuid();

    }
}
