<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    private $url_prefix;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void{
        parent::setUp();
        $this->url_prefix = '/' . config('app.locale') . '/' . env('APP_VERSION', 'v1') . '/';
    }
    /**
     * Url '/' redirects to '/ru/v1/'.
     *
     * @return void
     */
    public function test_redirects_to_home_page()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    /**
     * Home page returns 200 code.
     *
     * @return void
     */
    public function test_home_page()
    {
        $response = $this->get($this->url_prefix);
        $response->assertStatus(200);
    }
}
