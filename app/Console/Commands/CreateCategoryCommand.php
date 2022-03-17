<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;

class CreateCategoryCommand extends Command
{
    private $categoryService;

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
    protected $signature = 'category:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new category';

    /**
     * Execute the console command.
     * @throws ValidationException
     */
    public function handle()
    {
        $name = $this->ask('Category name');
        $parent_id = $this->ask('Parent category id (leave empty if there is none)');

        $data = [
            'name' => $name,
            'parent_id' => $parent_id,
        ];

        $this->categoryService->create($data);

        $this->info('Category created successfully.');
    }
}
