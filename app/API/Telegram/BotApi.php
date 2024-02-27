<?php

namespace App\API\Telegram;

use App\API\Telegram\DataObjects\BotResponseData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BotApi
{
    public function __construct(
        protected string $api_key,
        protected Client $client,
        protected string $base_uri,
    ) {
        //
    }

    /**
     * @return BotResponseData
     * @throws GuzzleException
     */
    public function getMe(): BotResponseData
    {
        return BotResponseData::fromResponse(
            $this->client->get($this->base_uri . "bot{$this->api_key}/getMe")
        );
    }
}
