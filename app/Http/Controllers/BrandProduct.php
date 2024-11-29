<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\CatePost;
use App\Models\Brand;
session_start();
class BrandProduct extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function add_brand_product(){
        $this -> Authlogin();
        return view('admin.brand.add_brand_product');
    }
    public function all_brand_product(){
        $this -> Authlogin();
        $all_brand_product = DB::table('tbl_brand')->paginate(6);
        $manager_brand_product = view('admin.brand.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.brand.all_brand_product',$manager_brand_product);
        
    }
    public function save_brand_product(Request $request){
        $this -> Authlogin();
        $data = array();
        $data['brand_name'] = $request ->brand_product_name;
        $data['brand_desc'] = $request ->brand_product_desc;
        $data['brand_slug'] = $request->brand_slug;
        $data['brand_status'] = $request ->brand_product_status;
        $result = Brand::where('brand_slug', $data['brand_slug'])->first();
        if($result){
           
            return Redirect()->back()->with('message','Tên thương hiệu đã tồn tại vui lòng nhập lại !!!');
           
        }else{
            DB::table('tbl_brand')->insert($data);
            Session::put('message','Thêm thương hiệu sản phẩm thành công');
            return Redirect::to('add-brand-product');
        }
        

        
    }
    public function unactive_brand_product($brand_product_id){
        $this -> Authlogin();
        DB::table('tbl_brand') -> where('brand_id',$brand_product_id) -> update(['brand_status'=>1]); 
        Session::put('message','Ẩn thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this -> Authlogin();
        DB::table('tbl_brand') -> where('brand_id',$brand_product_id) -> update(['brand_status'=>0]); 
        Session::put('message','Hiển thị thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this -> Authlogin();
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id) -> get();
        $manager_brand_product = view('admin.brand.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.brand.edit_brand_product',$manager_brand_product);
    }
    public function delete_brand_product($brand_product_id){
        $this -> Authlogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id) -> delete();
        Session::put('message','Xóa thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this -> Authlogin();
        $data = array();
        $data['brand_name'] = $request ->brand_product_name;
        $data['brand_desc'] = $request ->brand_product_desc;
        $data['brand_slug'] = $request->brand_product_slug;
        $result = Brand::where('brand_slug', $data['brand_slug'])->first();
        if($result){
           
            return Redirect()->back()->with('message','Tên thương hiệu đã tồn tại vui lòng nhập lại !!!');
           
        }else{
            DB::table('tbl_brand')->where('brand_id',$brand_product_id) -> update($data);
            Session::put('message','Cập nhật thương hiệu thành công');
            return Redirect::to('all-brand-product');
        }
        
    }
    //end function admin page

    public function show_brand_home(Request $request,$brand_slug){
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->where('tbl_brand.brand_slug',$brand_slug)->get();
        
        $brand_name = DB::table('tbl_brand') -> where('tbl_brand.brand_slug',$brand_slug) -> limit(1)->get();
        foreach($brand_name as $key => $val){
            //Seo
            $meta_decs = $val-> brand_desc;
            $meta_keywords =$val->brand_desc;
            $meta_titel = $val -> brand_name;
            $url_canonical = $request->url();
            //EndSeo
        }
        return view('page.brand.show_brand') 
        -> with('category',$cate_product)
        -> with('brand',$brand_product)
        -> with('brand_by_id',$brand_by_id)
        -> with('brand_name',$brand_name)
        -> with('meta_decs',$meta_decs)
        -> with('meta_keywords',$meta_keywords)
        -> with('meta_titel',$meta_titel)
        -> with('url_canonical',$url_canonical)
        -> with('category_post',$category_post);
    }
}
