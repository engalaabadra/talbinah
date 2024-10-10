<?php

namespace Modules\ArticleCategory\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ArticleCategory\Entities\ArticleCategory;
/**
 * Class ArticleCategoryTableSeeder.
 */
class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run(): void
    {
        ArticleCategory::create([
            'name' => trans("articles_categories.seeders.COVID-19"),
        ]);
        ArticleCategory::create([
            'name' => trans("articles_categories.seeders.Health"),
        ]);
        
    }
}
