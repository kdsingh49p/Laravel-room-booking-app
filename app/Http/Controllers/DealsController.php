<?php

namespace App\Http\Controllers;

use App\Category;
use App\Deals;
use App\DealOptions;
use App\Purchase;
use App\TransactionMaster;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function reports(Request $request){
        $requestData = $request->all();
        $deals = Deals::orderBy('created_at', 'desc');

        if(isset($requestData['merchant_id'])){
            $deals = $deals->where('merchant_id', $requestData['merchant_id']);
        }

        $deals= $deals->paginate(1000);
        return view('admin.reports', compact('deals'))->render();   
    }

    public function transaction_history(Request $request){
        $requestData = $request->all();
        $transaction_history = TransactionMaster::orderBy('created_at', 'desc')->paginate(1000);
        return view('admin.transaction_history', compact('transaction_history'));   
    }

    public function salereport(Request $request){
        $requestData = $request->all();
        $query = Purchase::orderBy('tbl_purchase.created_at', 'desc')
                        ->whereHas('getTransactionDetail', function ($q) {
                                $q->where('status', 'paid');
                        });

                if(isset($requestData['customer_id'])){
                    $query = $query->where('customer_id', $requestData['customer_id']);
                }        
                 if(isset($requestData['merchant_id'])){
                    $query = $query->join('tbl_deals', 'tbl_deals.deal_id', 'tbl_purchase.deal_id');
                    $query = $query->where('tbl_deals.merchant_id', $requestData['merchant_id']);
                }
                        //  $PurchaseArr = DB::table('tbl_purchase')
                        // ->orderBy('tbl_purchase.created_at', 'desc')
                        // ->join('transaction_master as tm', 'tbl_purchase.transaction_id', '=', 'tm.txnid')
                        // ->join('transaction_master as tm', function ($join) {
                        //     $join->on('tbl_purchase.id', '=', 'contacts.user_id')->orOn(...);
                        // })
                        //  ->paginate(1000);
                $PurchaseArr = $query->paginate(100);      
        return view('admin.purhcase_report', compact('PurchaseArr'))->render();   
    }
    public function reports_merchant(Request $request){
        $requestData = $request->all();
        $deals = Deals::orderBy('created_at', 'desc')
        ->where('merchant_id',Auth::guard('merchant')->user()->getMerchant['merchant_id'])
        ->paginate(1000);
        return view('merchant.reports', compact('deals'))->render();   
    }

    public function transaction_history_merchant(Request $request){
        $requestData = $request->all();
        $transaction_history = TransactionMaster::orderBy('created_at', 'desc')
        ->where('status', 'paid')
         ->whereHas('getPurchase', function ($q) {
                $q->where('merchant_id', Auth::guard('merchant')->user()->getMerchant['merchant_id']);
        })
        ->paginate(1000);
        return view('merchant.transaction_history', compact('transaction_history'))->render();   
    }

    public function salereport_merchant(Request $request){

        $requestData = $request->all();
       $PurchaseArr =   Purchase:: orderBy('created_at', 'desc')
                                ->where('product_type', 'deal')
                                ->whereHas('getDeal', function ($q) {
                                    $q->where('merchant_id', Auth::guard('merchant')->user()->getMerchant['merchant_id']);
                                })
                        //  ->join('tbl_deals', function ($join) {
                        //     $join->on('tbl_purchase.deal_id', '=', 'tbl_deals.deal_id')
                        //          ->where('tbl_deals.merchant_id', '=', Auth::guard('merchant')->user()->getMerchant['merchant_id']);
                        // })
                        // // ->join('tbl_merchant', 'tbl_deals.merchant_id', '=', 'tbl_merchant.merchant_id')
                             ->paginate(1000);
         // $PurchaseArr = DB::table('tbl_purchase')
        //                 ->orderBy('tbl_purchase.created_at', 'desc')
        //                 ->where('product_type', 'deal')
        //                  ->join('tbl_deals', function ($join) {
        //                     $join->on('tbl_purchase.deal_id', '=', 'tbl_deals.deal_id')
        //                          ->where('tbl_deals.merchant_id', '=', Auth::guard('merchant')->user()->getMerchant['merchant_id']);
        //                 })
        //                 ->join('tbl_merchant', 'tbl_deals.merchant_id', '=', 'tbl_merchant.merchant_id')
        //                  ->paginate(1000);
        //  echo "<pre>";
        // print_r($PurchaseArr);
        // exit;
        return view('merchant.purhcase_report', compact('PurchaseArr'))->render();   
    }

    public function index()
    {
        $deals = Deals::orderBy('created_at', 'desc')->paginate(4);
        return view('deals.index', compact('deals'))->render();
    }
    public function redeemdeal(Request $request){
     return view('deals.redeemdeal');   
    }
    public function actionredeemDeal(Request $request){
        $requestData = $request->all();
        $findRedeem = Purchase::where('redeem_code', $requestData['redeem_code'])
                        ->where('is_redeem', 0)
                        ->first();
        if($findRedeem){
            $findRedeem->is_redeem = 1;
            $findRedeem->save();
            return ['status' => 'success'];
        }else{
            return ['status' => 'not_found'];
        }
    }
    public function dealview($slug){
        if($slug){
            $deal= Deals::where('slug', $slug)->first();
            if($deal){

                $dealOptions = DealOptions::where('deal_id', $deal->deal_id)->get();

                $query = Purchase::orderBy('tbl_purchase.created_at', 'desc')
                        ->where('deal_id', $deal->deal_id)
                        ->whereHas('getTransactionDetail', function ($q) {
                                $q->where('status', 'paid');
                        });

                $PurchaseArr = $query->get();
                 $stock = 'in';
                if(count($PurchaseArr) >= $deal->total_deals){
                    $stock = 'out';
                } 

                return view('deal-view', compact('deal', 'dealOptions', 'stock'))->render();           
            }
        }

    }
    public function addcart(Request $request){
         $requestData = $request->all();
         // $request->session()->forget('cart');

         $options[] = $requestData['deal_option_id'];
        if ($request->session()->has('cart')) {
             $previous_option = $request->session()->get('cart');
            $arr= array_merge($previous_option, $options);
             $request->session()->put('cart', $arr);
        }else{
            $request->session()->put('cart', $options);
        }
        $return = [
                'status'=>'success'
            ];
        return $return; 

    }
//     public function addeventcart(Request $request){
//         $requestData = $request->all();
//         // $request->session()->forget('cart');

//         $options[] = $requestData['deal_option_id'];
//        if ($request->session()->has('cart')) {
//             $previous_option = $request->session()->get('cart');
//            $arr= array_merge($previous_option, $options);
//             $request->session()->put('cart', $arr);
//        }else{
//            $request->session()->put('cart', $options);
//        }
//        $return = [
//                'status'=>'success'
//            ];
//        return $return; 

//    }

    public function search(Request $request){
        $requestData = $request->all();
        if($requestData){
            $DealsModel = Deals::where('title', 'like', '%'.$requestData['deal'].'%')
                    ->where('city_id', '=', $requestData['city'] )
                    ->where('pending_deals', '>', 0 );
                    // ->orderBy('created_at', 'DESC');
            $DealsModel = $DealsModel->paginate(2);
        }else{
            $DealsModel = [];
        }
        
        return view('deal-grid-view', compact('DealsModel'));
    }
    public function gridview($slug, Request $request){
        
        $requestData = $request->all();
        $DealCategory = Category::where('slug', $slug)->first();
        if($DealCategory){
            $DealsModel = Deals::where('category_id', $DealCategory->category_id)
                    ->where('pending_deals', '>', 0 )
                    ->limit(6);
                    // ->orderBy('created_at', 'DESC');
                if (isset($requestData['created_at'])) {
                    $DealsModel->orderBy('created_at', $requestData['created_at']);
                }
                
                if (isset($requestData['min_price'])) {
                    $DealsModel->orderBy('min_price', $requestData['min_price']);
                }

            $DealsModel =       $DealsModel->paginate(2);
        }else{
            $DealsModel = [];
        }
        
        return view('deal-grid-view', compact('DealsModel', 'slug'));
    }
    public function deleterow(Request $request){
         $requestData = $request->all();
         // $request->session()->forget('cart');

        $deleteoptionId = $requestData['delete_option_id'];

        $optionArr = $request->session()->get('cart');
      // $saveRestOptions =   array_diff($optionArr, [$deleteoptionId]);

        foreach ($optionArr as $key => $optionId) {
            if($optionId==$deleteoptionId){
                unset($optionArr[$key]);
                break;
            }
         }
      $request->session()->forget('cart');
      $request->session()->put('cart', $optionArr);
        $return = [
                'status'=>'success'
            ];
        return $return; 

    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $deals = Deals::orderBy('created_at', 'desc')->get();
        return view('deals.create', compact('deals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          $validatedData = $request->validate([
             'title'  => 'required|max:240',
             'meta_description' => 'required|max:240',
             'total_deals' => 'required|max:50',
             'pending_deals' => 'max:240',
             'discount' => 'required',
             'city_id' => 'required|integer',
             'category_id' => 'required|integer|max:240',
             'description' => 'required',
             'is_featured' => 'max:10',
            'img_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
         ]);
                      
        $requestData = $request->all();
        // var_dump($requestData);
        $return = [
            'status' => 'fail',
             'data' => [],
        ];
        for ($i=1; $i <=4  ; $i++) { 
            if ($request->hasFile('img_'.$i)) {
                if ($request->file('img_'.$i)->isValid()) {
                    $fileNewName = time().".".$request->file('img_'.$i)->getClientOriginalExtension();
                    $destinationPath =  base_path().'//uploads/';
                    $requestData['img_'.$i]= $fileNewName;
                    $request->file('img_'.$i)->move($destinationPath, $fileNewName);
                }
             }    
        }
        if (isset($requestData['is_featured'])) {
            if($requestData['is_featured']=='on'){
                $requestData['is_featured'] =1;
            }else{
                $requestData['is_featured'] =0;
            }
        }
        
        //change admin to merchant
        
        if(Auth::guard('merchant')->check()){
            $requestData['user_id'] =  Auth::guard('merchant')->user()->id;
            $requestData['merchant_id'] = Auth::guard('merchant')->user()->getMerchant['merchant_id'];
        }
        
        $requestData['min_price'] = $requestData['option_price'][0];
        $requestData['min_actual_price'] = $requestData['option_actual_price'][0];
        $requestData['discount'] = $requestData['option_discount'][0];
        $requestData['slug'] = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $requestData['title'].'_'.md5($requestData['merchant_id'])));
        $saveDeal =  Deals::create($requestData);
        if($saveDeal){

            //save deal options
        if(is_array($requestData['option_title']) && sizeof($requestData['option_title'])){
            foreach ($requestData['option_title'] as $key => $value) {
                $saveDealOptions = [
                    "title" => $value,
                    "price" => $requestData['option_price'][$key],
                    "discount" => $requestData['option_discount'][$key],
                    "sr_no" => $requestData['option_sr_no'][$key],
                    "actual_price" => $requestData['option_actual_price'][$key],
                    "deal_id" => $saveDeal->deal_id,
                ];
                DealOptions::create($saveDealOptions);
            }
        }

            return $return = [
                'status' => 'success',
                'data' => $saveDeal->load('getDealOptions', 'getCategory', 'getCity'),
            ];  
        }
        else{
           return $return;
        }
 
     }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchant  $Merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $deal_id)
    {
        $updateDeal = Deals::find($deal_id);
        
         $requestData = $request->all();
        // var_dump($requestData);
        // exit;
       $validatedData = $request->validate([
             'title'  => 'required|max:240',
             'meta_description' => 'required|max:240',
             'total_deals' => 'required|max:50',
             'pending_deals' => 'max:240',
             'discount' => 'required',
             'city_id' => 'required|integer',
             'category_id' => 'required|integer|max:240',
             'description' => 'required',
             'is_featured' => 'max:10',
             'img_1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'img_2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'img_3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'img_4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
         ]);
                      
        $requestData = $request->all();
        // var_dump($requestData);
        $return = [
            'status' => 'fail',
             'data' => [],
        ];
        $img_1 = NULL;
        $img_2 = NULL;
        $img_3 = NULL;
        $img_4 = NULL;
        for ($i=1; $i <=4  ; $i++) { 
            if ($request->hasFile('img_'.$i)) {
                if ($request->file('img_'.$i)->isValid()) {
                    $fileNewName = time().".".$request->file('img_'.$i)->getClientOriginalExtension();
                    $destinationPath =  base_path().'//uploads/';
                    // $requestData['img_'.$i]= $fileNewName;
                    ${"img_".$i}=$fileNewName;
                    $request->file('img_'.$i)->move($destinationPath, $fileNewName);
                }
             }    
        }
        $is_featured = 0;
        if (isset($requestData['is_featured'])) {
            if($requestData['is_featured']=='on'){
                $is_featured =1;

            }    
        }
        $updateDeal->title = $requestData['title'];
             $updateDeal->meta_description = $requestData['meta_description'];
             $updateDeal->total_deals = $requestData['total_deals'];
             $updateDeal->pending_deals = $requestData['pending_deals'];
             $updateDeal->min_price = $requestData['option_price'][0];
             $updateDeal->min_actual_price = $requestData['option_actual_price'][0];
             $updateDeal->discount = $requestData['option_discount'][0];
             $updateDeal->city_id = $requestData['city_id'];
             $updateDeal->category_id = $requestData['category_id'];
             $updateDeal->description = $requestData['description'];
             $updateDeal->is_featured = $is_featured;
             if($img_1){
                $updateDeal->img_1 = $img_1;    
             }
             if($img_2){
                $updateDeal->img_2 = $img_2;    
             }
             if($img_3){
                $updateDeal->img_3 = $img_3;    
             }
             if($img_4){
                $updateDeal->img_4 = $img_4;    
             }
 
        //change admin to merchant
        $requestData['user_id'] =  1;
        $requestData['merchant_id'] =  1;
        $requestData['slug'] = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $requestData['title'].'_'.md5($requestData['merchant_id'])));    
        $updateDeal->slug = $requestData['slug'];
        $exe_updateDeal = $updateDeal->save();
        if($exe_updateDeal){
            //save deal options

            //Lets Delete All Previous Options
            // $prevDealModel=  DealOptions::where('deal_id',$deal_id)->get();
            // if(count($prevDealModel) > 0){
            //    foreach ($prevDealModel as $key => $value) {
            //         $value->delete();
            //    }
            // }
            // return var_dump($userModel);
            // exit;
            if(is_array($requestData['option_title']) && sizeof($requestData['option_title'])){
                foreach ($requestData['option_title'] as $key => $value) {
                    if(isset($requestData['option_id'][$key])){
                        $update_deal_option = DealOptions::where('option_id', $requestData['option_id'][$key])->first();
                        if($update_deal_option){
                            $update_deal_option->title = $value;
                            $update_deal_option->price = $requestData['option_price'][$key];
                            $update_deal_option->actual_price = $requestData['option_actual_price'][$key];
                            $update_deal_option->discount = $requestData['option_discount'][$key];
                            $update_deal_option->sr_no = $requestData['option_sr_no'][$key];
                            // $update_deal_option->deal_id => $deal_id;
                            if($update_deal_option->save()){

                            }
                        }
                    }else{
                        $saveDealOptions = [
                            "title" => $value,
                            "price" => $requestData['option_price'][$key],
                            "actual_price" => $requestData['option_actual_price'][$key],
                            "discount" => $requestData['option_discount'][$key],
                            "sr_no" => $requestData['option_sr_no'][$key],

                            "deal_id" => $deal_id,
                        ];
                        DealOptions::create($saveDealOptions);
                    }
                    
                    // DealOptions::create($saveDealOptions);
                }
            }





            

            return $return = [
                'status' => 'success',
                'data' => $updateDeal->load('getDealOptions', 'getCategory', 'getCity'),
            ];          
        }else{
            return $return;
        }

        
    
        
          
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merchant  $Merchant
     * @return \Illuminate\Http\Response
     */
    public function update($DealId)
    {   
        return [
            'status' => 'found',
             'data' =>  Deals::find($DealId)->load('user','getDealOptions', 'getCategory', 'getCity'),
        ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merchant  $Merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy($DealId)
    {
        $return = [
            'status' => 'fail',
        ];
        $MerchantModel = Deals::where('deal_id', $DealId)->first();
        $findUser  = $MerchantModel;
        $userId = $findUser->user_id;
        $MerchantModel->delete();

        if ($MerchantModel->trashed()) {
          
            $userModel=  User::where('id',$userId)->first();
            // return var_dump($userModel);
            // exit;
            if($userModel){
               $userModel->delete();
                if($userModel->trashed()){
                     return $return = [
                        'status' => 'delete',
                        'user_id' => $userId,
                    ];  
                }else{
                    $return['status'] = 'userModel Not Delete';
                }  
            }else{
                $return['status'] = 'User Not Found';
            }
           
            
        }else{
                $return['status'] = 'MerchantModel Not Delete';
            }
    }
    public function delete_option($option_id)
    {
        $return = [
            'status' => 'fail',
        ];
        $OptionModel = DealOptions::where('option_id', $option_id)->first();
        $OptionModel->delete();
        if ($OptionModel->trashed()) {
           return $return = [
                        'status' => 'delete',
                    ]; 
        }
    }
}
