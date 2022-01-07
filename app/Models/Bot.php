<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'PENDING';

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

}
