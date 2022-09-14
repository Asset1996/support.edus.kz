<?php
/**
 * Tickets update routes testing.
 */
namespace Tests\Tickets\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tickets;

class UpdateTicketTest extends TestCase
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
        $this->user = User::factory()->create();
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
        User::where(['id' => $this->user->id])->delete();
        User::where(['id' => $this->verified_user->id])->delete();
    }

    /**
     * Test that ticket update page loaded
     * successfully for authorized user.
     *
     * @return void
     */
    public function test_ticket_update_page_loaded_successfully()
    {
        auth()->login($this->verified_user);
        $ticket = Tickets::factory()->create([
            'ticket_uid' => 't_' . uniqid(),
            'title' => 'Title of the ticket',
            'initial_message' => 'Init message of the ticket',
            'service_types_id' => 1,
            'status_id' => 1,
            'created_by' => $this->verified_user->id,
        ]);
        $response = $this->get($this->url_prefix . 'ticket/update/'. $ticket->ticket_uid);
        $response->assertStatus(200);
        $response->assertViewIs('pages.chat.updateTicket');
    }

    /**
     * Test that ticket update page
     * returns 401(unauthorized) for unauthorized user.
     *
     * @return void
     */
    public function test_ticket_update_page_401_for_unauthorized()
    {
        $ticket = Tickets::factory()->create();
        $response = $this->get($this->url_prefix . 'ticket/update/' . $ticket->ticket_uid);
        $response->assertStatus(401);
    }

    /**
     * Test that ticket update page
     * returns 404 (not found) if ticket is not in DB.
     *
     * @return void
     */
    public function test_ticket_update_page_404_if_ticket_not_exist()
    {
        auth()->login($this->verified_user);
        $response = $this->get($this->url_prefix . 'ticket/update/not_exist_ticket');
        $response->assertStatus(404);
    }

    /**
     * Test that ticket update page
     * returns 404 (not found) if user tries to update
     * another users ticket.
     *
     * @return void
     */
    public function test_ticket_update_page_404_if_tries_to_update_another_users_ticket()
    {
        auth()->login($this->verified_user);
        $ticket = Tickets::factory()->create([
            'ticket_uid' => 't_' . uniqid(),
            'title' => 'Title of another users ticket',
            'initial_message' => 'Init message of another users ticket',
            'service_types_id' => 1,
            'status_id' => 1,
            'created_by' => $this->user->id,
        ]);
        $response = $this->get($this->url_prefix . 'ticket/update/' . $ticket->ticket_uid);
        $response->assertStatus(404);
    }
}
