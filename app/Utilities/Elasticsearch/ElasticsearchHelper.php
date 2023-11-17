<?php 
namespace App\Utilities\Elasticsearch;

use Elasticsearch\ClientBuilder;
use App\Utilities\Contracts\ElasticsearchHelperInterface;
use Elasticsearch\Common\Exceptions\NoNodesAvailableException;
use Illuminate\Support\Facades\Log;

class ElasticsearchHelper implements ElasticsearchHelperInterface
{
    protected $elasticsearch;

    public function __construct()
    {
        $this->elasticsearch = ClientBuilder::create()->setHosts(["elasticsearch:9200"])->build();  
    }

    public function storeEmail(string $messageBody, string $messageSubject, string $toEmailAddress): mixed
    {
        // Store Data
        $params = [
            'index' => 'emails',
            'body' => [
                'body' => $messageBody,
                'subject' => $messageSubject,
                'email' => $toEmailAddress,
            ],
        ];
        
        $response = $this->elasticsearch->index($params);
        Log::info('Elasticsearch Data: ' . json_encode($response));
        
        return $response['_id'];
    }
}