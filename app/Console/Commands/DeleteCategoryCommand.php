<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use Illuminate\Console\Command;

class DeleteCategoryCommand extends Command
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
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
        $this->categoryService->delete($id);
        $this->info('Category deleted successfully.');
    }
}
