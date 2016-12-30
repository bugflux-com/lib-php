<?php


namespace Bugflux\Wrappers;


use Bugflux\Interfaces\RequestProvider;
use GuzzleHttp\Client;

class GuzzleWrapper implements RequestProvider
{
    public function make($method, $url, $data, array $options = [])
    {
        $client = new Client();
        $res = $client->request(strtoupper($method), $url, [
            'json' => $data,
            'verify' => $options['strictSSL'] ?: false,
            'synchronous' => true,
        ]);

        return $res->getStatusCode() == 200;
    }
}