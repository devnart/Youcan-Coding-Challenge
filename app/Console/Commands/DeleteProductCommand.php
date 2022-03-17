<?php

namespace App\Console\Commands;
use App\Repositories\ProductRepository;

use App\Services\ProductService;
use Illuminate\Console\Command;

class DeleteProductCommand extends Command
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
    protected $signature = 'product:delete {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete product by id';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->option('id');
        $this->productService->delete($id);
        $this->info('Product deleted successfully.');
    }
}
