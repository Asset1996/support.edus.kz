<?php
/**
 * View profile routes testing.
 */
namespace Tests\Feature\Tickets;

use App\Models\Tickets;
use App\Models\User;
use Tests\TestCase;

class ViewProfileTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

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
        $this->verified_user = User::factory()->create([
            'has_access' => 1,
            'email_verified_at' => now()
        ]);
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
     * Test that view profile page loaded
     * successfully for authorized user.
     *
     * @return void
     */
    public function test_view_profile_page_loaded_successfully()
    {
        auth()->login($this->verified_user);
        $response = $this->get($this->url_prefix . 'profile');
        $contextUser = $response->getOriginalContent()->getData()['user'];
        $this->assertEquals($contextUser['email'], $this->verified_user->email);
        $response->assertStatus(200);
    }

    /**
     * Test that view profile page returns
     * 401(unauthorized) for unauthorized user.
     *
     * @return void
     */
    public function test_view_profile_page_401_for_unauthorized()
    {
        $response = $this->get($this->url_prefix . 'profile');
        $response->assertStatus(401);
    }
}
