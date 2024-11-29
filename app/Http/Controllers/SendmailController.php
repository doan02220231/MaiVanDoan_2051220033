<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Customer;
use App\Models\Coupon;
class SendmailController extends Controller
{
    // public function send_mail(){
    //     $to_name = "PetShop";
    //     $to_email = "maivandoan12@gmail.com";//send to this email
    //     $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
    //     Mail::send('page.mail.send_mail',$data,function($message) use ($to_name,$to_email){
    //         $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
    //         $message->from($to_email,$to_name);//send from this mail
    //     });
    // //    return redirect('/')->with('messege','');
    // }
    public function send_coupon_vip($coupon_code){
        $custumer_vip = Customer::where('customer_vip',1)->get();
        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        $coupon_name = $coupon->coupon_name;
        $start_coupon = $coupon->coupon_date_start;
        $end_coupon = $coupon->coupon_date_end;
        $coupon_time= $coupon->coupon_times;
        $coupon_condition=$coupon->coupon_condition;
        $coupon_number=$coupon->coupon_number;
        
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi".' '.$now;
        $data = [];
        foreach($custumer_vip as $vip){
            $data['email'][]= $vip -> customer_email;
        }
        $coupon = array(
            'coupon_name' =>$coupon_name,
            'start_coupon' =>$start_coupon,
            'end_coupon' =>$end_coupon,
            'coupon_time'=>$coupon_time,
            'coupon_condition'=>$coupon_condition,
            'coupon_number'=>$coupon_number,
            'coupon_code'=>$coupon_code
        );
        // dd($data);
        Mail::send('page.mail.send_coupon_vip',['coupon'=>$coupon ],function($message) use($title_mail,$data){
            $message->to($data['email'])->subject( $title_mail);
            $message->from($data['email'],$title_mail);

        });
        return Redirect::back()->with('message','Gửi mã khuyến mãi khách vip thành công');
    }
    public function send_coupon($coupon_code){
        $custumer_vip = Customer::where('customer_vip','!=',1)->get();
        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        $coupon_name = $coupon->coupon_name;
        $start_coupon = $coupon->coupon_date_start;
        $end_coupon = $coupon->coupon_date_end;
        $coupon_time= $coupon->coupon_times;
        $coupon_condition=$coupon->coupon_condition;
        $coupon_number=$coupon->coupon_number;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi".' '.$now;
        $data = [];
        foreach($custumer_vip as $vip){
            $data['email'][]= $vip -> customer_email;
        }
        $coupon = array(
            'coupon_name' =>$coupon_name,
            'start_coupon' =>$start_coupon,
            'end_coupon' =>$end_coupon,
            'coupon_time'=>$coupon_time,
            'coupon_condition'=>$coupon_condition,
            'coupon_number'=>$coupon_number,
            'coupon_code'=>$coupon_code
        );
        // dd($data);
        Mail::send('page.mail.send_coupon',['coupon'=>$coupon ],function($message) use($title_mail,$data){
            $message->to($data['email'])->subject( $title_mail);
            $message->from($data['email'],$title_mail);

        });
        return Redirect::back()->with('message','Gửi mã khuyến mãi khách thành công');
    }
    public function mail_exemple(){
        return view('page.mail.send_coupon');
    }
    //Quen mật khẩu checkout
    public function quen_mat_khau(Request $request){
        //category post
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        // $category_post = DB::table('tbl_category_post')-> where('category_post_status','0')->orderBy('category_post_id','desc')->get();
        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();
        //endslider

        // //Seo
        //     $meta_decs ="PetShop, shop bán sỉ, lẻ son môi, mỹ phẩm chính hãng 100%. Tư vấn chọn mua son môi, mỹ phẩm 24/7. Giao hàng COD Toàn Quốc.";
        //     $meta_keywords = "Các loại mỹ phẩm chính hãng 100%";
        //     $meta_titel ="PetShop-Shop bán mỹ phẩm chính hảng";
        //     $url_canonical = $request->url();
        // //EndSeo

        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product') 
        // -> join('tbl_caregory_product','tbl_caregory_product.category_id','=','tbl_product.category_id')limit(2)
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderBy('tbl_product.product_id','desc')->get();
        $all_product = DB::table('tbl_product')-> where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(8);
        return view('page.checkout.forget_pass') -> with('category',$cate_product) -> with('brand',$brand_product)-> with('all_product',$all_product)
        
        -> with('slider',$slider)
        -> with('category_post',$category_post)
        ;
       
    }
    //gửi pass mới qua mail
    public function revover_pass(Request $request){
        $data = $request->all();   
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y ');
        $title_mail = "lấy lại mật khẩu PetShop.com".' '.$now;
        $customer = Customer::where('customer_email','=',$data['email_accout'])->get();
        foreach($customer as $key => $value){
            $customer_id = $value -> customer_id;
        }
        if($customer){
            $count_customer = $customer->count();
            if($count_customer == 0){
                return Redirect::back()->with('error','Email chưa được đăng ký để khôi phục mật khẩu');
            }else{
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer ->customer_token =  $token_random;
                $customer->save();

                //send mail
                $to_email = $data['email_accout'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail,'body'=>$link_reset_pass,'email'=>$data['email_accout']);
                Mail::send('page.checkout.forget_pass_notify',['data'=> $data],function($message) use($title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });
                return Redirect::back()->with('message','Gửi mail thành công,vui lòng vào email để reset password');
            }
        }
    }
    public function reset_new_pass(Request $request){
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
        $count = $customer->count();
        if($count > 0){
            foreach($customer as $key => $cus){$customer_id = $cus -> customer_id;}
            $reset = Customer::find($customer_id);
            $reset -> customer_password = md5($data['password_accout']);
            $reset -> customer_token = $token_random;
            $reset -> save();
            return Redirect('login-checkout')->with('message','Mật khẩu đã cập nhật mới,vui lòng đăng nhập lại');
        }else{
            return Redirect('quen-mat-khau')->with('error','Vui lòng nhập lại email vì link quá hạn');
        }

    }
    public function update_new_pass(){
         //category post
         $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
         // $category_post = DB::table('tbl_category_post')-> where('category_post_status','0')->orderBy('category_post_id','desc')->get();
         //slider
         $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();
         //endslider
 
         // //Seo
         //     $meta_decs ="PetShop, shop bán sỉ, lẻ son môi, mỹ phẩm chính hãng 100%. Tư vấn chọn mua son môi, mỹ phẩm 24/7. Giao hàng COD Toàn Quốc.";
         //     $meta_keywords = "Các loại mỹ phẩm chính hãng 100%";
         //     $meta_titel ="PetShop-Shop bán mỹ phẩm chính hảng";
         //     $url_canonical = $request->url();
         // //EndSeo
 
         $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
         $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
 
         // $all_product = DB::table('tbl_product') 
         // -> join('tbl_caregory_product','tbl_caregory_product.category_id','=','tbl_product.category_id')limit(2)
         // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
         // ->orderBy('tbl_product.product_id','desc')->get();
         $all_product = DB::table('tbl_product')-> where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(8);
         return view('page.checkout.new_pas') -> with('category',$cate_product) -> with('brand',$brand_product)-> with('all_product',$all_product)
         
         -> with('slider',$slider)
         -> with('category_post',$category_post)
         ;
        
    }


}
