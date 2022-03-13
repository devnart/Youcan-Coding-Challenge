<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Test if the products are returned.
     *
     * @return void
     */
    public function test_get_products()
    {
        $response = $this->get('api/products');
        $response->assertStatus(200);
    }

    /**
     * Test if the products are sorted.
     *
     * @return void
     */
    public function test_sort_products()
    {
        $response = $this->get('api/products?sort=name');
        $response->assertStatus(200);
    }

    /**
     * Test if the products are sorted by category.
     *
     * @return void
     */
    public function test_sort_products_by_category()
    {
        $response = $this->get('api/products?sort=name&category=1');
        $response->assertStatus(200);
    }

}
