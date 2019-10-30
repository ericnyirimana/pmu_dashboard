<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PingController extends Controller
{



    public function ping() {

        return response()->json(['ping' => 'success'], 200);

    }

    public function pong() {

        return response()->json(['pong' => 'success'], 200);

    }
}
