<?php

namespace Modules\Payment\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use Modules\Payment\Http\Requests\StorePaymentRequest;
use Modules\Payment\Http\Requests\UpdatePaymentRequest;
use Modules\Payment\Http\Requests\DeletePaymentRequest;
use App\Repositories\EloquentRepository;
use Modules\Payment\Repositories\Admin\Resources\PaymentRepository;
use Modules\Payment\Entities\Payment;
use GeneralTrait;
use Modules\Payment\Resources\Admin\PaymentResource;

class PaymentResourceController extends Controller
{
    use GeneralTrait;
    /**
     * @var EloquentRepository
     */
    protected $eloquentRepo;
    /**
     * @var PaymentRepository
     */
    protected $paymentRepo;
        /**
     * @var Payment
     */
    protected $payment;
    
    /**
     * PaymentsController constructor.
     *
     * @param PaymentRepository $payments
     */
    public function __construct(EloquentRepository $eloquentRepo, Payment $payment,PaymentRepository $paymentRepo)
    {
       $this->eloquentRepo = $eloquentRepo;
        $this->payment = $payment;
        $this->paymentRepo = $paymentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $payments=$this->paymentRepo->all($request, $this->payment);
        $data=getDataResponse(PaymentResource::collection($payments));
        return successResponse(0,$data);
    }

    // methods for trash
    public function trash(Request $request){
        $payments=$this->paymentRepo->trash($this->payment,$request);
        if(is_string($payments)) return  clientError(4,$payments);
        $data=PaymentResource::collection($payments)->getDataResponse();
        return successResponse(0,$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $payment=  $this->paymentRepo->store($request,$this->payment);
        if(is_string($payment)) return  clientError(0,$payment);
        return successResponse(1,new PaymentResource($payment));
    }
    public function storeTrans(StorePaymentRequest $request,$id,$lang)
    {
        $payment=  $this->paymentRepo->storeTrans($request,$this->payment,$id,$lang);
        return successResponse(1,new PaymentResource($payment));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment=$this->paymentRepo->show($id,$this->payment);
        if(is_numeric($payment)) return  clientError(4,$payment);
        return successResponse(0,new PaymentResource($payment));
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request,$id)
    {
        $payment= $this->paymentRepo->update($request,$this->payment,$id);
        if(is_numeric($payment)) return  clientError(4,$payment);
        return successResponse(2,new PaymentResource($payment));
    }

    //methods for restoring
    public function restore($id){
        $payment =  $this->paymentRepo->restore($id,$this->payment);
        if(is_string($payment)) return  clientError(4,$payment);
        return successResponse(5,new PaymentResource($payment));
    }
    public function restoreAll(){
        $payments =  $this->paymentRepo->restoreAll($this->payment);
        if(is_string($payment)) return  clientError(4,$payment);
        return customResponse(205,$payments );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeletePaymentRequest $request,$id)
    {
        $payment= $this->paymentRepo->destroy($id,$this->payment);
        if(is_numeric($payment)) return  clientError(4,$payment);
        return successResponse(2,new PaymentResource($payment));  
    }
    public function forceDelete(DeletePaymentRequest $request,$id)
    {
        //to make force destroy for a Payment must be this Payment  not found in Payments table  , must be found in trash Categories
        $payment=$this->paymentRepo->forceDelete($id,$this->payment);
        if(is_numeric($payment)) return  clientError(4,$payment);
        return successResponse(4,new PaymentResource($payment));
    }

}
