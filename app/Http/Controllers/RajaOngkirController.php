<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RajaOngkirController extends Controller
{
    public function getprovince(){
        $client = new Client();

        try {
            $response = $client->get('https://api.rajaongkir.com/starter/province',
                array(
                    'headers' => array(
                        'key' => 'f31527a23b145a3ee7d0dbe88386c489'
                    )
                )
            );
        } catch (RequestException $e) {
            var_dump($e->getResponse()->getBody()->getContents());    
        }

        $json = $response->getBody()->getContents();
        $array_response = json_decode($json,true);

        return $array_response;
    }

    public function getcity(){
        $client = new Client();

        try {
            $response = $client->get('https://api.rajaongkir.com/starter/city',
                array(
                    'headers' => array(
                        'key' => 'f31527a23b145a3ee7d0dbe88386c489'
                    )
                )
            );
        } catch (RequestException $e) {
            var_dump($e->getResponse()->getBody()->getContents());    
        }

        $json = $response->getBody()->getContents();
        $array_response = json_decode($json,true);

        return $array_response;
    }

    public function checkshipping(){
        $client = new Client();

        try {
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin=501&destination=114&weight=100&courier=jne',
                    'headers' => [
                        'content-type' => 'application/x-www-form-urlencoded',
                        'key' => 'f31527a23b145a3ee7d0dbe88386c489'
                    ]
                ]
            );
        } catch (RequestException $e) {
            var_dump($e->getResponse()->getBody()->getContents());    
        }

        $json = $response->getBody()->getContents();
        $array_response = json_decode($json,true);

        return $array_response['rajaongkir']['results'][0]['costs'][1]['cost'][0]['value'];
    }
}
