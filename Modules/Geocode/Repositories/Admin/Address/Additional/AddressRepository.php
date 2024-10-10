<?php
namespace Modules\Type\Repositories\Admin\Address\Additional;

use App\Repositories\EloquentRepository;
use Modules\Geocode\Entities\Address;
use Modules\Geocode\Repositories\Admin\Address\Additional\AddressRepositoryInterface;
use Modules\Geocode\Entities\Traits\Address\GeneralAddressTrait;

class AddressRepository extends EloquentRepository implements AddressRepositoryInterface
{
    use GeneralAddressTrait;
}