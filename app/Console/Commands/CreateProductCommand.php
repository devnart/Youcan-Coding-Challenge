<?php

namespace App\Console\Commands;
use App\Repositories\ProductRepository;

use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CreateProductCommand extends Command
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new product';

    /**
     * Execute the console command.
     * @throws ValidationException
     */
    public function handle()
    {
        $name = $this->ask('Product name');
        $description = $this->ask('Description');
        $price = $this->ask('Price');

        Storage::fake('photos');


        $data = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => UploadedFile::fake()->image('command.jpg')
        ];

        $this->productService->create($data);
        $this->info('Product created successfully.');
    }
}
