<?php

namespace Modules\VisitChat\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Modules\VisitChat\Repositories\Admin\Additional\VisitChatRepository;
use Modules\VisitChat\Entities\VisitChat;
use GeneralTrait;
use Modules\VisitChat\Http\Controllers\API\Admin\VisitChatResourceController;
class VisitChatController extends VisitChatResourceController
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var VisitChatRepository
     */
    protected $visitRepo;
        /**
     * @var VisitChat
     */
    protected $visit;
    
    /**
     * StoreController constructor.
     *
     * @param EloquentRepository $eloquentRepo
     * @param VisitChat $visit
     * @param VisitChatRepository $visitRepo
     */
    public function __construct(EloquentRepository $eloquentRepo, VisitChat $visit,VisitChatRepository $visitRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->visit = $visit;
        $this->visitRepo = $visitRepo;
    }

}
