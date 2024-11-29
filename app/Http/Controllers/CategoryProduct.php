<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CategoryProductModel;
use App\Models\CatePost;
use App\Models\Product;
session_start();
class CategoryProduct extends Controller
{
    //function admin page
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function add_category_product(){
        $this -> Authlogin();
        $category = CategoryProductModel::where('category_parent',0)->orderBy('category_id',"DESC")->get();
        return view('admin.category.add_category_product')->with(compact('category'));
    }
    public function all_category_product(){
        $this -> Authlogin();
        $category_product = CategoryProductModel::where('category_parent',0)->orderBy('category_id',"DESC")->get();
        $all_category_product = DB::table('tbl_caregory_product')->orderBy('category_parent',"DESC")->paginate(5);
        $manager_category_product = view('admin.category.all_category_product')->with('all_category_product',$all_category_product)
        ->with('category_product',$category_product);
        return view('admin_layout')->with('admin.category.all_category_product',$manager_category_product);
        
    }
    public function save_category_product(Request $request){
        $this -> Authlogin();
        $data = array();
        $data['category_name'] = $request ->category_product_name;
        $data['category_parent'] = $request ->category_product_parent;
        $data['meta_keywords'] = $request ->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_desc'] = $request ->category_product_desc;
        $data['category_status'] = $request ->category_product_status;
        $result = CategoryProductModel::where('slug_category_product', $data['slug_category_product'])->first();
        if($result){
           
            return Redirect()->back()->with('message','Tên danh mục đã tồn tại vui lòng nhập lại !!!');
           
        }else{
            DB::table('tbl_caregory_product')->insert($data);
            Session::put('message','Thêm danh mục sản phẩm thành công');
            return Redirect::to('add-category-product');
        }
        

        
    }
    public function unactive_category_product($category_product_id){
        $this -> Authlogin();
        DB::table('tbl_caregory_product') -> where('category_id',$category_product_id) -> update(['category_status'=>1]); 
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        $this -> Authlogin();
        DB::table('tbl_caregory_product') -> where('category_id',$category_product_id) -> update(['category_status'=>0]); 
        Session::put('message','Hiển thị sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this -> Authlogin();
        $category = CategoryProductModel::orderBy('category_id',"DESC")->get();
        $edit_category_product = DB::table('tbl_caregory_product')->where('category_id',$category_product_id) -> get();
        $manager_category_product = view('admin.category.edit_category_product')
        ->with('edit_category_product',$edit_category_product)
        ->with('category',$category);
        return view('admin_layout')->with('admin.category.edit_category_product',$manager_category_product);
    }
    public function delete_category_product($category_product_id){
        $this -> Authlogin();
        DB::table('tbl_caregory_product')->where('category_id',$category_product_id) -> delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function update_category_product(Request $request,$category_product_id){
        $this -> Authlogin();
        $data = array();
        $data['category_name'] = $request ->category_product_name;
        $data['category_parent'] = $request ->category_product_parent;
        $data['meta_keywords'] = $request ->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_desc'] = $request ->category_product_desc;
        $result = CategoryProductModel::where('slug_category_product', $data['slug_category_product'])->first();
        if($result){
           
            return Redirect()->back()->with('message','Tên danh mục đã tồn tại vui lòng nhập lại !!!');
           
        }else{
            DB::table('tbl_caregory_product')->where('category_id',$category_product_id) -> update($data);
            Session::put('message','Cập nhật danh mục sản phẩm thành công');
            return Redirect::to('all-category-product');
        }
       
    }
    //end function admin page

    public function show_category_home($slug_category_product,Request $request){
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
        $category_by_slug = CategoryProductModel::where('slug_category_product',$slug_category_product)->get();
        //Sắp xếp ký tự,giá
        $price_min = Product::min('product_price');
        $price_max = Product::max('product_price');
        foreach ($category_by_slug as $key => $cate) {
            $category_id = $cate->category_id;
        }
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by == 'giam_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','desc')->paginate(8)->appends(request()->query());
            }elseif($sort_by == 'tang_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','asc')->paginate(8)->appends(request()->query());
            }elseif($sort_by == 'kytu_za'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','desc')->paginate(8)->appends(request()->query());
            }elseif($sort_by == 'kytu_az'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','asc')->paginate(8)->appends(request()->query());
            }
        }elseif(isset($_GET['start_price'] )&& $_GET['end_price']){
            $min_price =$_GET['start_price'];
            $max_price =$_GET['end_price'];
            $category_by_id = Product::with('category')->whereBetween('product_price',[$min_price,$max_price])->orderBy('product_price','asc')->paginate(8)->appends(request()->query());
        }else{
            $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_id','desc')->paginate(8);
        }
        
        // $category_by_id = DB::table('tbl_product') 
        // -> join('tbl_caregory_product','tbl_product.category_id','=','tbl_caregory_product.category_id')
        // -> where('tbl_caregory_product.slug_category_product',$slug_category_product)->get();
        $category_name = DB::table('tbl_caregory_product')
        ->where('tbl_caregory_product.slug_category_product',$slug_category_product)->limit(1)->get();
        foreach($category_name as $key => $val){
            
            //Seo
            $meta_decs = $val-> category_desc;
            $meta_keywords =$val->meta_keywords;
            $meta_titel = $val -> category_name;
            $url_canonical = $request->url();
            //EndSeo
        }
        $category_name = DB::table('tbl_caregory_product') -> where('tbl_caregory_product.slug_category_product',$slug_category_product) -> limit(1)->get();
       
        return view('page.category.show_category') 
        -> with('category',$cate_product) 
        -> with('brand',$brand_product)
        -> with('category_by_id',$category_by_id)
        -> with('category_name',$category_name)
        -> with('meta_decs',$meta_decs)
        -> with('meta_keywords',$meta_keywords)
        -> with('meta_titel',$meta_titel)
        -> with('url_canonical',$url_canonical)
        -> with('category_post',$category_post)
        -> with('price_min',$price_min)
        -> with('price_max',$price_max);
    }

    //product tabs
    public function product_tabs(Request $request){
        $data = $request->all();
        $output = '';
        $product = Product::where('category_id',$data['cate_id'])->orderBy('product_id','DESC')->limit(4)->get();
        $product_count = $product->count();
        if($product_count > 0){
            $output .= '
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tshirt" >
                ';
                foreach ($product as $key => $val) {
                    $output .= ' 
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="'.url('public/uploads/product/'.$val->product_image).'" alt="'.$val->product_name.'" />
                                        <h2>'.number_format( $val->product_price,0,',','.').' VNĐ</h2>
                                        <p>'. $val->product_name.'</p>
                                        <a href="'.url('/chi-tiet-san-pham/'.$val->product_slug).'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>';
                }
                $output .= ' </div> </div>';
                
        }else{
            $output .= '
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tshirt" >
                    <div class="col-sm-12">
                        <p style = "color:red;text-align:center">Hiện chưa có sản phẩm trong danh mục này</p>
                    </div>
                </div>
    
            </div>';
        }
        echo $output;
    }
    
}
