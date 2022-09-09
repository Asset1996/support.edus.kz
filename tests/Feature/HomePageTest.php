<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
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
        $response = $this->get('/ru/v1');
        $response->assertStatus(200);
    }
}
