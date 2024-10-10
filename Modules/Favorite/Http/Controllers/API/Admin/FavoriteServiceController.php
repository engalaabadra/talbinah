<?php
namespace Modules\Favorite\Http\Controllers\API\Admin;
use Modules\Favorite\Http\Controllers\API\Admin\FavoriteController;
use Modules\Favorite\Services\Admin\FavoriteService;
class FavoriteServiceController extends FavoriteController
{
    /**
     * @var FavoriteService
     */
    protected $favoriteService;
      
    
    /**
     * FavoriteServiceController constructor.
     *
     */
    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    //to calling method service for Favorite : 1. using object from it 2. register in app service container and using it
    
 }