<?php
namespace Modules\Review\Services\User;

use Modules\Review\Entities\Review;
use Modules\Review\Services\User\UserServiceInterface;
use Modules\Review\Traits\GeneralReviewTrait;

class ReviewService  implements ReviewServiceInterface
{
    use GeneralReviewTrait;


}
