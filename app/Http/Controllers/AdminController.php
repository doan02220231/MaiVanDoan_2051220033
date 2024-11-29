<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Satistic;
use App\Models\Visitors;
use App\Models\Post;
use App\Models\Order;
use Carbon\Carbon;
session_start();
class AdminController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(Request $request){
        $this ->Authlogin();
        $use_ip_address = $request->ip();

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString(); 
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();  
        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //total tháng trươc
        $visitors_of_lastmonth = Visitors::whereBetween('date_visitors', [$early_last_month, $end_of_last_month])->get();
        $visitors_last_month_count = $visitors_of_lastmonth ->count();
        //total tháng này
        $visitors_of_thismonth = Visitors::whereBetween('date_visitors', [$early_this_month, $now])->get();
        $visitors_this_month_count = $visitors_of_thismonth ->count();
         //total trong 1 năm
         $visitors_of_year = Visitors::whereBetween('date_visitors', [$oneyears, $now])->get();
        $visitors_year_count = $visitors_of_year ->count();
        //carrent online
        $visitors_curret = Visitors::where('ip_address', $use_ip_address)->get();
        $visitors_count = $visitors_curret->count();
        if($visitors_count<1){
            $visitor = new Visitors();
            $visitor -> ip_address = $use_ip_address;
            $visitor -> date_visitors = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor ->save();
        }
        //tất cả
        $visitors = Visitors::all();
        $visitors_total = $visitors ->count();

        //total donut
        $product = Product::all()->count();
        $post = Post::all()->count();
        $orders = Order::all()->count();
        $customer = Customer::all()->count();
        $product_views = Product::orderBy('product_views','DESC')->take(10)->get();
        $post_views = Post::orderBy('post_views','DESC')->take(10)->get();
        return view('admin.dashboard')->with(compact('visitors_count','visitors_last_month_count',
        'visitors_this_month_count','visitors_year_count','visitors_total','product','post','orders','customer','post_views','product_views'));
    }
    public function dashboard(Request $request){
        $admin_email = $request ->admin_email;
        $admin_password = md5($request ->admin_password);

        $request = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($request){
            Session::put('admin_name',$request->admin_name);
            Session::put('admin_id',$request->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message','Bạn nhâp mật khẩu hoặc email sai vui lòng nhập lại !!!');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
    public function filter_by_date(Request $request){
        $data = $request -> all();
        $form_data = $data['form_data'];
        $to_data = $data['to_data'];
        $get = Satistic::whereBetween('order_date',[$form_data, $to_data])->orderBy('order_date','ASC')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val -> order_date,
                'order' => $val -> total_order,
                'sales' => $val -> sales,
                'profit' => $val -> profit,
                'quantity' => $val -> quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function dashboard_filter(Request $request){
        $data = $request ->all();  
        // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');    
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['dashboard_value'] == '7ngay'){
            $get = Satistic::whereBetween('order_date',[$sub7ngay ,$now])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = Satistic::whereBetween('order_date',[$dau_thangtruoc ,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }
        elseif($data['dashboard_value'] == 'thangnay'){
            $get = Satistic::whereBetween('order_date',[$dauthangnay ,$now])->orderBy('order_date','ASC')->get();
        }else{
            $get = Satistic::whereBetween('order_date',[$sub365ngay ,$now])->orderBy('order_date','ASC')->get();
        }
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val -> order_date,
                'order' => $val -> total_order,
                'sales' => $val -> sales,
                'profit' => $val -> profit,
                'quantity' => $val -> quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function days_order(Request $request){
        $sub30ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Satistic::whereBetween('order_date',[$sub30ngay ,$now])->orderBy('order_date','ASC')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val -> order_date,
                'order' => $val -> total_order,
                'sales' => $val -> sales,
                'profit' => $val -> profit,
                'quantity' => $val -> quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    //login_customer_google
    // public function login_customer_google(Request $request){
    //     return
    // }
}
