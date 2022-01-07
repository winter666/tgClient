<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokenService
{
    private const EXPIRED_PERIOD = 60 * 60 * 24;

    public function isExpired(PersonalAccessToken $personalAccessToken) {
        $parsed = Carbon::parse($personalAccessToken->created_at);
        if ($personalAccessToken->last_used_at) {
            $parsed = Carbon::parse($personalAccessToken->last_used_at);
        }
        $expiredTime = $parsed
            ->addSeconds(self::EXPIRED_PERIOD)
            ->getTimestamp();
        $nowTime = Carbon::now()->getTimestamp();

        return $expiredTime >= $nowTime;
    }

}
