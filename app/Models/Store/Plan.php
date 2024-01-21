<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Plan
 * @package App\Models\Store
 *
 * @property string $name
 * @property string $description
 * @property float $price
 * @property integer $bot_count
 */
class Plan extends Model
{
    use HasFactory;
}
