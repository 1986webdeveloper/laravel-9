<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserEmail;
use App\Mocks\MockElasticsearchHelper;
use App\Utilities\Contracts\ElasticsearchHelperInterface;
use App\Utilities\Contracts\RedisHelperInterface;
use App\Mocks\MockRedisHelper;

class SendEmailTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->app->bind(ElasticsearchHelperInterface::class, MockElasticsearchHelper::class);
        $this->app->bind(RedisHelperInterface::class, MockRedisHelper::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dispatches_send_email_job()
    {
        Mail::fake();

        $data = [
            array(
                'email' => 'test1@gmail.com',
                'subject' => 'Test Subject 1',
                'body' => 'This is test message'
            ),
            array(
                'email' => 'test2@gmail.com',
                'subject' => 'Test Subject 2',
                'body' => 'This is test message for testing'
            )
        ];

        if(!empty($data)){
            SendEmail::dispatch($data);
        
            foreach ($data as $emailData) {
                Mail::assertSent(UserEmail::class, function ($mail) use ($emailData) {
                    return $mail->subject == $emailData['subject'] && $mail->body == $emailData['body'];
                });
            }
        }
        
    }
}
