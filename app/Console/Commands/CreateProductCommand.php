<?php

namespace App\Console\Commands;
use App\Repositories\ProductRepository;

use Illuminate\Console\Command;

class CreateProductCommand extends Command
{

    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct();
        $this->productRepository = $productRepository;
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
     */
    public function handle()
    {
        $name = $this->ask('Product name');
        $description = $this->ask('Description');
        $price = $this->ask('Price');
        $image = $this->ask('Image location');

        $data = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
        ];

        $this->productRepository->create($data, $image);

        $this->info('Product created successfully.');
    }
}
