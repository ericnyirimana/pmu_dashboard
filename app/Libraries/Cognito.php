<?php

namespace App\Libraries;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use GuzzleHttp\Client;
use Cookie;

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

            $client = $this->getClient();

            if ($client) {

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

          return  ($this->user) ? true : false;
      }


      public function refreshToken() {

            $guzzleClient = new Client();

            try {
                $response = $guzzleClient->request('POST', 'http://pickmealup.com.dev7.21ilab.com/api/v1/token/refresh', [
                  'form_params' => [
                    'refresh_token' => Cookie::get('PMURefreshToken')
                  ],
                  'headers' => [
                     'Authorization' => 'Bearer ' . Cookie::get('PMUAccessToken')
                  ]
               ]);
             } catch (\GuzzleHttp\Exception\ClientException $e) {

                  $this->error = trans('Token Not Authorized');
                  return false;

             } catch (\Symfony\Component\Debug\Exception\FatalThrowableError $e) {

                  $this->error = $e;
                  return false;

             } catch (\Exception $e) {

                  $this->error = $e;
                  return false;
             }


           if ($response->getStatusCode() == 200) {

                 $token = (string) $response->getBody();

                 $json = json_decode($token);

                 Cookie::queue(Cookie::forever('PMUAccessToken', $json->token->AccessToken));

           }


      }


      public function resetCookies() {

              Cookie::queue(Cookie::forget('PMUAccessToken'));
              Cookie::queue(Cookie::forget('PMURefreshToken'));

      }

}
