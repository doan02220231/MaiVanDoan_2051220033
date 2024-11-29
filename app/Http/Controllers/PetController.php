<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use App\models\Coupon;
use Carbon\Carbon;
use App\models\PetGallery;
use App\models\PetProduct;
use App\models\Combo;

use Illuminate\Support\Facades\Redirect;
session_start(); 
class PetController extends Controller
{
////////////////////combo

            public function edit_combo($combo_id)
        {
               
            $edit_com = DB::table('tbl_pet_combo')->where('combo_id',$combo_id)->get();
        // Render the admin layout with the form view included
              
            return view('admin.combo.edit_combo')->with('edit_com', $edit_com);

        }

        public function update_combo(Request $request,$combo_id){
       
        $data = array();
       $data = array();
        $data['combo_name'] = $request->combo_name; 
        $data['combo_gia'] = $request->combo_gia;
        $data['combo_content'] = $request->combo_content;
         $data['combo_status'] = $request->combo_status;

         $get_image = $request->file('combo_image');
   
    if($get_image){
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));

        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move(public_path('uploads/product'), $new_image);  // Make sure directory exists
        $data['combo_image'] = $new_image;

        // Insert product data
        DB::table('tbl_pet_combo')->update($data);

        // Success message
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('add-combo');
    }

    // In case no image is uploaded
    $data['combo_image'] = '';
    DB::table('tbl_pet_combo')->update($data);
    Session::put('message', 'Cập nhật sản phẩm thất bại');
    return Redirect::to('/add-combo');
    }


     public function del_combo($combo_id){
        DB::table('tbl_pet_combo')->where('combo_id',$combo_id)->delete();
        Session::put('message', 'Xoá pet thành công');
        return Redirect::to('all-combo');
    }
     public function unactive_combo($combo_id)
        {
           
            DB::table('tbl_pet_combo')
                ->where('combo_id', $combo_id)
                ->update(['combo_status' => 1]);

            Session::put('message', 'Không kích hoạt sản phẩm thành công');
            return Redirect::to('all-combo');
        }

    public function active_combo($combo_id)
    {
         DB::table('tbl_pet_combo')
            ->where('combo_id', $combo_id)
            ->update(['combo_status' => 0]);

        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-combo');
    }
      public function all_combo(){
       
        $all_combo = DB::table('tbl_pet_combo') ->orderby('combo_id','desc')->get();;
        $manage_combo = view('admin.combo.all_combo')->with('all_combo' ,$all_combo);

        return view('admin_layout')->with('admin.combo.all_combo' ,$manage_combo) ;
    }
    public function save_combo(Request $request){
    $data = array();
    $data['combo_name'] = $request->combo_name; 
    $data['combo_gia'] = $request->combo_gia;
    $data['combo_content'] = $request->combo_content;
     $data['combo_status'] = $request->combo_status;

    // File upload
    $get_image = $request->file('combo_image');
   
    if($get_image){
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));

        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move(public_path('uploads/product'), $new_image);  // Make sure directory exists
        $data['combo_image'] = $new_image;

        // Insert product data
        DB::table('tbl_pet_combo')->insert($data);

        // Success message
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add-combo');
    }

    // In case no image is uploaded
    $data['combo_image'] = '';
    DB::table('tbl_pet_combo')->insert($data);
    Session::put('message', 'Thêm sản phẩm thất bại');
    return Redirect::to('/add-combo');
    }
    public function add_combo(){
        
    $combo = DB::table('tbl_pet_combo')->orderby('combo_id','desc')->get();
    // Render the admin layout with the form view included
    return view('admin.combo.add_combo')->with('combo', $combo);
    }
//////////////////////// combo
// In your quickview method
        public function quickview(Request $request){
           $pet_id = $request->pet_id;
           $pet = PetProduct::find($pet_id);  
           $gallery = PetGallery::where('pet_id', $pet_id)->get();   

           $output['product_gallery'] = '';
           foreach($gallery as $key => $gal){
               $output['product_gallery'] .= '<p><img width="100%" src="public/uploads/gallery/'.$gal->gallery_pet_image.'"></p>';
           }

           $output['pet_name'] = $pet->pet_name;
           $output['pet_id'] = $pet->pet_id;
           $output['pet_slug'] = $pet->pet_slug;
           $output['pet_type'] = $pet->pet_type;
           $output['pet_age'] = $pet->pet_age;
           $output['pet_gender'] = $pet->pet_gender;
           $output['pet_desc'] = $pet->pet_desc;
           $output['pet_content'] = $pet->pet_content;
           $output['rental_price_per_day'] = number_format($pet->rental_price_per_day, 0, ',', '.').' VNĐ';

           $output['product_image'] = '<p><img width="100%" src="public/uploads/product/'.$pet->pet_image.'"></p>';
           
           echo json_encode($output);
        }


    public function add_pet(){
        
    $pets = DB::table('tbl_pet')->orderby('pet_id','desc')->get();
    // Render the admin layout with the form view included
    return view('admin.thue_pet.add_pet')->with('pets', $pets);
    }


   public function all_pet(){
       
        $all_pet = DB::table('tbl_pet') ->orderby('pet_id','desc')->get();;
        $manage_product = view('admin.thue_pet.all_pet')->with('all_pet' ,$all_pet);

        return view('admin_layout')->with('admin.thue_pet.all_pet' ,$manage_product) ;
    }
    public function save_pet(Request $request){
   
    $data = array();
    $data['pet_name'] = $request->pet_name;
    $data['pet_slug'] = $request->pet_slug;
    $data['pet_type'] = $request->pet_type;
    $data['pet_gender'] = $request->pet_gender;
    $data['pet_age'] = $request->pet_age;
    $data['rental_price_per_day'] = $request->rental_price_per_day;
    $data['pet_desc'] = $request->pet_desc;
    $data['pet_content'] = $request->pet_content;
    $data['pet_status'] = $request->pet_status;
    
    // File upload
    $get_image = $request->file('pet_image');
   
    if($get_image){
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));

        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move(public_path('uploads/product'), $new_image);  // Make sure directory exists
        $data['pet_image'] = $new_image;

        // Insert product data
        DB::table('tbl_pet')->insert($data);

        // Success message
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add-pet');
    }

    // In case no image is uploaded
    $data['pet_image'] = '';
    DB::table('tbl_pet')->insert($data);
    Session::put('message', 'Thêm sản phẩm thất bại');
    return Redirect::to('/add-pet');
    }
    public function unactive_pet($pet_id)
        {
           
            DB::table('tbl_pet')
                ->where('pet_id', $pet_id)
                ->update(['pet_status' => 1]);

            Session::put('message', 'Không kích hoạt sản phẩm thành công');
            return Redirect::to('all-pet');
        }

    public function active_pet($pet_id)
    {
         DB::table('tbl_pet')
            ->where('pet_id', $pet_id)
            ->update(['pet_status' => 0]);

        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-pet');
    }

        public function edit_pet($pet_id)
        {
               
            $edit_pet = DB::table('tbl_pet')->where('pet_id',$pet_id)->get();
        // Render the admin layout with the form view included
              
            return view('admin.thue_pet.edit_pet')->with('edit_pet', $edit_pet);

        }

        public function update_pet(Request $request,$pet_id){
       
        $data = array();
        $data['pet_name'] = $request->pet_name;
        $data['pet_slug'] = $request->pet_slug;
        $data['pet_type'] = $request->pet_type;
        $data['pet_gender'] = $request->pet_gender;
        $data['pet_age'] = $request->pet_age;
        $data['rental_price_per_day'] = $request->rental_price_per_day;
        $data['pet_desc'] = $request->pet_desc;
        $data['pet_content'] = $request->pet_content;
        $data['pet_status'] = $request->pet_status;

        $get_image = $request->file('pet_image');
   
     if($get_image){
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));

        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move(public_path('uploads/product'), $new_image);  // Make sure directory exists
        $data['pet_image'] = $new_image;

        // Insert product data
        DB::table('tbl_pet')->where('pet_id',$pet_id)->update($data);

        // Success message
        Session::put('message', 'Cập nhật pet thành công');
        return Redirect::to('all-pet');
    }

    // In case no image is uploaded
    DB::table('tbl_pet')->where('pet_id',$pet_id)->update($data);
    Session::put('message', 'Cập nhật pet thành công');
    return Redirect::to('/all-pet');
    }

     public function delete_pet($pet_id){
        DB::table('tbl_pet')->where('pet_id',$pet_id)->delete();
        Session::put('message', 'Xoá pet thành công');
        return Redirect::to('all-pet');
    }
    /////

        public function show_product_thue(Request $request ){
        

        $meta_desc = "Website kinh doanh phụ kiện thú cưng Petshop ";
        $meta_keywords = "";
        $meta_title = "Website kinh doanh phụ kiện thú cưng Petshop ";
        $url_canonical = $request->url();
          $all_product_combo = DB::table('tbl_pet_combo')->where('combo_status','0')->orderby(DB::raw('RAND()'))->paginate(8);
        

        $all_product_thue = DB::table('tbl_pet')->where('pet_status','0')->orderby(DB::raw('RAND()'))->paginate(8);
        return view('page.product_thue.show_product_thue')->with('all_product_thue' ,$all_product_thue)->with('all_product_combo' ,$all_product_combo);

    }


        public function show_details_thue(Request $request, $pet_id){
        

        $meta_desc = "Website kinh doanh phụ kiện thú cưng Petshop ";
        $meta_keywords = "";
        $meta_title = "Website kinh doanh phụ kiện thú cưng Petshop ";
        $url_canonical = $request->url();

        $details_thue = DB::table('tbl_pet')->where('tbl_pet.pet_id', $pet_id)->get();

        $gallery_pet= PetGallery::where('pet_id' ,$pet_id)->get();
        return view('page.product_thue.show_details_thue')->with('details_thue' ,$details_thue)->with('gallery_pet' ,$gallery_pet);

    }

//     public function quickview(Request $request){
//         $pet_id = $request->pet_id();
//         $pet_id = PetProduct::find($pet_id);
// //// video 143
//         $output['pet_name'] = $product -> pet_name;
//         $output['pet_id'] = $pet -> pet_id;
//         $output['pet_type'] = $product -> pet_type;
//         $output['pet_gender'] = $product -> pet_gender;
//         $output['pet_content'] = $product -> pet_content;
//         $output['pet_desc'] = $product -> pet_desc;
//         $output['rental_price_per_day'] = number_format($product -> rental_price_per_day,0,',','.').'VNĐ';
//         $output['product_image'] ='<p><img width="100%" src="public/uploads/product/'.$product->product_image.'"></p>';
//     }

  

    public function check_coupon_thue(Request $request)
        {
              $data = $request -> all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        if(Session::get('customer_id')){
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)
            ->where('coupon_date_end','>=',$today)->where('coupon_times','!=',0)->where('coupon_used','LIKE','%'.Session::get('customer_id').'%') -> first();
            if($coupon){
                return redirect()->back()->with('error','Mã giảm giá đã sử dụng,vui lòng nhập mã khác');
            }else{
                $coupon_login = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today) -> first();
                if($coupon_login){
                    $count_coupon = $coupon_login->count();
                    if($count_coupon > 0){
                        $coupon_session = Session::get('coupon');
                        if($coupon_session == true){
                            $id_avaiable = 0;
                            if($id_avaiable == 0){
                                $cou[] = array(
                                    'coupon_code' => $coupon_login->coupon_code,
                                    'coupon_condition' => $coupon_login->coupon_condition,
                                    'coupon_number' => $coupon_login->coupon_number,
                                );
                                Session::put('coupon',$cou);
                            }
                        }else{
                            $cou[] = array(
                                'coupon_code' => $coupon_login->coupon_code,
                                'coupon_condition' => $coupon_login->coupon_condition,
                                'coupon_number' => $coupon_login->coupon_number,
                            );
                            Session::put('coupon',$cou);
                        }
                        Session::save();
                        return redirect()->back()->with('message','Thêm mã giảm giá thành công');
                    }
                }else{
                    return redirect()->back()->with('error','Nhập mã giảm giá không đúng - đã hết hạn - hoặc mã đã hết ');
                }
            }
        //nếu chưa đăng nhập
        }else{
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_times','!=',0)->where('coupon_status',1)->where('coupon_date_end','>=',$today) -> first();
            if($coupon){
                $count_coupon = $coupon->count();
                if($count_coupon > 0){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session == true){
                        $id_avaiable = 0;
                        if($id_avaiable == 0){
                            $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,
                            );
                            Session::put('coupon',$cou);
                        }
                    }else{
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                    }
                    Session::save();
                    return redirect()->back()->with('message','Thêm mã giảm giá thành công');
                }
            }else{
                return redirect()->back()->with('error','Nhập mã giảm giá không đúng - đã hết hạn - hoặc mã đã hết ');
            }
        }

        }
        
}
