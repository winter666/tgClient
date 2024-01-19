<?php


namespace App\DataObjects\User;


use Spatie\DataTransferObject\DataTransferObject;

class UpdateUserData extends DataTransferObject
{
    public int $id;

    public string $name;

    public string $email;
}
