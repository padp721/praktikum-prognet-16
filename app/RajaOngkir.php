<?php

namespace App;

use GuzzleHttp\Client;

class RajaOngkir
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

        return $array_response['rajaongkir']['results'];
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

        return $array_response['rajaongkir']['results'];
    }

    public function checkshipping($destination,$courier){
        $client = new Client();

        try {
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin=114&destination='.$destination.'&weight=100&courier='.$courier.'',
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
