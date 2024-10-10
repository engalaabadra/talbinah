<?php
namespace Modules\Duration\Repositories;

use Modules\Duration\Entities\Duration;
use Modules\Duration\Repositories\DurationRepositoryInterface;
use Modules\Duration\Entities\Traits\DurationMethods;
use GeneralTrait;
use App\Repositories\EloquentRepository;
class DurationRepository extends EloquentRepository implements DurationRepositoryInterface
{
    use GeneralTrait,DurationMethods;
}