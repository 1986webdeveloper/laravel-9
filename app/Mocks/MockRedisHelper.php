<?php
namespace App\Mocks;

use Illuminate\Support\Facades\Redis;

class MockRedisHelper
{
    public static function storeRecentMessage($randomInt, $subject, $email)
    {
        return true;
    }
}
