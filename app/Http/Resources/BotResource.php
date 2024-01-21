<?php

namespace App\Http\Resources;

use App\Models\Bot;
use Illuminate\Http\Resources\Json\JsonResource;

class BotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Bot $bot */
        $bot = $this->resource;

        return [
            'id' => $bot->id,
            'local_name' => $bot->local_name,
            'api_key' => $bot->api_key,
            'config' => $bot->config,
            'status' => $bot->status,
            'user_id' => $bot->user_id,
            'link' => $bot->link
        ];
    }
}
