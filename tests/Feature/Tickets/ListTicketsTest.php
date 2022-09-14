<?php
/**
 * Tickets list routes testing.
 */
namespace Tests\Tickets\Feature;

use Tests\TestCase;
use App\Models\User;

class ListTicketsTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;
    // use \Illuminate\Foundation\Testing\RefreshDatabase;
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
     * Test that list all tickets page
     * loaded successfully for authorized user.
     *
     * @return void
     */
    public function test_list_tickets_page_loaded_successfully_for_authorized_user()
    {
        auth()->login($this->verified_user);
        $response = $this->get($this->url_prefix . 'ticket/list/');
        $response->assertStatus(200);
        $response->assertViewIs('pages.chat.ticketsList');
    }

    /**
     * Test that list all tickets page
     * returns 401(unauthorized) for unauthorized user.
     *
     * @return void
     */
    public function test_list_tickets_page_401_for_unauthorized()
    {
        $response = $this->get($this->url_prefix . 'ticket/list/');
        $response->assertStatus(401);
    }
}
