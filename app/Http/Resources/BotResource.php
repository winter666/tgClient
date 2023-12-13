<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'local_name' => $this->local_name,
            'api_key' => $this->api_key,
            'config' => $this->config,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'link' => $this->link
        ];
    }
}
