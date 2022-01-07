<?php

namespace App\Services\TAPI;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class TelegramApi
{
    private $tapiUrl;
    private $token;
    private $client;
    private $response;

    public function __construct($token) {
        $this->tapiUrl = env('TELEGRAM_API');
        $this->token = $token;
        $this->client = new Client();
    }

    public function getMe(): TelegramApi {
        $this->response['getMe'] = $this->getBase('/getMe');
        return $this;
    }

    public function setWebhook(array $webhookData): TelegramApi {
        $this->response['setWebhook'] = $this->postBase("", $webhookData);
        return $this;
    }

    public function deleteWebhook(array $webhookData): TelegramApi {
        $this->response['deleteWebhook'] = $this->postBase("", $webhookData);
        return $this;
    }

    public function getResponses(): array {
        $arr = [];
        foreach ($this->response as $method => $response) {
            $arr[$method] = json_decode($response->getBody());
        }

        return $arr;
    }

    private function getBase(string $uri = ''): ResponseInterface {
        $url = $this->makeUrl($uri);
        return $this->client->get($url);
    }

    private function postBase(string $uri = '', array $data = []): ResponseInterface {
        $url = $this->makeUrl($uri);
        return $this->client->post($url, ['json' => $data]);
    }

    private function makeUrl (string $uri = "") {
        return $this->tapiUrl . $this->token . $uri;
    }

}
