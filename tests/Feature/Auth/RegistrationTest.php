<?php
/**
 * Registration routes testing.
 */
namespace Tests\Auth\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends TestCase
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
     * Test that registration successfull.
     *
     * @return void
     */
    public function test_register_successfull()
    {
        $user_definition = User::factory()->definition();
        $response = $this->post($this->url_prefix . 'auth/registration', [
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
    public function test_email_verify_successfull()
    {
        $response = $this->get($this->url_prefix . 'auth/verify-email/' . $this->user->verification_token);
        $this->assertDatabaseHas('support_user', [
            'id' => $this->user->id,
            'email' => $this->user->email,
            'has_access' => 1,
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test that registration throws 403(forbidden) for
     * authorized users.
     *
     * @return void
     */
    public function test_registration_throws_403_for_authorized(){
        auth()->login($this->verified_user);
        $response = $this->post($this->url_prefix . 'auth/registration', [
            'name' => $this->verified_user->name,
            'email' => $this->verified_user->email,
            'password' => 'asdqwe123',
            'password_confirmation' => 'asdqwe123',
            'not_robot' => 'on',
            'agree_with_terms' => 'on'
        ]);
        $response->assertStatus(403);
    }

    /**
     * Test that user cannot register 
     * if did not click on "I'm not robot".
     *
     * @return void
     */
    public function test_cannot_register_if_not_robot_not_clicked()
    {
        $user_definition = User::factory()->definition();
        $response = $this->post($this->url_prefix . 'auth/registration', [
            'name' => $user_definition['name'],
            'email' => $user_definition['email'],
            'password' => 'asdqwe123',
            'password_confirmation' => 'asdqwe123',
            'agree_with_terms' => 'on'
        ]);

        $this->assertDatabaseMissing('support_user', [
            'email' => $user_definition['email'],
        ]);
        $this->assertEquals(session('error_message'),"Вы не нажали на 'Я не робот'");
        $response->assertStatus(302);
    }

    /**
     * Test that user cannot register 
     * if did not click on "I agree with terms".
     *
     * @return void
     */
    public function test_cannot_register_if_agree_with_terms_not_clicked()
    {
        $user_definition = User::factory()->definition();
        $response = $this->post($this->url_prefix . 'auth/registration', [
            'name' => $user_definition['name'],
            'email' => $user_definition['email'],
            'password' => 'asdqwe123',
            'password_confirmation' => 'asdqwe123',
            'not_robot' => 'on',
        ]);

        $this->assertDatabaseMissing('support_user', [
            'email' => $user_definition['email'],
        ]);
        $this->assertEquals(session('error_message'),"Вы не нажали на 'Согласен с условиями предоставления сервиса'");
        $response->assertStatus(302);
    }

    /**
     * Test - password need consist of min 8 symbols.
     *
     * @return void
     */
    public function test_validation_password_min_8_symbols()
    {
        $user_definition = User::factory()->definition();
        $response = $this->post($this->url_prefix . 'auth/registration', [
            'name' => $user_definition['name'],
            'email' => $user_definition['email'],
            'password' => 'asdqw1',
            'password_confirmation' => 'asdqw1',
            'not_robot' => 'on',
            'agree_with_terms' => 'on'
        ]);

        $this->assertDatabaseMissing('support_user', [
            'email' => $user_definition['email'],
        ]);
        $this->assertEquals(
            session('error_message'),
            "Пароль должен состоять минимум из 8 символов"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - password need contain at least 1 character
     * and 1 digit.
     *
     * @return void
     */
    public function test_validation_password_must_contain_chars_and_digits()
    {
        $user_definition = User::factory()->definition();
        $response = $this->post($this->url_prefix . 'auth/registration', [
            'name' => $user_definition['name'],
            'email' => $user_definition['email'],
            'password' => 'asdqweasd',
            'password_confirmation' => 'asdqweasd',
            'not_robot' => 'on',
            'agree_with_terms' => 'on'
        ]);

        $this->assertDatabaseMissing('support_user', [
            'email' => $user_definition['email'],
        ]);
        $this->assertEquals(
            session('error_message'),
            "Пароль должен состоять минимум из 1 буквы и 1 цифры"
        );
        $response->assertStatus(302);
    }

    /**
     * Test - password and password_confirm must match.
     *
     * @return void
     */
    public function test_validation_password_confirm_must_match()
    {
        $user_definition = User::factory()->definition();
        $response = $this->post($this->url_prefix . 'auth/registration', [
            'name' => $user_definition['name'],
            'email' => $user_definition['email'],
            'password' => 'asdqweasd1',
            'password_confirmation' => 'asdqweasd1_not_match',
            'not_robot' => 'on',
            'agree_with_terms' => 'on'
        ]);

        $this->assertDatabaseMissing('support_user', [
            'email' => $user_definition['email'],
        ]);
        $this->assertEquals(session('error_message'), "Пароли не совпадают");
        $response->assertStatus(302);
    }

    /**
     * Test - email field must be email type.
     *
     * @return void
     */
    public function test_validation_email_must_be_email_type()
    {
        $user_definition = User::factory()->definition();
        $response = $this->post($this->url_prefix . 'auth/registration', [
            'name' => $user_definition['name'],
            'email' => 'not_email_string',
            'password' => 'asdqweasd1',
            'password_confirmation' => 'asdqweasd1_not_match',
            'not_robot' => 'on',
            'agree_with_terms' => 'on'
        ]);

        $this->assertDatabaseMissing('support_user', [
            'email' => $user_definition['email'],
        ]);
        $this->assertEquals(
            session('error_message'),
            "Поле 'Электронная почта' должна иметь тип email"
        );
        $response->assertStatus(302);
    }
}
