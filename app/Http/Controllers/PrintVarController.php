<?php

namespace App\Http\Controllers;

use App\Libraries\Cognito;
use App\Models\Pickup;
use App\Models\User;
use App\Services\EmailService;
use App\Services\PurchaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;


class PrintVarController extends Controller
{

    protected $pickups;
    protected $products;
    protected $outOfStock = null;
    protected $pickupsNotValid = null;

    protected $purchaseService;
    protected $emailService;

    public function __construct()
    {

        $this->pickupsNotValid = new \StdClass();
        $this->pickupsNotValid->empty = true;
        $this->pickupsNotValid->pickups = array();

        $this->outOfStock = new \StdClass();
        $this->outOfStock->empty = true;
        $this->outOfStock->products = array();
        $this->outOfStock->pickups = array();

    }

    public function closeOrder(Request $request){
        Log::info('Close Orders and capture Payments ( request: {'. $request . '})');

        $client = new Cognito();
        $credentials = array(
            "email"  => 'marco@pickmealup.com',
            "password" => 'Qwerty123'
        );
        $response = $client->authenticate($credentials);

        return response()->json([
            'response'    => $response,
            'credentials' => [
                'key'     => env('AWS_COGNITO_KEY'),
                'secret'  => env('AWS_COGNITO_SECRET'),
            ],
            'version' => env('AWS_COGNITO_VERSION'),
            'region' => env('AWS_COGNITO_REGION'),
            'COGNITO_ID' => env('AWS_COGNITO_CLIENT_ID'),
            'COGNITO_POOL_ID' => env('AWS_COGNITO_USER_POOL_ID'),
            'ENV' => getenv(),
            'Authorization' => $_SERVER
        ], 200);

    }

}
