<?php

namespace App\Models;

use Database\Factories\BotFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Class Bot
 * @package App\Models
 *
 * @property int $id
 * @property string $local_name
 * @property string $api_key
 * @property array|null $config
 * @property string $status
 * @property int $user_id
 * @property string $link
 * @property User $user
 *
 * @method BotFactory factory()
 * @method Builder forUser(User $user)
 */
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

    protected $casts = [
        'config' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }
}
