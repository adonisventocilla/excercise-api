<?php

namespace Tests\Unit;

use Tests\TestCase;

class ArticleTest extends TestCase
{

    public function test_article_store()
    {
        $response = $this->call('POST', '/articles', [
            'name' => 'Test Article',
            'description' => 'Test Body',
        ]);

        $response->assertStatus($response->status(), 302);
    }

    //make article store failed test
    public function test_article_store_failed()
    {
        $response = $this->call('POST', '/articles', [
            'name' => 'Test Article',
        ]);

        $response->assertStatus($response->status(), 404);
    }

}
