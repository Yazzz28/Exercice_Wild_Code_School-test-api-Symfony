<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
class Converteur
{

    public function __construct(private HttpClientInterface $client,)
    {

    }

    public function fetchExchangeRateInformation(): array
    {
        $response = $this->client->request(
            'GET',
            'https://v6.exchangerate-api.com/v6/ac533e3ea338cd174bab1daf/pair/EUR/GBP'
        );

        return $response->toArray();
    }

   public function convertEurToDollar(float $amount): float
   {
       $response = $this->client->request(
           'GET',
           'https://v6.exchangerate-api.com/v6/ac533e3ea338cd174bab1daf/pair/EUR/USD'
       );

       $rate = $response->toArray()['conversion_rate'];

       return round($amount * $rate, 2);
   }

   public function convertEurToYen(float $amount): float
   {
       $response = $this->client->request(
           'GET',
           'https://v6.exchangerate-api.com/v6/ac533e3ea338cd174bab1daf/pair/EUR/JPY'
       );

       $rate = $response->toArray()['conversion_rate'];

       return round($amount * $rate, 2);
   }
}