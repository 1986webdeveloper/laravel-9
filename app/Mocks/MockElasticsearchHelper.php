<?php
namespace App\Mocks;

use App\Utilities\Contracts\ElasticsearchHelperInterface;

class MockElasticsearchHelper implements ElasticsearchHelperInterface
{
    public function storeEmail(string $messageBody, string $messageSubject, string $toEmailAddress): mixed
    {
        return true;
    }
}
