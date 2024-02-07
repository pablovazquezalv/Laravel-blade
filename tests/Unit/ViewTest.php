<?php

namespace Tests\Unit;

use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_viewApp(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_viewRegister(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_viewLogin(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_viewWelcome(): void
    {
        $response = $this->get('/welcome');
        $response->assertRedirect();
    }

    public function test_viewEmail(): void
    {
        $id = 1;
        $response = $this->get('/email');
        $response->assertRedirect();
    }


}
