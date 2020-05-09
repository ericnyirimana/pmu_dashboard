<?php

namespace App\Libraries;

use Ahc\Jwt\JWT;
use Carbon\Carbon;

class BasicToken
{



    public static function generate() {


        $jwt = new JWT(env('JWT_SECRET'), 'HS256', 3600, 10);


        // Create custom claims
        $claims = [
            'plataform' => 'Web',
            'jti' => '21320234022',
            'exp' => Carbon::now()->addMinutes(1)->timestamp,
            'nbf' => 0,
            'iat' => Carbon::now()->timestamp,
        ];

        return $jwt->encode($claims);


    }
}
