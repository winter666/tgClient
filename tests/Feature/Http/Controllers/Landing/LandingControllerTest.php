<?php


namespace Http\Controllers\Landing;

use Tests\TestCase;

class LandingControllerTest extends TestCase
{
    /** @test */
    public function index_route_test()
    {
        $this->get(route('landing.index'))
            ->assertStatus(200)
            ->assertViewIs('landing.main.index');
    }

    /** @test */
    public function prizes_page_test()
    {
        $this->get(route('landing.prizes'))
            ->assertStatus(200)
            ->assertViewIs('landing.prizes.index');
    }
}
