<?php
namespace Modules\Bookmark\Http\Controllers\API\Admin;
use Modules\Bookmark\Http\Controllers\API\Admin\BookmarkController;
use Modules\Bookmark\Services\Admin\BookmarkService;
class BookmarkServiceController extends BookmarkController
{
    /**
     * @var BookmarkService
     */
    protected $bookmarkService;
      
    
    /**
     * BookmarkServiceController constructor.
     *
     */
    public function __construct(BookmarkService $bookmarkService)
    {
        $this->bookmarkService = $bookmarkService;
    }

    //to calling method service for Bookmark : 1. using object from it 2. register in app service container and using it
    
 }