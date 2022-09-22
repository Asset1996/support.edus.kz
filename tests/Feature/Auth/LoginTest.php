<?php
/**
 * Authorization routes testing.
 */
namespace Tests\Auth\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;
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
     * Test that login successfull.
     *
     * @return void
     */
    public function test_login_successfully()
    {
        $response = $this->post($this->url_prefix . 'auth/login/', [
            'email' => $this->verified_user->email,
            'password' => 'asdqwe123',
            'not_robot' => 'on',
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($this->verified_user);
    }

    /**
     * Test that login throws 403(forbidden) for
     * authorized users.
     *
     * @return void
     */
    public function test_login_throws_403_for_authorized(){
        auth()->login($this->verified_user);
        $response = $this->post($this->url_prefix . 'auth/login/', [
            'email' => $this->verified_user->email,
            'password' => 'asdqwe123',
            'not_robot' => 'on',
        ]);
        $response->assertStatus(403);
    }

    /**
     * Test that login is unavailable for
     * user that has not verify email yet.
     *
     * @return void
     */
    public function test_cannot_login_for_email_not_verified_user(){
        $response = $this->post($this->url_prefix . 'auth/login/', [
            'email' => $this->user->email,
            'password' => 'asdqwe123',
            'not_robot' => 'on',
        ]);

        $this->assertGuest();
        $this->assertEquals(
            session('error_message'),
            "Вам нужно подтвердить свою электронную почту"
        );
        $response->assertStatus(302);
    }

    /**
     * Test not registered user cannot login.
     *
     * @return void
     */
    public function test_cannot_login_for_not_exist_user()
    {
        $response = $this->post($this->url_prefix . 'auth/login/', [
            'email' => 'not_exist_email@mail.com',
            'password' => 'asdqwe123',
            'not_robot' => 'on',
        ]);

        $this->assertGuest();
        $this->assertEquals(
            session('error_message'),
            "Неправильный email или пароль"
        );
        $response->assertStatus(302);
    }

    /**
     * Test that user cannot login if entered wrong password.
     *
     * @return void
     */
    public function test_cannot_login_if_incorrect_password()
    {
        $response = $this->post($this->url_prefix . 'auth/login/', [
            'email' => 'not_exist_email@mail.com',
            'password' => 'wrong_password',
            'not_robot' => 'on',
        ]);

        $this->assertGuest();
        $this->assertEquals(
            session('error_message'),
            "Неправильный email или пароль"
        );
        $response->assertStatus(302);
    }

    /**
     * Test that user cannot login if did not click on "I'm not robot".
     *
     * @return void
     */
    public function test_cannot_login_if_not_robot_not_clicked()
    {
        $response = $this->post($this->url_prefix . 'auth/login/', [
            'email' => 'not_exist_email@mail.com',
            'password' => 'asdqwe123'
        ]);

        $this->assertGuest();
        $this->assertEquals(
            session('error_message'),
            "Вы не нажали на 'Я не робот'"
        );
        $response->assertStatus(302);
    }
}
