<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\CatePost;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\Rating;
use File;


session_start();
class ProductController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function add_product(){
        $this ->Authlogin();
        $cate_product = DB::table('tbl_caregory_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();

        return view('admin.product.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this ->Authlogin();
        $all_product = DB::table('tbl_product') 
        -> join('tbl_caregory_product','tbl_caregory_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderBy('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.product.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.product.all_product',$manager_product);
        
    }
    public function save_product(Request $request){
        $this ->Authlogin();
        $data = array();
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);
     

        $data['product_name'] = $request ->product_name;
        $data['product_tags'] = $request ->product_tags;
        $data['product_quantity'] = $request ->product_quantity;
        $data['product_sold'] = '0';
        $data['product_price'] = $product_price;
        $data['price_cost'] =$price_cost;
        $data['product_slug'] = $request->product_slug;
        $data['product_desc'] = $request ->product_desc;
        $data['product_content'] = $request ->product_content;
        $data['category_id'] = $request ->product_cate;
        $data['brand_id'] = $request ->product_brand;
        $data['product_status'] = $request ->product_status;
        
        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
        $get_image = $request ->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
            $get_image -> move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image'] = $new_image;
            
        }
        
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery =new Gallery();
        $gallery ->gallery_name = $new_image;
        $gallery ->gallery_image = $new_image;
        $gallery ->product_id = $pro_id;
        $gallery ->save();

        $get_image_gal = $request -> file('file');

        if($get_image_gal){
            foreach($get_image_gal as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image -> getClientOriginalExtension();
                $image -> move('public/uploads/gallery',$new_image);
                $gallery = new Gallery(); 
                $gallery -> gallery_name = $new_image ;
                $gallery -> gallery_image = $new_image ;
                $gallery -> product_id = $pro_id  ;
                $gallery -> save();
            
            }
        }
        
        
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');

        
    }
    public function delete_product(Request $request,$product_id){
        $this ->Authlogin();
        $gallery = Gallery::where('product_id',$product_id) -> get();
        foreach($gallery as $key => $image){
            $gallery_g_image = $image -> gallery_image;
            unlink('public/uploads/gallery/'.$gallery_g_image);
                
        }  
        $gallery = Gallery::where('product_id',$product_id) -> delete();
        
        $product_p = Product::find($product_id);
        $product_p_image = $product_p -> product_image;
        unlink('public/uploads/product/'.$product_p_image);
        $product_p -> delete();

        
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
        $this ->Authlogin();
        DB::table('tbl_product') -> where('product_id',$product_id) -> update(['product_status'=>1]); 
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this ->Authlogin();
        
        DB::table('tbl_product') -> where('product_id',$product_id) -> update(['product_status'=>0]); 
        Session::put('message','Hiển thị sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this ->Authlogin();
        $cate_product = DB::table('tbl_caregory_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id) -> get();
        $manager_product = view('admin.product.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.product.edit_product',$manager_product);
    }
    
    public function update_product(Request $request,$product_id){
        $this ->Authlogin();
        $data = array();
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);
        $data['product_name'] = $request ->product_name;
        $data['product_tags'] = $request ->product_tags;
        $data['product_quantity'] = $request ->product_quantity;
        $data['product_price'] = $product_price;
        $data['price_cost'] = $price_cost;
        $data['product_slug'] = $request->product_slug;
        $data['product_desc'] = $request ->product_desc;
        $data['product_content'] = $request ->product_content;
        $data['category_id'] = $request ->product_cate;
        $data['brand_id'] = $request ->product_brand;
        // $data['product_status'] = $request ->product_status;
        $get_image = $request ->file('product_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
            $get_image -> move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    // end admin page
    public function details_product(Request $request,$product_slug){
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        //Chi tiết sản phẩm
        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
        

        $details_product = DB::table('tbl_product') 
        -> join('tbl_caregory_product','tbl_caregory_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_slug',$product_slug)->get();
       
       
        //sản phẩm liên quan
        foreach( $details_product as $key => $value){
            $category_id = $value -> category_id;
            $product_id = $value -> product_id;
            $product_cate = $value -> category_name;
            $cate_slug = $value ->slug_category_product;
             //Seo
             $meta_decs = $value-> product_desc;
             $meta_keywords =$value->product_slug;
             $meta_titel = $value -> product_name;
             $url_canonical = $request->url();
             //EndSeo
        }
        //gallery
        $gallery = Gallery::where('product_id',$product_id)->get()  ;
        //đánh giá sao
        
        $related_product = DB::table('tbl_product') 
        -> join('tbl_caregory_product','tbl_caregory_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_caregory_product.category_id',$category_id)
        ->whereNotIn('tbl_product.product_slug',[$product_slug])->get();
        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);
        $product = Product::where('product_id',$product_id)->first();
        $product ->product_views = $product->product_views+1;
        $product ->save();
        return view('page.productSP.show_details')
        -> with('category',$cate_product) 
        -> with('brand',$brand_product)
        -> with('product_details',$details_product)
        -> with('relate',$related_product)
        -> with('meta_decs',$meta_decs)
        -> with('meta_keywords',$meta_keywords)
        -> with('meta_titel',$meta_titel)
        -> with('url_canonical',$url_canonical)
        -> with('category_post',$category_post)
        -> with('gallery',$gallery)
        -> with('product_cate',$product_cate)
        -> with('cate_slug',$cate_slug)
        -> with('rating',$rating);
    }
    public function tags_t(Request $request, $product_tag){
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        //Chi tiết sản phẩm
        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
        
        $product_tag_s = Product::where('product_status','0')->where('product_name','LIKE','%'.$product_tag.'%')
        ->orWhere('product_tags','LIKE','%'.$product_tag.'%') ->orWhere('product_slug','LIKE','%'.$product_tag.'%')->get();
       
             $meta_decs = 'Tags : '.$product_tag;
             $meta_keywords ='Tags tìm kím : '.$product_tag;
             $meta_titel ='Tags : '. $product_tag;
             $url_canonical = $request->url();
        
       
        
        // return view('page.productSP.tags_related_products.blade')
        // -> with('category',$cate_product) 
        // -> with('brand',$brand_product)
        // -> with('product_details',$details_product)
        // -> with('relate',$related_product)
        // -> with('meta_decs',$meta_decs)
        // -> with('meta_keywords',$meta_keywords)
        // -> with('meta_titel',$meta_titel)
        // -> with('url_canonical',$url_canonical)
        // -> with('category_post',$category_post)
        // -> with('gallery',$gallery);
        return view('page.productSP.tags_related_products')
        -> with('category',$cate_product) 
        -> with('brand',$brand_product)
        -> with('category_post',$category_post)
        -> with('meta_decs',$meta_decs)
        -> with('meta_keywords',$meta_keywords)
        -> with('meta_titel',$meta_titel)
        -> with('url_canonical',$url_canonical)
        -> with('product_tag',$product_tag)
        -> with('product_tag_s',$product_tag_s)
        ;
    }
    //xem nhanh
 //xem nhanh
    public function quickview(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $gallrery = Gallery::where('product_id',$product_id)->get();    
        $output['product_gallrey']='';
        foreach($gallrery as $key => $gall){
            $output['product_gallrey'] .='<p><img width="100%" src="public/uploads/gallery/'.$gall->gallery_image.'"></p>';
        }
        $output['product_name'] = $product -> product_name;
        $output['product_id'] = $product -> product_id;
        $output['product_desc'] = $product -> product_desc;
        $output['product_content'] = $product -> product_content;
        $output['product_price'] = number_format($product -> product_price,0,',','.').'VNĐ';
        $output['product_image'] ='<p><img width="100%" src="public/uploads/product/'.$product->product_image.'"></p>';
        $output['product_button']='<input  type="button" value="Mua ngay" class="btn btn-primary btn-sm add-to-cart-quickview" 
        data-id_product="'.$product -> product_id.'" name="add-to-cart" id="bye_quickview" >';
        $output['product_quickview_value'] =
        '<input type="hidden" value="'.$product -> product_id.'" class="cart_product_id_'.$product -> product_id.'">
        <input type="hidden" value="'.$product -> product_name.'" class="cart_product_name_'.$product -> product_name.'">
        <input type="hidden" value="'.$product -> product_image.'" class="cart_product_image_'.$product -> product_image.'">
        <input type="hidden" value="'.$product -> product_quantity.'" class="cart_product_quantity_'.$product -> product_quantity.'">
        <input type="hidden" value="'.$product -> product_price.'" class="cart_product_price_'.$product -> product_price.'">
        <input type="hidden" value="1" class="cart_product_qty_'.$product -> product_id.'">';
        echo json_encode($output);
    }
    //end xem nhanh
    //Bình luận
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',NULL)->where('comment_status',0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->orderBy('comment_id','DESC')->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output .= '
            <div class="row style_comment">
                <div class="col-md-1"style="padding-left: 0px;padding-right: 0px;">
                    
                    <img width="100%" src="'.url('public/frontend/images/andanh-icon.png').'" class="img img-responsive img-thumbnail" alt="">
                </div>
                <div class="col-md-10">
                    <p style="color: green">@'.$comm->comment_name.'</p>
                    <p>'.$comm->comment.'</p>
                    <p style="color: #000">Bình luận ngày: '.$comm->comment_date.'</p>
                </div>
                
            </div>
            <p></p>';
            foreach($comment_rep as $key => $rep_comment){
                if($rep_comment->comment_parent_comment ==$comm->comment_id){
                    $output .= '
                    <div class="row style_comment" style="margin : 5px 40px ;background:#EBE3D5;">
                        <div class="col-md-1"style="padding-left: 0px;padding-right: 0px;">
                            
                            <img width="90%" src="'.url('public/frontend/images/logo_petnew.png').'" class="img img-responsive img-thumbnail" alt="">
                        </div>
                        <div class="col-md-10">
                            <p style="color: blue">@PetShop</p>
                           
                            <p style="color: #000">'.$rep_comment->comment.'</p>
                        </div>
                        
                    </div>
                    <p></p>';
                }
            }
           
        }
        echo $output; 
    }
    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment -> comment_product_id = $product_id;
        $comment -> comment_name = $comment_name;
        $comment -> comment = $comment_content;
        $comment -> comment_status = 1;
        $comment -> save();
    }
    public function list_comment(Request $request){
        $this ->Authlogin();
        $comment = Comment::with('product')->where('comment_parent_comment','=',NULL)->orderBy('comment_status','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }
    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment ->comment_status = $data['comment_status'];
        $comment ->save();

    }
    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment -> comment = $data['comment'];
        $comment -> comment_product_id = $data['comment_product_id'];
        $comment -> comment_parent_comment = $data['comment_id'];
        $comment ->comment_status = 0;
        $comment ->comment_name = 'PetShop';
        $comment ->save();


    }
    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating -> product_id = $data['product_id'] ;
        $rating -> rating = $data['index'];
        $rating -> save();
        echo 'done';
    }
}
