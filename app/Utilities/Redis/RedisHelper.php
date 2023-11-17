<?php

namespace App\Utilities\Redis;

use Illuminate\Support\Facades\Redis;
use App\Utilities\Contracts\RedisHelperInterface;
use Illuminate\Support\Facades\Log;

class RedisHelper implements RedisHelperInterface {

    public function storeRecentMessage(mixed $id, string $messageSubject, string $toEmailAddress): void {
        
        $response = Redis::hset('recent_messages', $id, json_encode([
            'id' => $id,
            'subject' => $messageSubject,
            'email' => $toEmailAddress,
        ]));

        Log::info('Redis Data: ' . json_encode($response));
        
    }

}
