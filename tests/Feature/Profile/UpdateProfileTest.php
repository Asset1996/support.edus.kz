<?php
/**
 * Update profile routes testing.
 */
namespace Tests\Feature\Tickets;

use App\Models\Tickets;
use App\Models\User;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
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
     * Test - update profile iin successfully.
     *
     * @return void
     */
    public function test_update_profile_iin_successfully()
    {
        auth()->login($this->verified_user);
        $iin = '960607351212';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'iin' => $iin
        ]);
        $this->assertDatabaseHas('support_user', [
            'iin' => $iin,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('success_message'),
            "Изменения успешно внесены"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - iin must be minimum 12 digits.
     *
     * @return void
     */
    public function test_validation_iin_min_12()
    {
        auth()->login($this->verified_user);
        $iin = '96060735121';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'iin' => $iin
        ]);
        $this->assertDatabaseMissing('support_user', [
            'iin' => $iin,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('error_message'),
            "Неправильный формат ИИН"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - iin must be maximum 12 digits.
     *
     * @return void
     */
    public function test_validation_iin_max_12()
    {
        auth()->login($this->verified_user);
        $iin = '9606073512121';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'iin' => $iin
        ]);
        $this->assertDatabaseMissing('support_user', [
            'iin' => $iin,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('error_message'),
            "Неправильный формат ИИН"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - iin must be only 12 digits.
     *
     * @return void
     */
    public function test_validation_iin_only_digits()
    {
        auth()->login($this->verified_user);
        $iin = '96060735121a';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'iin' => $iin
        ]);
        $this->assertDatabaseMissing('support_user', [
            'iin' => $iin,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('error_message'),
            "Неправильный формат ИИН"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - update phone number successfully.
     *
     * @return void
     */
    public function test_update_phone_number_successfully()
    {
        auth()->login($this->verified_user);
        $phone = '87023214455';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'phone' => $phone
        ]);
        $this->assertDatabaseHas('support_user', [
            'phone' => $phone,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('success_message'),
            "Изменения успешно внесены"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - phone number must be minimum 11 digits.
     *
     * @return void
     */
    public function test_validation_phone_number_min_12()
    {
        auth()->login($this->verified_user);
        $phone = '8702321445';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'phone' => $phone
        ]);
        $this->assertDatabaseMissing('support_user', [
            'phone' => $phone,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('error_message'),
            "Неправильный формат номера телефона"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - phone number must be maximum 11 digits.
     *
     * @return void
     */
    public function test_validation_phone_number_max_12()
    {
        auth()->login($this->verified_user);
        $phone = '870232144559';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'phone' => $phone
        ]);
        $this->assertDatabaseMissing('support_user', [
            'phone' => $phone,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('error_message'),
            "Неправильный формат номера телефона"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - phone number must contain only digits.
     *
     * @return void
     */
    public function test_validation_phone_number_only_digits()
    {
        auth()->login($this->verified_user);
        $phone = '87023214455a';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'phone' => $phone
        ]);
        $this->assertDatabaseMissing('support_user', [
            'phone' => $phone,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('error_message'),
            "Неправильный формат номера телефона"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - update name successfully.
     *
     * @return void
     */
    public function test_update_name_successfully()
    {
        auth()->login($this->verified_user);
        $name = 'Bernardinhooo';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'name' => $name
        ]);
        $this->assertDatabaseHas('support_user', [
            'name' => $name,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('success_message'),
            "Изменения успешно внесены"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - update surname successfully.
     *
     * @return void
     */
    public function test_update_surname_successfully()
    {
        auth()->login($this->verified_user);
        $surname = 'Voskalieouevichsh';
        $response = $this->post($this->url_prefix . 'profile/update', [
            'surname' => $surname
        ]);
        $this->assertDatabaseHas('support_user', [
            'surname' => $surname,
            'email' => $this->verified_user->email
        ]);
        $this->assertEquals(
            session('success_message'),
            "Изменения успешно внесены"
        );
        $response->assertStatus(302);
    }
}
