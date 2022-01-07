<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\SerializableClosure\Contracts\Serializable;

class Bot extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'PENDING';

    protected $fillable = [
        'local_name',
        'api_key',
        'config',
        'status',
        'user_id',
        'link'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
