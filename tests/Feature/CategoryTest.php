<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Test if the categories are returned.
     *
     * @return void
     */
    public function test_get_categories()
    {
        $response = $this->get('api/categories');
        $response->assertStatus(200);
    }

    /**
     * Test if the categories are stored.
     *
     * @return void
     */
    public function test_store_categories()
    {
        $response = $this->post('api/categories', ['name' => 'Test']);
        $response->assertStatus(201);
    }
}
