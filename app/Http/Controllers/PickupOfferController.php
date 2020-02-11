<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PickupOffer;
use App\Models\Pickup;

class PickupOfferController extends Controller
{

  public function index() {


  }



  public function show(PickupOffer $offer) {


      foreach($offer->products as $product) {
        dd($product->section->menu);
      }


  }

}
