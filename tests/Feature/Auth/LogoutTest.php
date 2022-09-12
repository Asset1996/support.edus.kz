<?php
/**
 * Logout routes testing.
 */
namespace Tests\Auth\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LogoutTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * User not verified his email.
     */

    private $user;
    /**
     * User DID verified his email.
     */
    private $verified_user;

    private $url_prefix;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void{
        parent::setUp();
        $this->url_prefix = '/' . config('app.locale') . '/' . env('APP_VERSION', 'v1') . '/';
        $this->verified_user = User::factory()->create(
            User::factory()->definition() + [
                'has_access' => 1,
                'email_verified_at' => now()
            ]
        );
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->url_prefix);
        User::where(['id' => $this->verified_user->id])->delete();
    }

    /**
     * Test that logout successfull.
     *
     * @return void
     */
    public function test_logout_successfull()
    {
        auth()->login($this->verified_user);
        $response = $this->post($this->url_prefix . 'auth/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }

    /**
     * Test that logout throws 401(Unauthorized) for
     * unauthorized users.
     *
     * @return void
     */
    public function test_logout_throws_401_for_unauthorized(){
        $response = $this->post($this->url_prefix . 'auth/logout');
        $response->assertStatus(401);
    }
}
