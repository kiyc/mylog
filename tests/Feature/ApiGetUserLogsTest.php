<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ApiGetUserLogsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // ログインしていない場合はリダイレクトするか
        $response = $this->get('/api/user_logs');
        $response->assertStatus(302);

        // ログインしている場合
        $user = User::find(1);
        $response = $this->actingAs($user)->json('GET', '/api/user_logs');
        $response->assertStatus(200);
        // 予想されるjsonレスポンス
        // { "user_logs': [ user_log1, user_log2, ... ] }
        $response->assertJsonStructure(['user_logs']);
    }
}
