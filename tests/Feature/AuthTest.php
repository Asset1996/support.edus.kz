<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseMigrations;
    public $user;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void{
        parent::setUp();
        $url_prefix = '/' . config('app.locale') . '/' . env('APP_VERSION', 'v1') . '/';
        $this->user = User::factory()->create();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($url_prefix);
        User::where(['id' => $this->user->id])->delete();
    }

    /**
     * Test that registration successfull.
     *
     * @return void
     */
    public function test_register()
    {
        $user_definition = User::factory()->definition();
        $response = $this->post('/ru/v1/auth/registration', [
            'name' => $user_definition['name'],
            'email' => $user_definition['email'],
            'password' => 'asdqwe123',
            'password_confirmation' => 'asdqwe123',
            'not_robot' => 'on',
            'agree_with_terms' => 'on'
        ]);
        $this->assertDatabaseHas('support_user', [
            'email' => $user_definition['email'],
        ]);
        User::where('email', $user_definition['email'])->delete();
        $response->assertStatus(302);
    }

    /**
     * Test that email verification successfull.
     *
     * @return void
     */
    public function test_email_verify()
    {
        $response = $this->get('/ru/v1/auth/verify-email/' . $this->user->verification_token);
        $this->assertDatabaseHas('support_user', [
            'id' => $this->user->id,
            'email' => $this->user->email,
            'has_access' => 1,
        ]);
        $response->assertStatus(200);
    }
}
