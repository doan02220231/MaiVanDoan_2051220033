<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\CatePost;
use App\Models\Post;

session_start();
class PostController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function add_post(){
        $this ->Authlogin();
        $cate_post = CatePost::orderBy('category_post_id','DESC')->get();

        return view('admin.post.add_post')->with(compact('cate_post'));
    }
    public function all_post(){
        $this ->Authlogin();
        $all_post = Post::with('cate_post')->orderBy('post_id')-> paginate(5);
       
        
        return view('admin.post.list_post')->with(compact('all_post'));
        
    }
    public function unactive_post($post_id){
        $this -> Authlogin();
        DB::table('tbl_posts') -> where('post_id',$post_id) -> update(['post_status'=>1]); 
        Session::put('message','Ẩn slider thành công');
        return redirect()->back();
    }
    public function active_post($post_id){
        $this -> Authlogin();
        DB::table('tbl_posts') -> where('post_id',$post_id) -> update(['post_status'=>0]); 
        Session::put('message','Hiển thị slider thành công');
        return redirect()->back();
    }
    public function save_post(Request $request){
        $this ->Authlogin();
        $data = $request -> all();
        $post = new Post();
        $post -> post_title = $data['post_title'];
        $post -> post_slug = $data['post_slug'];
        $post -> post_desc = $data['post_desc'];
        $post -> post_conten = $data['post_conten'];
        $post -> post_meta_desc = $data['post_meta_desc'];
        $post -> post_meta_keywords = $data['post_meta_keywords'];
        $post -> category_post_id = $data['category_post_id'];
        $post -> post_status = $data['post_status'];
        
        $get_image = $request ->file('post_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // lấy tên hình ảnh
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
            $get_image -> move('public/uploads/post',$new_image);
            $post -> post_image = $new_image;
            $post -> save();
            Session::put('message','Thêm bài viết thành công');
            return Redirect()->back();
        }
        else{
            Session::put('message','Làm ơn thêm hình ảnh');
            return Redirect()->back();
        }
        
    }
    public function delete_post($post_id){
        $this ->Authlogin();
        $post = Post::find($post_id);
        $post_image = $post -> post_image;
        if($post_image){
            $path = ('public/uploads/post/'.$post_image);
            unlink($path);
        }
        
        $post -> delete();
        Session::put('message','Xoá bài viết thành công');
        return Redirect() -> back();
    }
    public function edit_post($post_id){
        $this ->Authlogin();
        $cate_post = CatePost::orderBy('category_post_id','DESC')->get();
        $post = Post::find($post_id);
        return view('admin.post.edit_post')->with(compact('post','cate_post'));
    }
    public function update_post($post_id ,Request $request){
        $this ->Authlogin();
        $data = $request -> all();
        $post = Post::find($post_id);
        $post -> post_title = $data['post_title'];
        $post -> post_slug = $data['post_slug'];
        $post -> post_desc = $data['post_desc'];
        $post -> post_conten = $data['post_conten'];
        $post -> post_meta_desc = $data['post_meta_desc'];
        $post -> post_meta_keywords = $data['post_meta_keywords'];
        $post -> category_post_id = $data['category_post_id'];
        $post -> post_status = $data['post_status'];
        
        $get_image = $request ->file('post_image');
        if($get_image){
            //xoá ảnh củ ở file
            $post_image_old = $post -> post_image;
            $path = ('public/uploads/post/'.$post_image_old);
            unlink($path);
            //cập nhật ảnh mới vào file
            $get_name_image = $get_image->getClientOriginalName(); // lấy tên hình ảnh
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
            $get_image -> move('public/uploads/post',$new_image);
            $post -> post_image = $new_image;
            
        }
        $post -> save();
        Session::put('message','Cập nhật bài viết thành công');
        return Redirect()->back();
    }
    //showw bài viết ở product
    public function danh_muc_bai_viet(Request $request,$post_slug){
        //category_post
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        
        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();

       
        $catepost = CatePost::where('category_post_slug',$post_slug) -> take(1)->get();
        foreach($catepost as $key => $cate){
        //Seo
        $meta_decs =$cate -> category_post_desc;
        $meta_keywords = $cate -> category_post_slug;
        $meta_titel =$cate -> category_post_name;
        $cate_id = $cate -> category_post_id;
        $url_canonical = $request->url();
        }   
        //EndSeo
        $post_by_id = Post::with('cate_post')->where('post_status','0')->where('category_post_id',$cate_id)->paginate(5);
        return view('page.blog.category_blog')
        -> with('category',$cate_product) -> with('brand',$brand_product) 
        -> with('meta_decs',$meta_decs)
        -> with('meta_keywords',$meta_keywords)
        -> with('meta_titel',$meta_titel)
        -> with('url_canonical',$url_canonical)
        -> with('post_by_id',$post_by_id)
        -> with('category_post',$category_post);
    }
    public function bai_viet(Request $request,$post_slug){
         //category_post
         $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        
         $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
         $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
 
        
         
         $post_by_id = Post::with('cate_post')->where('post_status','0')->where('post_slug',$post_slug)->take(1)->get();
         foreach($post_by_id as $key => $po){
         //Seo
         $meta_decs =$po -> post_meta_desc;
         $meta_keywords = $po -> post_meta_keywords;
         $meta_titel =$po -> post_title;
         //$cate_id = $po -> category_post_id;
         $url_canonical = $request->url();
         $category_post_id = $po -> category_post_id;
         $post_id = $po -> post_id;
         }   
         //EndSeo

         
         $related = Post::with('cate_post')->where('post_status','0')->where('category_post_id',$category_post_id)
         ->whereNotIn('post_slug',[$post_slug])->take(5)->get();
         //update views
         $post = Post::where('post_id',$post_id)->first();
         $post -> post_views = $post -> post_views + 1;
         $post -> save();
         return view('page.blog.blog_b')
         -> with('category',$cate_product)-> with('brand',$brand_product) 
         -> with('meta_decs',$meta_decs)
         -> with('meta_keywords',$meta_keywords)
         -> with('meta_titel',$meta_titel)
         -> with('url_canonical',$url_canonical)
         -> with('post_by_id',$post_by_id)
         -> with('category_post',$category_post)
         -> with('related',$related);
    }
}
