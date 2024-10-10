<?php
namespace Modules\Review\Services\Doctor;

use Modules\Review\Entities\Review;
use Modules\Review\Services\Doctor\ReviewServiceInterface;
use Modules\Review\Traits\GeneralReviewTrait;

class ReviewService  implements ReviewServiceInterface
{
    use GeneralReviewTrait;


}
