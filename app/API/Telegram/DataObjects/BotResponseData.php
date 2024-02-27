<?php


namespace App\API\Telegram\DataObjects;


use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use Spatie\DataTransferObject\DataTransferObject;

class BotResponseData extends DataTransferObject
{
    public bool $ok;

    public ?BotData $result;

    public static function fromResponse(ResponseInterface $response): static
    {
        $data = json_decode($response->getBody());
        $result = $data->result;

        $botData = null;

        if ($data->ok) {
            $botData = new BotData(
                id: $result->id,
                is_bot: $result->is_bot,
                first_name: $result->first_name,
                username: $result->username,
                can_join_groups: $result->can_join_groups,
                can_read_all_group_messages: $result->can_read_all_group_messages,
                supports_inline_queries: $result->supports_inline_queries,
            );
        }

        return new static(
            ok: $data->ok,
            result: $botData
        );
    }
}
