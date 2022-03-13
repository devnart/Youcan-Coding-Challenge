<?php

namespace App\Console\Commands;
use App\Repositories\ProductRepository;

use Illuminate\Console\Command;

class DeleteProductCommand extends Command
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
        $product = $this->productRepository->delete($id);
        $this->info('Product deleted successfully.');
    }
}
