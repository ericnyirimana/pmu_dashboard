<?php

namespace App\Observers;
use Illuminate\Support\Str;

class PositionObserver
{


    public function creating($model) {

            $model->identifier = (string) Str::uuid();

    }
}
