<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\TranslationTrait;

class PaymentController extends Controller
{

    use TranslationTrait;

    public function __construct() {

        $this->authorizeResource(Payment::class);

    }

//    public function validation(Request $request) {
//
//        $validation = [
//
//        ];
//
//        $request->validate(
//            $validation
//        );
//
//    }

    public function index()
    {

        $payment = Payment::all();

        return view('admin.tab-payments.view')
            ->with(compact('payment'));

    }


    public function show(Payment $payment) {

        return view('admin.tab-payments.view')->with([
                'payment'  => $payment
            ]
        );

    }

}
