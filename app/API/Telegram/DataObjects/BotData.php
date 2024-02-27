<?php


namespace App\API\Telegram\DataObjects;


use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class BotData extends DataTransferObject
{
    public int $id;

    #[MapFrom('is_bot')]
    #[MapTo('is_bot')]
    public bool $isBot;

    #[MapFrom('first_name')]
    #[MapTo('first_name')]
    public string $firstName;

    public string $username;

    #[MapFrom('can_join_groups')]
    #[MapTo('can_join_groups')]
    public bool $canJoinGroups;

    #[MapFrom('can_read_all_group_messages')]
    #[MapTo('can_read_all_group_messages')]
    public bool $canReadAllGroupMessages;

    #[MapFrom('supports_inline_queries')]
    #[MapTo('supports_inline_queries')]
    public bool $supportsInlineQueries;
}
