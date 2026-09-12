<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HttpService
{
    protected $client;
    protected $allowedDomains = ['newsapi.org'];
    protected $allowedProtocols = ['http', 'https'];
    protected $refererHeader; // Intestazione Referer

    public function __construct()
    {
        $this->refererHeader = config('app.url');
        $this->client = new Client();
    }

    public function getRequest($url)
    {
      /*   $parsedUrl = parse_url($url);

        // Validate protocol
        if (!in_array($parsedUrl['scheme'], $this->allowedProtocols)) {
            return 'Protocol not allowed';
        }

        // Validate domain
        if (!isset($parsedUrl['host']) || !in_array($parsedUrl['host'], $this->allowedDomains)) {
            return 'Domain not allowed';
        }

        // Aggiungi l'intestazione Referer per le richieste al server locale
        $options['headers'] = ['Referer' => $this->refererHeader];

        try {
            $response = $this->client->request('GET', $url, $options);
            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            return 'Something went wrong: ' . $e->getMessage();
     } */



    $parsedUrl = parse_url($url);

    // Controllo URL
    if (
        !$parsedUrl ||
        !isset($parsedUrl['scheme']) ||
        !isset($parsedUrl['host'])
    ) {
        return 'Invalid URL';
    }

    // Permettiamo solo HTTPS
    if ($parsedUrl['scheme'] !== 'https') {
        return 'Protocol not allowed';
    }

    // Permettiamo solo NewsAPI
    if ($parsedUrl['host'] !== 'newsapi.org') {
        return 'Domain not allowed';
    }

    // Permettiamo solo l'endpoint delle news
    if (($parsedUrl['path'] ?? '') !== '/v2/top-headlines') {
        return 'Endpoint not allowed';
    }

    $options['headers'] = [
        'Referer' => $this->refererHeader
    ];

    try {
        $response = $this->client->request('GET', $url, $options);

        return $response->getBody()->getContents();

    } catch (RequestException $e) {
        return 'Something went wrong: ' . $e->getMessage();
    }


    }
}
