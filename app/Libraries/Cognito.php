<?php

namespace App\Libraries;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use GuzzleHttp\Client;
use Session;
use Carbon\Carbon;

class Cognito
{


      /**
      * Client from CognitoIdentityProviderClient
      * @var Object
      */
      public $client;

      /**
      * Token from CognitoIdentityProviderClient
      * @var String
      */
      private $token;

      /**
      * User Data from CognitoIdentityProviderClient getUser
      * @var Object
      */
      public $user;

      /**
      * User Attributes from CognitoIdentityProviderClient getUser->get('UserAttributes')
      * @var Array
      */
      public $userAttributes;

      /**
      * Message Error for Exception
      * @var String
      */
      public $error = null;



      /**
      * Call Cognito Provider
      * @var String
      */
      public function __construct($token) {

            $this->token = $token;

            if (!$token) return false;

            $client = $this->getClient();

            if ($client) {

              $this->refreshExpiredToken();

              $this->getUser();

            }

            return $this;

      }



      private function getClient() {


            try {

              $client = new CognitoIdentityProviderClient([
                   'version' => env('AWS_COGNITO_VERSION'),
                   'region' => env('AWS_COGNITO_REGION'),
               ]);

            } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {

                  $message = $e->getResponse();
                  $this->error = $message->getHeaders()['x-amzn-ErrorMessage'][0];

                  return false;


            } catch (\Exception $e) {

                  $this->error = $e->getMessage();

                  return false;

            }

            $this->client = $client;

            return $client;


      }



      private function getUser() {

            try {

              $user = $this->client->getUser([
                'AccessToken' => $this->token
              ]);

            } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {

                  $message = $e->getResponse();
                  $this->error = $message->getHeaders()['x-amzn-ErrorMessage'][0];
                  return false;


            } catch (\Exception $e) {

                  $this->error = $e->getMessage();
                  return false;

            }

            $this->user = $user;
            $this->UserAttributes = $user->get('UserAttributes');

            return $user;


      }


      public function user() {

            $user = new \StdClass;
            $user->name   = $this->search('name');
            $user->email  = $this->search('email');

            return $user;

      }



      private function search($search) {

          $attributes = $this->UserAttributes;

          foreach($attributes as $key=>$attr) {

              if ($attr['Name'] == $search) {

                  return $attr['Value'];

              }

          }

          return false;

      }



      public function hasValidToken() {

          return  $this->getUser() ? true : false;
      }



      public function refreshToken() {

            $guzzleClient = new Client();

            try {

                  $result = $this->client->InitiateAuth([
                      'AuthFlow' => 'REFRESH_TOKEN_AUTH',
                      'ClientId' => env('AWS_COGNITO_CLIENT_ID'),
                      'UserPoolId' => env('AWS_COGNITO_USER_POOL_ID'),
                      'AuthParameters' => [
                          'REFRESH_TOKEN' => Session::get('PMURefreshToken'),
                          'DEVICE_KEY' => null
                      ],
                  ]);


             } catch (\GuzzleHttp\Exception\ClientException $e) {

                  $this->error = trans('Token Not Authorized');
                  return false;

             } catch (\Symfony\Component\Debug\Exception\FatalThrowableError $e) {

                  $this->error = 'error 1';
                  return false;

             } catch (\Exception $e) {

                  $this->error = $e;
                  return false;
             }


           if ($result) {

                 $authToken = $result->get('AuthenticationResult');
                 $token = $authToken['AccessToken'];

                 Session::put('PMUAccessToken', $authToken['AccessToken']);

                 $this->token = $authToken['AccessToken'];

           }


      }



      public function refreshExpiredToken() {

        $payload = $this->getPayload();

        $dateToken = Carbon::createFromTimestamp($payload->exp);
        $dateNow = Carbon::now('UTC');

        $expired = $dateToken->lessThan($dateNow);

        if ($expired === true) {

            $this->refreshToken();

        }


        return true;


      }


      /**
     * URL safe base64 decode.
     *
     * @param array|string $data
     * @param bool         $asJson Whether to parse as JSON (defaults to true).
     *
     * @throws JWTException When JSON encode fails.
     *
     * @return array|\stdClass|string
     */
      protected function getPayload() {


          $seqToken = explode('.', $this->token);
          $data = $seqToken[1];
          $data = \json_decode(\base64_decode(\strtr($data, '-_', '+/')));

          return $data;
      }



      public function deleteTokens() {

              Session::forget('PMUAccessToken');
              Session::forget('PMURefreshToken');

      }

}
