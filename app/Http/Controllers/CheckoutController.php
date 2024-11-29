<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\CatePost;
use App\Models\Order;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Models\OrderDetails;
use App\Models\Shipping;
session_start();
class CheckoutController extends Controller
{
    public function conform_order(Request $request){
        // $data = array();
        // $data['shipping_name'] = $request->shipping_name;
        // $data['shipping_email'] = $request->shipping_email;
        // $data['shipping_phone'] = $request->shipping_phone;
        // $data['shipping_address'] =$request->shipping_address;
        // $data['shipping_nodes'] =$request->shipping_nodes;
        // $data['shipping_method'] =$request->shipping_method;
        // $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        // Session::put('shipping_id',$shipping_id);
       
        $data = $request->all();
        //get coupon
        $coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
        if($coupon){
            $coupon -> coupon_used = $coupon -> coupon_used .','. Session::get('customer_id');  
            $coupon -> coupon_times =$coupon -> coupon_times - 1;
            $coupon->save();
        }
       
         //get vận chuyển
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_nodes = $data['shipping_nodes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;
        //get order
        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order-> shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->order_date = $order_date;
        $order->created_at = $today;
        $order->save();
         
         
       
        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details -> order_code = $checkout_code;
                $order_details -> product_id = $cart['product_id'];
                $order_details -> product_name = $cart['product_name'];
                $order_details -> product_price = $cart['product_price'];
                $order_details -> product_sales_quantity = $cart['product_qty'];
                $order_details -> product_coupon = $data['order_coupon'];
                $order_details -> product_feeshipp = $data['order_fee'];
                $order_details -> save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }
    public function del_fee(){
        Session::forget('fee');
        return Redirect()->back();
    }
    
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
        }
        if($feeship){
            $count_feeship = $feeship->count();
            if($count_feeship > 0){
                foreach($feeship as $key => $fee){
                    Session::put('fee', $fee->fee_feeship);
                    Session::save();
                }
            }else{
                Session::put('fee', 25000);
                    Session::save();
            }
        }
        

    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                $output .= '<option>--Chọn quận huyện--</option>';
                foreach($select_province as $key => $province){
                    $output .= '<option value="'.$province->maqh.'">'.$province->name_qh.'</option>';
                }
                
            }else{
                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output .= '<option>--Chọn xã phường--</option>';
                foreach($select_wards as $key => $ward){
                    $output .= '<option value="'.$ward->xaid.'">'.$ward->name_xp.'</option>';
                }
            }
            echo $output;
        }
       
    }
    public function login_checkout(){
        $meta_title = "Đăng nhập - Đăng ký";
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('page.checkout.login_checkout')-> with('meta_title',$meta_title)-> with('category',$cate_product) -> with('brand',$brand_product)->with('category_post',$category_post);
    }
    
    public function checkout(Request $request){
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();

        $meta_desc = "Đăng nhập thanh toán";
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "thanh toán";
        $url_canonical = $request->url() ;

        $city = City::orderby('matp','ASC')->get();
        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
        
        return view('page.checkout.show_checkout')-> with('category',$cate_product) -> with('brand',$brand_product)
        -> with('meta_desc',$meta_desc) -> with('meta_keywords',$meta_keywords)
        -> with('meta_title',$meta_title) -> with('url_canonical',$url_canonical)-> with('city',$city)->with('category_post',$category_post);
    }
    // public function save_checkout_customer(Request $request){
    //     $data = array();
    //     $data['shipping_name'] = $request->shipping_name;
    //     $data['shipping_phone'] = $request->shipping_phone;
    //     $data['shipping_email'] = $request->shipping_email;
    //     $data['shipping_nodes'] =$request->shipping_nodes;
    //     $data['shipping_address'] =$request->shipping_address;
        
    //     $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
    //     Session::put('shipping_id',$shipping_id);
    //     return Redirect::to('/payment');
    // }
    // public function payment(){
    //     $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
    //     $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();

    //     return view('page.checkout.payment')-> with('category',$cate_product) -> with('brand',$brand_product);
    // }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_vip'] = '0';
        $data['customer_password'] =md5( $request->customer_password);
        $result = DB::table('tbl_customer')->where('customer_email', $data['customer_email'])->first();
        if($result){
           
            return Redirect::to('/login-checkout')->with('error','Bạn đăng ký email đã có vui lòng nhập lại !!!');
           
        }else{
            $customer_id = DB::table('tbl_customer')->insertGetId($data);
            Session::put('customer_id',$customer_id);
            Session::put('customer_name',$request->customer_name);
            return Redirect::to('/checkout');
        }
            // return redirect()->back()->with('error','Email đã trùng vui lòng nhập email khác ');
        
        
    }
    public function login_customer(Request $request){
        $email = $request->email_accout;
        $password = md5($request->password_accout);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        if(Session::get('coupon') == true){
            Session::forget('coupon');
        }
        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/trang-chu');
        }else{
            
            return Redirect::to('/login-checkout')->with('error','Bạn nhâp mật khẩu hoặc email sai vui lòng nhập lại !!!');
        }
        
    }
    //cổng thanh toán
    public function vnpay_payment(Request $request){
        $data = $request->all();
        $code_cart = rand(00,9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/petshop/checkout";
        $vnp_TmnCode = "XM3Q5QYN";//Mã website tại VNPAY 
        $vnp_HashSecret = "NYDTFBBZXAYEFJFCNSRRPBGILJCMSWGC"; //Chuỗi bí mật
        
        $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo ='Thanh toán đơn hàng test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
      
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        
            
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }
    // thanh toán momo
    public function execPostRequest($url, $data){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momo_payment(Request $request){
    

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $_POST['total_momo'];
        $orderId = time() . "";
        $redirectUrl = "http://localhost/petshop/checkout";
        $ipnUrl = "http://localhost/petshop/checkout";
        $extraData = "";
            $requestId = time() . "";
            $requestType = "payWithATM";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            // dd($signature);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = $this-> execPostRequest($endpoint, json_encode($data));
            // dd($result);
          
            $jsonResult = json_decode($result, true);  // decode json
            return redirect()->to($jsonResult['payUrl']);
            //Just a example, please check more in there
        
            
        
        
    }
}
