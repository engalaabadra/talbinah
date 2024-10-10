<?php
namespace Modules\ArticleCategory\Repositories\Resources;

use Modules\ArticleCategory\Repositories\Resources\ArticleCategoryRepositoryInterface;
use Modules\ArticleCategory\Entities\Traits\ArticleCategoryMethods;
use App\Repositories\EloquentRepository;

class ArticleCategoryRepository extends EloquentRepository  implements ArticleCategoryRepositoryInterface
{
    use ArticleCategoryMethods;
   
}
