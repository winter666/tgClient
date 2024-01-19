<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\HasUser;

class ApiTestCase extends TestCase
{
    use HasUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setupUser();
    }

    protected function requestGet($uri): TestResponse
    {
        $this->actingAs($this->user);

        return $this->get("/api/{$uri}");
    }
}
