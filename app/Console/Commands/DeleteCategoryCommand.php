<?php

namespace App\Console\Commands;
use App\Repositories\CategoryRepository;

use Illuminate\Console\Command;

class DeleteCategoryCommand extends Command
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete category by id'; 

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->option('id');
        $this->categoryRepository->delete($id);
        $this->info('Category deleted successfully.');
    }
}
