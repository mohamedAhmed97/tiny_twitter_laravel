<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Faker\Generator as Faker;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
    }

    public function testSuccessfulLogin()
    {
        $user = User::factory()->create([
            'email' => 'sample1@test.com',
            'password' => bcrypt('sample123'),
            'image' => 'avater.png',
            'date_of_birth' => '2011-08-01'
        ]);


        $response = $this->json('POST', '/api/login', [
            'email' => 'sample@test.com',
            'password' => 'sample123',
            'device_name' => 'test'
        ]);

        $response->assertOk();
    }
}
