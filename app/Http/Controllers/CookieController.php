<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CookieController extends Controller {

  /* below code a set a cookie in browser */
   public function setCookie(Request $request){
      $response = new Response('Hello World');
      $response->withCookie(cookie('AccessToken', 'Anything else'));
      return $response;
   }
  /* below code a get a cookie in browser */
   public function getCookie(Request $request){
      $value = $request->cookie('PMUAccessToken');
      $value2 = $request->cookie('PMURefreshToken');
      echo $value;
      echo '<br />';
      echo $value2;
   }
}
