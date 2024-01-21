<?php

namespace App\DataObjects\Bot;

use App\Http\Requests\Bot\UpdateBotFormRequest;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateBotData extends DataTransferObject
{
    #[MapFrom('local_name')]
    #[MapTo('local_name')]
    public string $localName;

    #[MapFrom('api_key')]
    #[MapTo('api_key')]
    public string $apiKey;

    public static function fromRequest(UpdateBotFormRequest $request): self
    {
        return new self(
            local_name: $request->get('local_name'),
            api_key: $request->get('api_key'),
        );
    }
}
