<?php
/**
 * Tickets create routes testing.
 */
namespace Tests\Feature\Tickets;

use Tests\TestCase;
use App\Models\User;

class CreateTicketTest extends TestCase
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
            'roles_id' => 1,
            'email_verified_at' => now()
        ]);
        $this->not_client = User::factory()->create([
            'has_access' => 1,
            'roles_id' => 2,
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
        User::where(['id' => $this->user->id])->delete();
        User::where(['id' => $this->verified_user->id])->delete();
    }

    /**
     * Test that create ticket page
     * successfully loaded.
     *
     * @return void
     */
    public function test_create_ticket_page_loaded_successfully()
    {
        $response = $this->get($this->url_prefix . 'ticket/create-ticket/');
        $response->assertStatus(200);
        $response->assertViewIs('pages.chat.createTicket');
    }

    /**
     * Test that create ticket page load fails,
     * if authorized user is not a client (roles_id != 1).
     *
     * @return void
     */
    public function test_create_ticket_page_load_403_if_not_client()
    {
        auth()->login($this->not_client);
        $response = $this->get($this->url_prefix . 'ticket/create-ticket/');
        $response->assertStatus(403);
    }

    /**
     * Test that ticket successfully created
     * by unauthorized user.
     *
     * @return void
     */
    public function test_create_ticket_unauthorized_successfully()
    {
        $response = $this->post($this->url_prefix . 'ticket/create-ticket/', [
            'email' => 'unauthorized_user@mail.com',
            'name' => 'Testman',
            'title' => 'Create ticket for unauthorized user successfully',
            'initial_message' => 'Create ticket for unauthorized user successfully body',
            'service_types_id' => 1,
            'not_robot' => 'on',
        ]);
        $this->assertEquals(
            "Тикет успешно создан. Вам надо верифицировать ваш email",
            session('success_message')
        );
        $this->assertDatabaseHas('support_user', [
            'email' => 'unauthorized_user@mail.com',
        ]);
        $this->assertDatabaseHas('support_tickets_tmp', [
            'title' => 'Create ticket for unauthorized user successfully',
        ]);
        $response->assertRedirectContains('/ticket-created/');
        $response->assertStatus(302);
    }

    /**
     * Test that ticket successfully created
     * by authorized user.
     *
     * @return void
     */
    public function test_create_ticket_authorized_successfully()
    {
        auth()->login($this->verified_user);
        $response = $this->post($this->url_prefix . 'ticket/create-ticket/', [
            'email' => $this->verified_user->email,
            'name' => $this->verified_user->name,
            'title' => 'Create ticket for authorized user successfully',
            'initial_message' => 'Create ticket for authorized user successfully body',
            'service_types_id' => 1,
            'not_robot' => 'on',
        ]);
        $this->assertEquals(
            session('success_message'),
            "Тикет успешно создан"
        );
        $this->assertDatabaseHas('support_tickets', [
            'title' => 'Create ticket for authorized user successfully',
        ]);
        $response->assertRedirectContains('/ticket-created/');
        $response->assertStatus(302);
    }

    /**
     * Test that only clients(roles_id = 1) can create ticket.
     *
     * @return void
     */
    public function test_create_ticket_only_clients()
    {
        auth()->login($this->not_client);
        $response = $this->post($this->url_prefix . 'ticket/create-ticket/', [
            'email' => $this->not_client->email,
            'name' => $this->not_client->name,
            'title' => 'Created ticket by operator Denis',
            'initial_message' => 'Message created ticket by operator Denis',
            'service_types_id' => 1,
            'not_robot' => 'on',
        ]);
        $this->assertDatabaseMissing('support_tickets', [
            'title' => 'Created ticket by operator Denis',
        ]);
        $response->assertStatus(403);
    }

    /**
     * Test - message title must be minimum 10 symbols.
     *
     * @return void
     */
    public function test_validation_message_title_min_10_symbols()
    {
        auth()->login($this->verified_user);
        $response = $this->post($this->url_prefix . 'ticket/create-ticket/', [
            'email' => $this->verified_user->email,
            'name' => $this->verified_user->name,
            'title' => 'short',
            'initial_message' => 'Message title must be minimum 10 symbols',
            'service_types_id' => 1,
            'not_robot' => 'on',
        ]);
        $this->assertEquals(
            session('error_message'),
            "Поле 'Тема сообщения' должно состоять минимум из 10 символов"
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
        $response = $this->post($this->url_prefix . 'ticket/create-ticket/', [
            'email' => $this->verified_user->email,
            'name' => $this->verified_user->name,
            'title' => 'Message body must be minimum 10 symbolsy',
            'initial_message' => 'short',
            'service_types_id' => 1,
            'not_robot' => 'on',
        ]);
        $this->assertEquals(
            session('error_message'),
            "Поле 'Подробное описание' должно состоять минимум из 10 символов"
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
        $response = $this->post($this->url_prefix . 'ticket/create-ticket/', [
            'email' => $this->verified_user->email,
            'name' => $this->verified_user->name,
            'title' => 'Message not robot',
            'initial_message' => 'Message not robot body',
            'service_types_id' => 1,
        ]);
        $this->assertEquals(
            session('error_message'),
            "Вы не нажали на 'Я не робот'"
        );
        $this->assertDatabaseMissing('support_tickets', [
            'title' => 'Message not robot',
        ]);
        $response->assertStatus(302);
    }

    /**
     * Test - uploading file.
     *
     * @return void
     */
    public function test_upload_file()
    {
        auth()->login($this->verified_user);
        $stub = storage_path().'/app/test/test.png';
        $fileName = 'test_' . uniqid().'.png';
        $path = sys_get_temp_dir().'/'.$fileName;
        copy($stub, $path);
        $file = new \Illuminate\Http\UploadedFile($path, $fileName, 'image/png',  null, true);

        $response = $this->post($this->url_prefix . 'ticket/create-ticket/', [
            'email' => $this->verified_user->email,
            'name' => $this->verified_user->name,
            'title' => 'Message test upload file',
            'initial_message' => 'Message test upload file body',
            'service_types_id' => 1,
            'not_robot' => 'on',
            'ask_images' => [$file]
        ]);
        $this->assertDatabaseHas('uploads', [
            'original_name' => $fileName,
        ]);

        $fileModel = \App\Models\Uploads::where('original_name', $fileName)->first();
        $uploaded = storage_path().'/app/public/images/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $fileModel->name;
        $this->assertFileExists($uploaded);
        $response->assertStatus(302);
        @unlink($uploaded);
    }
}
