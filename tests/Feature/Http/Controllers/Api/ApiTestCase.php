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

    protected function requestGet(string $uri): TestResponse
    {
        $this->actingAs($this->user);

        return $this->get("/api/{$uri}");
    }

    protected function requestPost(string $uri, array $data): TestResponse
    {
        $this->actingAs($this->user);

        return $this->post("/api/{$uri}", $data);
    }

    protected function requestPatch(string $uri, array $data): TestResponse
    {
        $this->actingAs($this->user);

        return $this->patch("/api/{$uri}", $data);
    }

    protected function requestDelete(string $uri): TestResponse
    {
        $this->actingAs($this->user);

        return $this->delete("/api/{$uri}");
    }
}
