<?php

namespace App\Libraries;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use GuzzleHttp\Client;
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
      * Flag to force reset password
      * @var Boolean
      */
      public $forceResetPassword = false;



      /**
      * Call Cognito Provider
      * @var String
      */
      public function __construct() {

            $this->getClient();

            return $this;

      }



      private function getClient() {

            try {

              $client = new CognitoIdentityProviderClient([
                  'credentials' => [
                      'key'     => env('AWS_ACCESS_KEY_ID', ''),
                      'secret'  => env('AWS_SECRET_ACCESS_KEY', ''),
                  ],
                  'version' => env('AWS_COGNITO_VERSION'),
                  'region' => env('AWS_DEFAULT_REGION'),
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

      /**
      * Autheticate user
      *
      * @return Boolean|Array
      */
      public function authenticate(array $credentials)
      {
            $client = $this->client;

              try {
                  $result = $client->adminInitiateAuth([
                      'AuthFlow' => 'ADMIN_NO_SRP_AUTH',
                      'ClientId' => env('AWS_COGNITO_CLIENT_ID'),
                      'UserPoolId' => env('AWS_COGNITO_USER_POOL_ID'),
                      'AuthParameters' => [
                          'USERNAME' => $credentials['email'],
                          'PASSWORD' => $credentials['password'],
                      ],
                  ]);


              } catch (\Exception $e) {

                $this->error = 'Incorrect username or password.';

                return false;

              }

              if ($result->get('ChallengeName')) {

                    $this->forceResetPassword = true;
                    return $result;

              }

              return ['token' => $result->get('AuthenticationResult')];

      }



      /**
      * Get User from Cognito
      *
      * @return Boolean|CognitoIdentityProviderClient
      */
      public function getUser($username) {

            try {

              $client = $this->client->adminGetUser([
                  'UserPoolId' => env('AWS_COGNITO_USER_POOL_ID'),
                  'Username' => $username,
              ]);

            } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {

                  $message = $e->getResponse();
                  $this->error =  $message->getHeaders()['x-amzn-ErrorMessage'][0];
                  return false;


            } catch (\Exception $e) {

                  $this->error = $e->getMessage();
                  return false;

            }

            $this->UserAttributes = $client->get('UserAttributes');

            return $client;


      }


      /**
      * List all Users from Cognito
      *
      * @return CognitoIdentityProviderClient
      */
      public function listUser() {

            try {

              $response = $this->client->ListUsers([
                  'UserPoolId' => env('AWS_COGNITO_USER_POOL_ID')
              ]);

            } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {

                  $message = $e->getResponse();
                  $this->error =  $message->getHeaders()['x-amzn-ErrorMessage'][0];
                  return false;


            } catch (\Exception $e) {

                  $this->error = $e->getMessage();
                  return false;

            }

            return $response;

      }


      /**
      * Set attributes to Cognito
      *
      * @return Array
      */
      public function setAttributes($attributes) {

          $userAttributes = array();

          foreach($attributes as $key=>$attr) {

            #do not update email
            if ($key != 'email') {

              $fieldAttr = [
                  'Name'  => ($key=='name' || $key=='password') ? $key : 'custom:'.$key,
                  'Value' => $attr,
              ];

              array_push($userAttributes, $fieldAttr);
            }

        }

        return $userAttributes;


      }



      /**
      * Update attributes to Cognito User
      *
      * @return CognitoIdentityProviderClient
      */
      public function updateUser($username, $attributes) {

          $userAttributes = $this->setAttributes($attributes);

          try {

            $result = $this->client->adminUpdateUserAttributes([

                'UserAttributes'  => $userAttributes,
                'UserPoolId'      => env('AWS_COGNITO_USER_POOL_ID'),
                'Username'        => $username,
            ]);

          } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {

                $message = $e->getResponse();
                $this->error =  $message->getHeaders()['x-amzn-ErrorMessage'][0];
                return false;


          } catch (\Exception $e) {

                $this->error = $e->getMessage();
                return false;

          }


          return $result;


      }


      /**
      * Create attributes to Cognito
      *
      * @return CognitoIdentityProviderClient
      */
      public function createUser($username, $attributes) {

          $userAttributes = $this->setAttributes($attributes);

          try {

            $result = $this->client->AdminCreateUser([

                'UserAttributes'  => $userAttributes,
                'UserPoolId'      => env('AWS_COGNITO_USER_POOL_ID'),
                'Username'        => $username,
            ]);

          } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {

                $message = $e->getResponse();
                $this->error =  $message->getHeaders()['x-amzn-ErrorMessage'][0];
                return false;


          } catch (\Exception $e) {

                $this->error = $e->getMessage();
                return false;

          }



          return $result;


      }


      /**
      * Remove user from Cognito
      *
      * @return CognitoIdentityProviderClient
      */
      public function deleteUser($username) {

        try {

          $result = $this->client->AdminDeleteUser([
              'UserPoolId'  => env('AWS_COGNITO_USER_POOL_ID'),
              'Username'    => $username
          ]);

        } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {

              $message = $e->getResponse();
              $this->error =  $message->getHeaders()['x-amzn-ErrorMessage'][0];
              return false;


        } catch (\Exception $e) {

              $this->error = $e->getMessage();
              return false;

        }

          return $result;


      }


      /**
      * Update user password
      *
      * @return CognitoIdentityProviderClient
      */
      public function updatePassword($username, $password) {


        try {

          $result = $this->client->AdminSetUserPassword([

              'Password'    => $password,
              'Permanent'   =>true,
              'UserPoolId'  => env('AWS_COGNITO_USER_POOL_ID'),
              'Username'    => $username
          ]);

        } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {

              $message = $e->getResponse();
              $this->error =  $message->getHeaders()['x-amzn-ErrorMessage'][0];
              return false;


        } catch (\Exception $e) {

              $this->error = $e->getMessage();
              return false;

        }

          return $result;

      }



      /**
      * Challenge Respond
      *
      * @return CognitoIdentityProviderClient
      */
      public function challengeRespond($challenge, $respond, $session) {


        try {

          $result = $this->client->AdminRespondToAuthChallenge([

              'ChallengeName'         => $challenge,
              'ChallengeResponses'    => $respond,
              'UserPoolId'            => env('AWS_COGNITO_USER_POOL_ID'),
              'ClientId'              => env('AWS_COGNITO_CLIENT_ID'),
              'Session'               => $session
          ]);

        } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $e) {

              $message = $e->getResponse();
              $this->error =  $message->getHeaders()['x-amzn-ErrorMessage'][0];
              return false;


        } catch (\Exception $e) {

              $this->error = $e->getMessage();
              return false;

        }

          return $result;

      }


      /**
      * Create User object in array from Cognito user
      *
      * @return Array
      */
      public function user() {

            $user = array();

            foreach(config('cognito.user_attributes') as $attribute) {

                  $item = str_replace('custom:', '', $attribute);
                  $user[$item] = $this->search($attribute, $this->UserAttributes);

            }

            return $user;

      }



      /**
      * Return value from Cognito attributes
      *
      * @return String
      */
      public function search($search, $attributes) {

          foreach($attributes as $key=>$attr) {

              if ($attr['Name'] == $search) {

                  return $attr['Value'];

              }

          }

          return null;

      }


      /**
      * Verify if Token is valid and user exists
      *
      * @return Boolean
      */
      public function hasValidToken() {

          return  ( $this->token && $this->getUser() ) ? true : false;
      }



      /**
      * Refresh Token
      *
      * @return Boolean
      */
      public function refreshToken( $refreshToken ) {

            $guzzleClient = new Client();

            try {

                  $result = $this->client->InitiateAuth([
                      'AuthFlow' => 'REFRESH_TOKEN_AUTH',
                      'ClientId' => env('AWS_COGNITO_CLIENT_ID'),
                      'UserPoolId' => env('AWS_COGNITO_USER_POOL_ID'),
                      'AuthParameters' => [
                          'REFRESH_TOKEN' => $refreshToken,
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

                 $this->token = $authToken['AccessToken'];

                 return true;

           }


      }


      /**
      * Check if $payload is expired, refresh if necessary
      *
      * @return Boolean
      */
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
      public function getPayload() {


          $seqToken = explode('.', $this->token);
          $data = $seqToken[1];
          $data = \json_decode(\base64_decode(\strtr($data, '-_', '+/')));

          return $data;
      }


}
