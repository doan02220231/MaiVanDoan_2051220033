<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Models\OrderThue;// chi tiết pet
use App\Models\Order_thue;
use App\Models\Shipping_thue;
use App\Models\Customer;
use App\Models\PetProduct;
use App\Models\CombDetails;
use App\Models\RatingThue;
session_start();
class CheckoutThueController extends Controller
{
     public function update_tinh_trang(Request $request){
        $data = $request->all();
        // $order_id = $data['order_id'];
        // $order = Order::where('order_id',$order_id)->first();
        $update_tt = PetProduct::find($data['pet_id']);
        $update_tt->pet_status = $data['pet_thue_trang_thai'];
        $update_tt->save();  
    }
    
    public function manage_order_thue(){
        $order_details = OrderThue::with('petproduct')->get();
        $order = Order_thue::orderBy('created_at',"desc")->get();
        $pet = PetProduct::orderBy('pet_id')->first();

            foreach($order_details as $key => $der){
            $pet_id = $der->pet_id;
        }
        $pet_show = PetProduct::orderBy('pet_status')->where('pet_id',$pet_id )->get();
        return view('admin.order_thue.manage_order_thue') -> with(compact('order','pet_show'));
      
    }
    public function view_order_thue($order_thue_code){
    
        $order_details = OrderThue::with('petproduct')->where('order_code_thue',$order_thue_code)->get();
        $order = Order_thue::where('order_thue_code',$order_thue_code)->get();
         $pet = PetProduct::orderBy('pet_id')->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_thue_id;
            $order_status = $ord->order_thue_status;
        }
           foreach($order_details as $key => $der){
            $pet_id = $der->pet_id;
        }

        $pet_show = PetProduct::orderBy('pet_status')->where('pet_id',$pet_id )->get();
        $customer = Customer::where('customer_id',$customer_id)->first();
        $combo_pro = CombDetails::where('order_code_combo',$order_thue_code)->get();
        $shipping = Shipping_thue::where('shipping_thue_id',$shipping_id)->first();
        $order_details_product = OrderThue::with('petproduct')->where('order_code_thue', $order_thue_code)->get();

        foreach($order_details_product as $key => $order_d){
            $pet_coupon = $order_d->pet_coupon;
            
        }
        if($pet_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$pet_coupon)->first();
            $coupon_condition = $coupon-> coupon_condition;
            $coupon_number = $coupon-> coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        
        return view('admin.order_thue.view_order_thue') -> with(compact('order_details','customer','shipping','order_details','order_details_product','pet','pet_show',
      'coupon_condition','coupon_number','order','order_status','combo_pro'));
        
      
    }
    public function checkout_thue(){
        return view('page.checkout_thue.show_checkout_thue');
    }

public function conform_order_thue(Request $request){
        // $data = array();
        // $data['shipping_name'] = $request->shipping_name;
        // $data['shipping_email'] = $request->shipping_email;
        // $data['shipping_phone'] = $request->shipping_phone;
        // $data['shipping_address'] =$request->shipping_address;
        // $data['shipping_nodes'] =$request->shipping_nodes;
        // $data['shipping_method'] =$request->shipping_method;
        // $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        // Session::put('shipping_id',$shipping_id);
       // Lấy ID khách hàng từ session
    $customer_id = Session::get('customer_id');

    // Kiểm tra xem khách hàng đã có đơn hàng chưa hoàn thành hay chưa
    $existing_order = Order_thue::where('customer_id', $customer_id)
                                ->where('order_thue_status', '!=', 2) // Giả định trạng thái 2 là hoàn thành
                                ->first();

    if ($existing_order) {
    // Trả về thông báo lỗi nếu đã có đơn hàng chưa hoàn thành và chuyển hướng về trang chủ
    return redirect('show_checkout_thue')->with('error', 'Bạn đã đang thuê một bé cún.Bạn không thể thuê thêm pet mới.Xin cảm ơn!!');
}
      $data = $request->all();
        //get coupon
        
       
         //get vận chuyển
        $shipping = new Shipping_thue();
        $shipping->shipping_thue_name = $data['shipping_name'];
        $shipping->shipping_thue_address = $data['shipping_address'];
        $shipping->shipping_thue_phone = $data['shipping_phone'];
        $shipping->shipping_thue_email = $data['shipping_email'];
        $shipping->shipping_thue_nodes = $data['shipping_nodes'];
        $shipping->shipping_thue_method = $data['shipping_method'];
        $shipping->save();
        

         $shipping_thue_id = $shipping->shipping_thue_id;
        //get order
        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        $order = new Order_thue;
        $order->customer_id = Session::get('customer_id');
        $order-> shipping_thue_id = $shipping_thue_id;
        
        $order->order_thue_status = 1;
        $order->order_thue_suc_khoe = 3;
        $order->order_thue_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->order_thue_date = $order_date;
        $order->created_at = $today;
        $order->save();

           if(Session::get('cart_thue')){
            foreach(Session::get('cart_thue') as $key => $cart_thue){
                $order_details_thue = new OrderThue;
                $order_details_thue -> order_code_thue = $checkout_code;
                $order_details_thue -> pet_id = $cart_thue['pet_id'];
                $order_details_thue -> pet_name = $cart_thue['pet_name'];
                $order_details_thue -> pet_price = $cart_thue['pet_price'];
                $order_details_thue -> pet_slug = $cart_thue['pet_slug'];
                $order_details_thue -> pet_qty = $cart_thue['pet_qty'];
                $order_details_thue -> pet_coupon = $data['order_coupon'];
                $order_details_thue -> save();
            }
        }

             if(Session::get('cart_combo')){   
            foreach(Session::get('cart_combo') as $key => $cart_combo){
                $order_details_combo = new CombDetails; 
                $order_details_combo -> combo_details_name = $cart_combo['combo_name'];
                $order_details_combo -> combo_details_gia = $cart_combo['combo_gia'];
                $order_details_combo -> order_code_combo = $checkout_code;
                $order_details_combo -> save();
            }
        }
        Session::forget('coupon');
        Session::forget('cart_thue');
        Session::forget('cart_combo');


   }  

     public function history_thue(Request $request){
        if(!Session::get('customer_id')){
            return Redirect('dang-nhap')->with('error', ' vui lòng đăng nhập để vào lịch sữ mua hàng') ;
        }else{
            $meta_decs ="Lịch sữ đơn hàng ";
            $meta_keywords = "Lịch sữ đơn hàng";
            $meta_titel ="Lịch sữ đơn hàng";
            $url_canonical = $request->url();
             $customer_id = Session::get('customer_id');
        $order_details = OrderThue::with('petproduct')->get();
        $order = Order_thue::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();
        $pet = PetProduct::orderBy('pet_id')->get();    

           foreach($order_details as $key => $der){
            $pet_id = $der->pet_id;
            $order_code_thue = $der->order_code_thue;
         }
         $rating_thue = RatingThue::where('rating_code_id', $order_code_thue)->paginate(7);
         $pet_show = PetProduct::orderBy('pet_status')->where('pet_id',$pet_id )->get();
        return view('page.history_thue.history_thue')  -> with(compact('meta_decs','meta_keywords','meta_titel','url_canonical','order','pet_show'));
        }
    }

    public function view_history_order_thue(Request $request,$order_thue_code){
        if(!Session::get('customer_id')){
            return Redirect('dang-nhap')->with('error', ' vui lòng đăng nhập để vào lịch sữ mua hàng') ;
        }else{
            $meta_decs ="Lịch sữ đơn hàng ";
            $meta_keywords = "Lịch sữ đơn hàng";
            $meta_titel ="Lịch sữ đơn hàng";
            $url_canonical = $request->url();

        $order_details = OrderThue::with('petproduct')->get();
        $order = Order_thue::orderBy('created_at',"desc")->get();
        $pet = PetProduct::orderBy('pet_id')->get();    

           foreach($order_details as $key => $der){
            $pet_id = $der->pet_id;
         }
         $pet_show = PetProduct::orderBy('pet_status')->where('pet_id',$pet_id )->get();
         //////

         $order_details = OrderThue::with('petproduct')->where('order_code_thue',$order_thue_code)->get();
        $order = Order_thue::where('order_thue_code',$order_thue_code)->get();
         $pet = PetProduct::orderBy('pet_id')->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_thue_id;
            $order_status = $ord->order_thue_status;
        }
           foreach($order_details as $key => $der){
            $pet_id = $der->pet_id;
        }

        $pet_show = PetProduct::orderBy('pet_status')->where('pet_id',$pet_id )->get();
        $customer = Customer::where('customer_id',$customer_id)->first();
        $combo_dele = CombDetails::where('order_code_combo',$order_thue_code)->get();
        $shipping = Shipping_thue::where('shipping_thue_id',$shipping_id)->first();
        $order_details_product = OrderThue::with('petproduct')->where('order_code_thue', $order_thue_code)->get();

        foreach($order_details_product as $key => $order_d){
            $pet_coupon = $order_d->pet_coupon;
            
        }
        if($pet_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$pet_coupon)->first();
            $coupon_condition = $coupon-> coupon_condition;
            $coupon_number = $coupon-> coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        return view('page.history_thue.view_history_thue')-> with('meta_decs',$meta_decs) -> with('meta_keywords',$meta_keywords)-> with('meta_titel',$meta_titel)-> with('url_canonical',$url_canonical) -> with('order',$order)->with('pet_show',$pet_show)
        ->with('order_details',$order_details)
        ->with('customer',$customer)
        ->with('shipping',$shipping)
        ->with('order_details_product',$order_details_product)
        
        ->with('coupon_condition',$coupon_condition)
        ->with('coupon_number',$coupon_number)
        ->with('combo_dele',$combo_dele);  
        }
    }
    
}
