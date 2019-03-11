<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ApiStoreUserLogTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreUserLog()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->json('POST', '/api/user_logs', []);
        $response->assertStatus(422);
    }
}
