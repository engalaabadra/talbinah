<?php
namespace Modules\Review\Services\Admin;

use Modules\Review\Entities\Review;
use Modules\Review\Services\Admin\UserServiceInterface;
use Modules\Review\Traits\GeneralReviewTrait;

class ReviewService  implements ReviewServiceInterface
{
    use GeneralReviewTrait;


}
