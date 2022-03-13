<?php

namespace App\Console\Commands;
use App\Repositories\CategoryRepository;

use Illuminate\Console\Command;

class CreateCategoryCommand extends Command
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
    protected $signature = 'category:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Category name');
        $parent_id = $this->ask('Parent category id (leave empty if there is none)');

        $data = [
            'name' => $name,
            'parent_id' => $parent_id,
        ];

        $this->categoryRepository->create($data);

        $this->info('Category created successfully.');
    }
}
