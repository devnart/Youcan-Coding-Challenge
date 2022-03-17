<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        $response->assertOk();
    }

    /**
     * Test if the products are sorted.
     *
     * @return void
     */
    public function test_sort_products()
    {
        $response = $this->get('api/products?sort=name');
        $response->assertOk();
    }

    /**
     * Test if the products are sorted by category.
     *
     * @return void
     */
    public function test_sort_products_by_category()
    {
        $response = $this->get('api/products?sort=name&category=1');
        $response->assertOk();
    }

    public function test_product_creation(){
        Storage::fake('photos');
        $response = $this->post('api/products', [
            'name' => 'Test Product',
            'price' => '100',
            'description' => 'Test Description',
            'image' => UploadedFile::fake()->image('test.jpg')
        ]);
        $response->assertCreated();
    }

}
