<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_navbar_is_rendered_only_once(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $this->assertSame(1, substr_count($response->getContent(), '<nav id="main-nav"'));
    }
}
