<?php

namespace App\Http\Controllers\payments\mpesa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MPESAController extends Controller
{


    /**The json_encode() function is an inbuilt function in PHP which is used to convert PHP array or object into JSON representation */
    /**Whenever i am exteacting data from a response recived from the API i must JSON decode */

  
    public function getAccessToken(){


        $url = env('MPESA_ENV') == 0
        ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
        : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init($url);
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf8'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_USERPWD => env('MPESA_CONSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET')
            )
        );

        /*Convert Json to a variable is returning me data it returns to me JSON*/
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        return $response->access_token;
        //return $response->access_token;

    }

    public function makeHttp($url,$body){

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>json_encode($body),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$this->getAccessToken(),
            'Content-Type: application/json'
          ),
        ));
        
        $curl_response = curl_exec($curl);
        
        curl_close($curl);
        echo $curl_response;
        
    }
}
