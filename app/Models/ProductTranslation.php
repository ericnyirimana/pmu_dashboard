<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{


  protected $fillable = ['product_id', 'name', 'description', 'ingredients', 'categories', 'allergens', 'dietary', 'code'];


    public function getCategoriesArrayAttribute() {

        $categories = explode(',', $this->categories);

        return $categories;


    }

    public function getAllergensArrayAttribute() {

        $allergens = explode(',', $this->allergens);

        return $allergens;


    }

    public function getDietaryArrayAttribute() {

        $dietary = explode(',', $this->dietary);

        return $dietary;


    }

}
