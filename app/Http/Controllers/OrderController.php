<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
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
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Satistic;
use App\Models\Brand;
use App\Models\Slider;
use Carbon\Carbon;

use PDF;

use function Laravel\Prompts\table;

session_start();
class OrderController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function update_qty(Request $request){
        $this ->Authlogin();
        $data = $request->all();
        $order_detail = OrderDetails::where('product_id',$data['order_prodcut_id'])->where('order_code',$data['order_code'])->first();
        $order_detail -> product_sales_quantity = $data['order_qty'];
        $order_detail->save();
    }
    public function update_order_qty(Request $request){
        $this ->Authlogin();
        //update_order
        $data = $request->all();
        // $order_id = $data['order_id'];
        // $order = Order::where('order_id',$order_id)->first();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        //order date
        $order_date = $order -> order_date;
        $statictis = Satistic::where('order_date',$order_date)->get();
        if($statictis){
            $statictis_count = $statictis -> count();
        }
        else{
            $statictis_count = 0;
        }
        if($order->order_status == 2  ){
            $total_order = 0;
            $sales = 0;
            $profit= 0;
            $quantity = 0;
            foreach($data['order_prodcut_id'] as $key => $product_id){ 
                $product = Product::find($product_id);
                $product_quantity = $product ->product_quantity;
                $product_sold = $product -> product_sold;

                $product_price = $product -> product_price;
                $product_cost = $product -> price_cost;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                foreach($data['quantity'] as $key2 => $qty){ 
                    if($key == $key2){
                        $pro_remain = $product_quantity - $qty;
                        $product ->product_quantity = $pro_remain;
                        $product ->product_sold = $product_sold + $qty;
                        $product -> save();
                        //update doanh thu
                        $quantity += $qty;
                        $total_order +=1;
                        $sales += $product_price * $qty;
                        $profit = $sales - ($product_cost * $qty);
                    }
                }
            }
            //update doanh số db
            if($statictis_count>0){
                $statictis_update = Satistic::where('order_date',$order_date)->first();
                $statictis_update ->sales = $statictis_update ->sales + $sales;
                $statictis_update ->profit = $statictis_update ->profit + $profit;
                $statictis_update ->quantity = $statictis_update ->quantity + $quantity;
                $statictis_update ->total_order = $statictis_update ->total_order + $total_order;
                $statictis_update ->save();

            }else{
                $statictis_new = new Satistic();
                $statictis_new ->order_date = $order_date;
                $statictis_new ->sales = $sales;
                $statictis_new ->profit = $profit;
                $statictis_new ->quantity = $quantity;
                $statictis_new ->total_order = $total_order;
                $statictis_new -> save();
            }
        }
        elseif($order->order_status != 2 ){
            foreach($data['order_prodcut_id'] as $key => $product_id){ 
                $product = Product::find($product_id);
                $product_quantity = $product ->product_quantity;
                $product_sold = $product -> product_sold;
                foreach($data['quantity'] as $key2 => $qty){ 
                    if($key == $key2){
                        $pro_remain = $product_quantity + $qty;
                        $product ->product_quantity = $pro_remain;
                        $product ->product_sold = $product_sold - $qty;
                        $product -> save();
                    }
                }
            }
        }
    }
    public function print_order($checkout_code){
        $this ->Authlogin();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();

    }
    public function print_order_convert($checkout_code){
        $this ->Authlogin();
        $order_details = OrderDetails::where('order_code',$checkout_code)->get();
        $order = Order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            //$order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
        foreach($order_details_product as $key => $order_d){
            $product_coupon = $order_d->product_coupon;
            
        }
        if($product_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon-> coupon_condition;
            $coupon_number = $coupon-> coupon_number;
            if($coupon_condition==1){
                $coupon_echo = $coupon_number.'%';
            }elseif($coupon_condition==2){
                $coupon_echo = number_format($coupon_number,0,',','.').'VNĐ';
            }
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
            $coupon_echo = '0';
        }

        $output = '';
        $output .='<style>
        body{ font-family:DejaVu Sans; }
        .table-styling {
            border:1px solid #000;
        }
        .table-styling tr th{
            border:1px solid #000;
        }
        
        .table-styling tbody tr td{
            border:1px solid #000;
            
        }
        </style>
        <h2><center>Công ty TNHH một thành viên Wind</center></h2>
        <p>Thông tin người đặt:</p>
        <table class = "table-styling">
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>';
            
                $output .='
                    <tr>
                        <td>'.$customer->customer_name.'</td>
                        <td>'.$customer->customer_phone.'</td>
                        <td>'.$customer->customer_email.'</td>
                    </tr>';
            
        $output .=' </tbody>
                        </table>
                        
        <p>Địa chỉ người đặt:</p>
        <table class = "table-styling">
            <thead>
                <tr>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>';
            
                $output .='
                    <tr>
                        <td>'.$shipping->shipping_name.'</td>
                        <td>'.$shipping->shipping_address.'</td>
                        <td>'.$shipping->shipping_phone.'</td>
                        <td>'.$shipping->shipping_email.'</td>
                        <td>'.$shipping->shipping_nodes.'</td>
                    </tr>';
            
        $output .=' </tbody>
                        </table>
        <p>Đơn hàng:</p>
        <table class = "table-styling">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã giảm giá</th>
                    <th>Phí ship</th>
                    <th>Số lượng</th>
                    <th>Giá sản phẩm</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>';
            $total = 0;
            
            foreach($order_details_product as $key => $product){
                $subtotal = $product->product_price*$product->product_sales_quantity;
                $total += $subtotal;
                if($product->product_coupon!='no'){
                    $product_coupon = $product->product_coupon;
                }else{
                    $product_coupon = 'Không mã';
                }
                $output .='
                    <tr>
                        <td>'.$product->product_name.'</td>
                        <td>'.$product->product_coupon.'</td>
                        <td>'.number_format($product->product_feeshipp,0,',','.').'VNĐ'.'</td>
                        <td>'.$product->product_sales_quantity.'</td>
                        <td>'.number_format($product->product_price,0,',','.').'VNĐ'.'</td>
                        <td>'.number_format($subtotal,0,',','.').'VNĐ'.'</td>
                    </tr>';
            }
            if($coupon_condition == 1){
                $total_after_coupon = ($total * $coupon_number)/100;
                $total_coupon = $total - $total_after_coupon;
            }
            else{
                $total_after_coupon = $coupon_number;
                $total_coupon = $total - $coupon_number ;
            }
            $output .='<tr>
                            <td colspan= "2">    
                                <p>Tông tiền: '.number_format($total,0,',','.').'VNĐ'.'</p>
                                <p>Mã giảm:'.$coupon_echo.'</p>
                                <p>Tổng tiền giảm: -'.number_format($total_after_coupon,0,',','.').'VNĐ'.'</p>
                                <p>Phí Ship: +'.number_format($product->product_feeshipp,0,',','.').'VNĐ'.'</p>
                                <p>Thành tiền: '.number_format($total_coupon +$product->product_feeshipp,0,',','.').'VNĐ'.'</p>
                            </td>

                    </tr>';
        $output .=' </tbody>
                        </table>
        <p>Ký tên</p>
        <table >
            <thead>
                <tr>
                    <th width = "200px">Người lập phiếu</th>
                    <th width = "800px">Người nhận</th>
                    >
                </tr>
            </thead>
            <tbody>';
            
        $output .=' </tbody>
                        </table>';
        return $output;
    }
    public function view_order($order_code){
        $this ->Authlogin();
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->get();
        
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
        
        foreach($order_details_product as $key => $order_d){
            $product_coupon = $order_d->product_coupon;
            
        }
        if($product_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon-> coupon_condition;
            $coupon_number = $coupon-> coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        
        return view('admin.order.view_order') -> with(compact('order_details','customer','shipping','order_details_product',
        'coupon_condition','coupon_number','order','order_status','category_post'));
    }
    public function manage_order(){
        $this ->Authlogin();
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        $order = Order::orderBy('created_at',"desc")->get();
        return view('admin.order.manage_order') -> with(compact('order','category_post'));
    }
    public function history(Request $request){
        if(!Session::get('customer_id')){
            return Redirect('dang-nhap')->with('error', ' vui lòng đăng nhập để vào lịch sữ mua hàng') ;
        }else{
            //category post
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        // $category_post = DB::table('tbl_category_post')-> where('category_post_status','0')->orderBy('category_post_id','desc')->get();
        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();
        //endslider

        //Seo
            $meta_decs ="Lịch sữ đơn hàng ";
            $meta_keywords = "Lịch sữ đơn hàng";
            $meta_titel ="Lịch sữ đơn hàng";
            $url_canonical = $request->url();
        //EndSeo

        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
       $getorder = Order::where('customer_id', Session::get('customer_id'))->orderBy('created_at',"desc")->paginate(10);

        // $all_product = DB::table('tbl_product') 
        // -> join('tbl_caregory_product','tbl_caregory_product.category_id','=','tbl_product.category_id')limit(2)
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderBy('tbl_product.product_id','desc')->get();
       

        return view('page.history.history')->with('category',$cate_product)->with('brand',$brand_product)-> with('meta_decs',$meta_decs) -> with('meta_keywords',$meta_keywords)-> with('meta_titel',$meta_titel)-> with('url_canonical',$url_canonical)-> with('slider',$slider) -> with('category_post',$category_post)-> with('getorder',$getorder);
        }
    }
    public function view_history_order(Request $request, $order_code){
         if(!Session::get('customer_id')){
            return Redirect('dang-nhap')->with('error', ' vui lòng đăng nhập để vào lịch sữ mua hàng') ;
        }else{
            //category post
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
       $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();
      
        //Seo
            $meta_decs ="Lịch sữ đơn hàng ";
            $meta_keywords = "Lịch sữ đơn hàng";
            $meta_titel ="Lịch sữ đơn hàng";
            $url_canonical = $request->url();
        //EndSeo

        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
        //// xem lịch sữ 
       
        $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->get();
        
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
        
        foreach($order_details_product as $key => $order_d){
            $product_coupon = $order_d->product_coupon;
            
        }
        if($product_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon-> coupon_condition;
            $coupon_number = $coupon-> coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        return view('page.history.view_history_order')->with('category',$cate_product)->with('brand',$brand_product)-> with('meta_decs',$meta_decs) -> with('meta_keywords',$meta_keywords)-> with('meta_titel',$meta_titel)-> with('url_canonical',$url_canonical)-> with('slider',$slider) -> with('category_post',$category_post) -> with('order_details',$order_details)-> with('customer',$customer) -> with('shipping',$shipping)-> with('coupon_condition',$coupon_condition) -> with('coupon_number',$coupon_number) -> with('order',$order) -> with('order_status',$order_status) ;
        }
    }
}
