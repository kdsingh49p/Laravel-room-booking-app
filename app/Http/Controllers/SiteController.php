<?php

namespace App\Http\Controllers;
use App\components\Helper;
use App\components\Features;
use App\Deals;
use App\DealOptions;
use App\TransactionMaster;

use Illuminate\Http\Request;
use App\User;
use App\Purchase;
use App\tbl_event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use PDF;
use DOMPDF;
class SiteController extends Controller
{
	public function checkout(){
        return view('checkout');
  }
  public function welcome(){
        return view('welcome');
  }
   public function logout()
    {
         Auth::guard('admin')->logout();
         return view('index');
    }

  public function checkLogin(Request $request)
     {
         $validatedData = $request->validate([
             'email' => 'required',
            'password' => 'required',
        ]);
        $requestData = $request->all();
      $userModel = User::where('email', $requestData['email'])->first();
     
    // var_dump($requestData);
    if (Auth::guard('admin')->attempt(['email' => $requestData['email'], 'password' => $requestData['password'], ])) {
        return $return = [
                    'status' => 'success',
                 ];  
    }else{
            return $return = [
                    'status' => 'fail',
                 ];  

    }    
      
        
    }
    public function login(){
      return view('index');
    }
   public function eventinvoice($purchase_id){
    $eventPurchase = Purchase::where('customer_id', Auth::id())
                            ->where('purchase_id', $purchase_id)
                            ->first();
    if(isset($_GET['html'])){
      return view('dashboard.invoiceevent', compact('eventPurchase')); 
    }else{
      $pdf = PDF::loadView('dashboard.invoiceevent', compact('eventPurchase'));
      return $pdf->stream();
    }
                        

  }
  public function purchasedevents(){
    $PurchaseArr = Purchase::where('customer_id', Auth::id())
                    ->where('product_type', 'event')
                    ->join('transaction_master', 'transaction_master.txnid', 'tbl_purchase.transaction_id')
                    ->where('transaction_master.status', 'paid')
                      ->get();
     return view('dashboard.purchasedevents', compact('PurchaseArr'));
  }
  public function checkoutevent(Request $request){
    $requestData = $request->all();
    if($requestData['event_id']){
      $arr = [
        'event_id' => $requestData['event_id'],
        'qty' => $requestData['qty'],
        'price' => $requestData['price'],
        't_price' => $requestData['t_price'],
      ];

      $request->session()->put('eventcart', $arr);
      return view('checkout_event');
    }
 }
 public function eventcheckoutsave(Request $request){
   // return view('checkout');
   $this->validate($request, [
    'bill_person_name'  => 'required|max:240',
    'bill_address'  => 'required|string|max:240',
     'bill_mobile' => 'required|max:40',
     'bill_city_id' => 'required|max:40',
     'bill_email' =>  'required|max:240',
    ]);
   
  $requestData = $request->all();
 $requestData['bill_address'] = $requestData['bill_address']." - ".$requestData['postal_code'];
 $total = 0;
  if ($request->session()->has('eventcart')) {
       $cart = $request->session()->get('eventcart');
            $event = tbl_event::where('event_id', $cart['event_id'])->first();
            $total = $cart['t_price'];
  }
  $transactionarr = [
       'amount' => $total,
     'productinfo' => 'Event',
     'firstname' => $requestData['bill_person_name'],
      'phone' => $requestData['bill_mobile'],
     'status' => 'unpaid',
      'user_id' => Auth::id()
  ];
  $save =  TransactionMaster::create($transactionarr);

  // "event_id",
  // "event_qty",
  // "event_price",
  // "product_type",
       
             $newPurchase = new Purchase();
             $newPurchase->event_id = $cart['event_id'];
             $newPurchase->event_qty = $cart['qty'];
             $newPurchase->event_price = $cart['price'];
             $newPurchase->product_type = 'event';

              $newPurchase->customer_id = Auth::id();
              // $newPurchase->invoice_url = 
              $newPurchase->price = $cart['t_price'];
               $newPurchase->bill_person_name = $requestData['bill_person_name'];
              $newPurchase->bill_address = $requestData['bill_address'];
              $newPurchase->bill_mobile = $requestData['bill_mobile'];
              $newPurchase->bill_email = $requestData['bill_email'];

               $newPurchase->bill_city_id =  $requestData['bill_city_id'];
               $newPurchase->transaction_id =  $save->txnid;
              $newPurchase->save();
       
 
 
  if($save){
    $surl=   "http://nearbuydiscounts.com/site/transaction-success";
    $furl= "http://nearbuydiscounts.com/site/transaction-fail";
    $posted = [];
  // $posted['key']= 'w0oSdS';
    $posted['key']= 'oLCzgD';
    $posted['txnid']= $save->txnid;
    $posted['amount']= $total;
    $posted['firstname']= Auth::user()->name;
    $posted['email']= $requestData['bill_email'];
    $posted['phone']= Auth::user()->mobile;
    $posted['productinfo']= 'event';
    $posted['surl']=$surl;
    $posted['furl']= $furl;
    $posted['service_provider']='payu_paisa';
    $request->session()->forget('eventcart');
  return view('dashboard.payu', compact('posted'));
        
  

 }
 }
	public function dashboard(){
    $PurchaseArr = Purchase::where('customer_id', Auth::id())
        ->join('transaction_master', 'transaction_master.txnid', 'tbl_purchase.transaction_id')
        ->where('transaction_master.status', 'paid')
        ->where('product_type', 'deal')->get();
  
        return view('dashboard.index', compact('PurchaseArr'));
	}
  public function contactpost(Request $request){
    $requestData = $request->all();
    
    if($requestData){
        $message = "Name:- ".$requestData['name']." \r\n";
        $message .= "Email:- ".$requestData['email']." \r\n";
        $message .= "Phone:- ".$requestData['phone']." \r\n";
        $message .= "Message:- ".$requestData['message']." \r\n";
              $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          // More headers
      $headers .= 'From: <kuldeepsinghnetweb@gmail.com>' . "\r\n";
        mail('contact@nearbuydiscounts.com', "Contact From Deal Website", $message, $headers);

        return redirect('/contact')->with('success','Mail Sent successfully'); 
    }
  }
  public function eventcart($eventId){
    $event = tbl_event::where('event_id', $eventId)->first();
    return view('eventcart', compact('event')); 

  }
  public function invoice($purchase_id){
   $DealPurchase = Purchase::where('customer_id', Auth::id())
                            ->where('purchase_id', $purchase_id)
                            ->first();
  return view('dashboard.invoice', compact('DealPurchase')); 
  }
	public function checkoutsave(Request $request){
		
        // return view('checkout');
           $this->validate($request, [
        	'bill_person_name'  => 'required|max:240',
        	'bill_address'  => 'required|string|max:240',
 	        'bill_mobile' => 'required|max:40',
           'bill_city_id' => 'required|max:40',
           'bill_email' =>  'required|max:240',
          ]);
         
        $requestData = $request->all();
     	$requestData['bill_address'] = $requestData['bill_address']." - ".$requestData['postal_code'];
     	$total = 0;
        if ($request->session()->has('cart')) {
             $cart = $request->session()->get('cart');
              foreach ($cart as $key => $cart_deal_option){
              		$dealOption = DealOptions::where('option_id', $cart_deal_option)->first();
              		$total += $dealOption->price;
             }
        }
        $transactionarr = [
		         'amount' => $total,
		  		 'productinfo' => 'Deal',
		  		 'firstname' => $requestData['bill_person_name'],
		   		 'phone' => $requestData['bill_mobile'],
		    	 'status' => 'unpaid',
		   		 'user_id' => Auth::id()
				];
        $save =  TransactionMaster::create($transactionarr);

        if ($request->session()->has('cart')) {
             $cart = $request->session()->get('cart');
              foreach ($cart as $key => $cart_deal_option){
              		$dealOption = DealOptions::where('option_id', $cart_deal_option)->first();
              		 $newPurchase = new Purchase();
              		 $newPurchase->deal_id = $dealOption->deal_id;
                   $findDeal = Deals::where('deal_id', $dealOption->deal_id)->first();
                   if($findDeal){
                     $newPurchase->merchant_id = $findDeal->merchant_id;
                   }
                  
        			 		 $newPurchase->deal_option_id = $dealOption->option_id;
        			 		 $newPurchase->customer_id = Auth::id();
        			 		 // $newPurchase->invoice_url = 
        			 		 $newPurchase->price = $dealOption->price;
        			 		 $newPurchase->redeem_code =  Helper::generateRandomString(5);
         			 		 $newPurchase->bill_person_name = $requestData['bill_person_name'];
        			 		 $newPurchase->bill_address = $requestData['bill_address'];
                    $newPurchase->bill_mobile = $requestData['bill_mobile'];
                    $newPurchase->bill_email = $requestData['bill_email'];
         			 		 $newPurchase->bill_city_id =  $requestData['bill_city_id'];
         			 		 $newPurchase->transaction_id =  $save->txnid;
        			 		 $newPurchase->save();
              }
        }
       
        if($save){
                $surl=   "http://nearbuydiscounts.com/site/transaction-success";
                $furl= "http://nearbuydiscounts.com/site/transaction-fail";
                $posted = [];
            // $posted['key']= 'w0oSdS';
              $posted['key']= 'oLCzgD';
              $posted['txnid']= $save->txnid;
              $posted['amount']= $total;
              $posted['firstname']= Auth::user()->name;
              $posted['email']= $requestData['bill_email'];
              $posted['phone']= Auth::user()->mobile;
              $posted['productinfo']= 'deal';
              $posted['surl']=$surl;
              $posted['furl']= $furl;
              $posted['service_provider']='payu_paisa';
          return view('dashboard.payu', compact('posted'));
        	    $request->session()->forget('cart');
        }

        return redirect('/checkout')->with('success','created successfully');
	}
  public function transactionSuccess(Request $request){
    $status=$_POST["status"];
       $firstname=$_POST["firstname"];
       $amount=$_POST["amount"];
       $txnid=$_POST["txnid"];
       $posted_hash=$_POST["hash"];
       $key=$_POST["key"];
       $productinfo=$_POST["productinfo"];
       $email=$_POST["email"];
       $payuMoneyId=$_POST["payuMoneyId"];
       $mode=$_POST["mode"];
       $salt="yJaX5igd";

       // Salt should be same Post Request 

       If (isset($_POST["additionalCharges"])) {
              $additionalCharges=$_POST["additionalCharges"];
               $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         } else {
               $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
                }
        $hash = hash("sha512", $retHashSeq);
          if ($hash != $posted_hash) {
              echo "Invalid Transaction. Please try again";
          } else {

               $TransactionModel = TransactionMaster::where('txnid', $txnid)->first();
                   if($TransactionModel){
                       $TransactionModel->status = 'paid';
                       $TransactionModel->hash = $hash;
                       $TransactionModel->payuMoneyId = $payuMoneyId;
                       $TransactionModel->mode = $mode;
                       if($TransactionModel->save()){
                           if($status=='success'  || $status=='success;'){
                               if($productinfo=='deal'){
                                   return redirect('/dashboard/index')->with('success','Your deal is purachsed');
                               }else{
                                   return redirect('/dashboard/events')->with('success','Event Tickets Booked successfully');

                                }    
                               
                                
                           }    
                       }
                       
               }
             echo "<h3>Thank You. Your order status is ". $status .".</h3>";
             echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
             echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
          }
 }
 public function transactionFail(Request $request){
     
 }
}