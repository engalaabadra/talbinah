<?php

namespace Modules\Contact\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Contact\Repositories\Admin\Resources\ContactRepository;
use Modules\Contact\Entities\Contact;
use GeneralTrait;
use Modules\Contact\Resources\Admin\ContactResource;
class ContactResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var ContactRepository
     */
    protected $contactRepo;
        /**
     * @var Contact
     */
    protected $contact;
    
    /**
     * ContactController constructor.
     *
     * @param ContactRepository $contacts
     */
    public function __construct( Contact $contact,ContactRepository $contactRepo)
    {
        $this->contact = $contact;
        $this->contactRepo = $contactRepo;
    }


}
