<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function testApi()
    {
        $this->postJson('/some-route', ['field' => 'on'])
            ->assertStatus(200)
            ->assertJsonFragment(['error' => true]);
    }

    public function testApiWithMacro()
    {
        $this->postJson('/some-route', ['field' => 'on'])
            ->assertErrorInResponse();
    }
}
