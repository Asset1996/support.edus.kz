<?php
/**
 * Tickets update routes testing.
 */
namespace Tests\Feature\Tickets;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tickets;

class UpdateTicketsTest extends TestCase
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
        $this->verified_user = User::factory()->create([
            'has_access' => 1,
            'email_verified_at' => now()
        ]);
        $this->ticket = Tickets::factory()->create([
            'created_by' => $this->verified_user->id
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
        User::where(['id' => $this->user->id])->delete();
        User::where(['id' => $this->verified_user->id])->delete();
        Tickets::where(['ticket_uid' => $this->ticket->ticket_uid])->delete();
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
        $response = $this->get($this->url_prefix . 'ticket/update/'. $this->ticket->ticket_uid);
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
        $response = $this->get($this->url_prefix . 'ticket/update/' . $this->ticket->ticket_uid);
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

    /**
     * Test that ticked updated successfully.
     *
     * @return void
     */
    public function test_update_ticket_successfully(){
        auth()->login($this->verified_user);
        $response = $this->post($this->url_prefix . 'ticket/update/' . $this->ticket->ticket_uid, [
            'title' => 'Updated ticket title',
            'initial_message' => 'Updated ticket message body',
            'not_robot' => 'on',
        ]);
        $this->assertDatabaseHas('support_tickets', [
            'ticket_uid' => $this->ticket->ticket_uid,
            'title' => 'Updated ticket title',
        ]);
        $response->assertStatus(302);
        $url = route('tickets-list');
        $response->assertRedirectContains($url);
    }

    /**
     * Test - message title must be minimum 10 symbols.
     *
     * @return void
     */
    public function test_validation_message_title_min_10_symbols()
    {
        auth()->login($this->verified_user);
        $response = $this->post($this->url_prefix . 'ticket/update/' . $this->ticket->ticket_uid, [
            'title' => 'short',
            'initial_message' => 'Message title must be minimum 10 symbols',
            'not_robot' => 'on',
        ]);
        $this->assertEquals(
            "Поле 'Тема сообщения' должно состоять минимум из 10 символов",
            session('error_message')
        );
        $this->assertDatabaseMissing('support_tickets', [
            'title' => 'short',
        ]);
        $response->assertStatus(302);
    }

    /**
     * Test - message body must be minimum 10 symbols.
     *
     * @return void
     */
    public function test_validation_message_body_min_10_symbols()
    {
        auth()->login($this->verified_user);
        $response = $this->post($this->url_prefix . 'ticket/update/' . $this->ticket->ticket_uid, [
            'title' => 'Message body must be minimum 10 symbolsy',
            'initial_message' => 'short',
            'not_robot' => 'on',
        ]);
        $this->assertEquals(
            "Поле 'Подробное описание' должно состоять минимум из 10 символов",
            session('error_message')
        );
        $this->assertDatabaseMissing('support_tickets', [
            'initial_message' => 'short',
        ]);
        $response->assertStatus(302);
    }

    /**
     * Test - I'm not robot checker must be checked.
     *
     * @return void
     */
    public function test_validation_not_robot_must_be_checked()
    {
        auth()->login($this->verified_user);
        $response = $this->post($this->url_prefix . 'ticket/update/' . $this->ticket->ticket_uid, [
            'title' => 'Message not robot',
            'initial_message' => 'Message not robot body',
        ]);
        $this->assertEquals(
            "Вы не нажали на 'Я не робот'",
            session('error_message')
        );
        $this->assertDatabaseMissing('support_tickets', [
            'title' => 'Message not robot',
        ]);
        $response->assertStatus(302);
    }
}
