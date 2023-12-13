<?php

namespace App\Models;

use Database\Factories\BotFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Bot
 * @package App\Models
 *
 * @property string $local_name
 * @property string $api_key
 * @property array|null $config
 * @property string $status
 * @property int $user_id
 * @property string $link
 * @property User $user
 *
 * @method BotFactory factory()
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
}
