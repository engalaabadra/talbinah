<?php

namespace Modules\Bookmark\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\Bookmark\Repositories\Admin\Additional\BookmarkRepository;
use Modules\Bookmark\Entities\Bookmark;
use GeneralTrait;
use Modules\Bookmark\Http\Controllers\API\Admin\BookmarkResourceController;
class BookmarkController extends BookmarkResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var BookmarkRepository
     */
    protected $bookmarkRepo;
        /**
     * @var Bookmark
     */
    protected $bookmark;
    
    /**
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param Bookmark $bookmark
     * @param BookmarkRepository $bookmarkRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, Bookmark $bookmark,BookmarkRepository $bookmarkRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->bookmark = $bookmark;
        $this->bookmarkRepo = $bookmarkRepo;
    }

}
