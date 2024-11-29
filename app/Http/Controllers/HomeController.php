<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Product;
use App\Models\CategoryProductModel;
class HomeController extends Controller
{
    public function index(Request $request){
        //category post
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        // $category_post = DB::table('tbl_category_post')-> where('category_post_status','0')->orderBy('category_post_id','desc')->get();
        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();
        //endslider

        //Seo
            $meta_decs ="PetSop,Shop phụ kiện thú cưng hàng đầu Việt Nam ";
            $meta_keywords = "PetShop nhiều loại sản phẩm dành cho thú cưng";
            $meta_titel ="PetShop nhiều loại sản phẩm dành cho thú cưng";
            $url_canonical = $request->url();
        //EndSeo

        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
        $category_pro_tabs = CategoryProductModel::where('category_parent','<>',0)->orderBy('category_id','ASC')->get();
        // $all_product = DB::table('tbl_product') 
        // -> join('tbl_caregory_product','tbl_caregory_product.category_id','=','tbl_product.category_id')limit(2)
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderBy('tbl_product.product_id','desc')->get();
        $all_product = DB::table('tbl_product')-> where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(8);
        return view('page.home') -> with('category',$cate_product) -> with('brand',$brand_product)-> with('all_product',$all_product)
        -> with('meta_decs',$meta_decs)
        -> with('meta_keywords',$meta_keywords)
        -> with('meta_titel',$meta_titel)
        -> with('url_canonical',$url_canonical)
        -> with('slider',$slider)
        -> with('category_post',$category_post)
        -> with('category_pro_tabs',$category_pro_tabs)
        ;

        // return view('page.home') -> with(compact('cate_product','brand_product','all_product')) ;
        
    }
    public function search(Request $request){
        //category_post
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();
        //Seo
        $meta_decs ="PetSop,Shop phụ kiện thú cưng hàng đầu Việt Nam ";
        $meta_keywords = "PetShop nhiều loại sản phẩm dành cho thú cưng";
        $meta_titel ="PetShop nhiều loại sản phẩm dành cho thú cưng";
        $url_canonical = $request->url();
        //EndSeo
        $keywords = $request -> keywords_submit;
        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product') 
        // -> join('tbl_caregory_product','tbl_caregory_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderBy('tbl_product.product_id','desc')->get();
         $search_product = DB::table('tbl_product')-> where('product_name','like','%'.$keywords.'%')->paginate(8);
        return view('page.productSP.search') -> with('category',$cate_product) -> with('brand',$brand_product) 
        -> with('search_product',$search_product)
        -> with('meta_decs',$meta_decs)
        -> with('meta_keywords',$meta_keywords)
        -> with('meta_titel',$meta_titel)
        -> with('url_canonical',$url_canonical)
        -> with('slider',$slider)
        -> with('category_post',$category_post);
    }
    public function autocomplete_ajax(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = Product::where('product_status',0)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display: block;position: relative;">';
            foreach($product as $key => $val){
                $output .= '
                    <li class="li_serach_ajax"><a href="#">'.$val->product_name.'</a></li>
                ' ;
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
