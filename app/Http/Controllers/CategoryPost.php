<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CatePost;
use App\Models\CategoryProductModel;
session_start();
class CategoryPost extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function add_category_post(){
        $this -> Authlogin();
        
        return view('admin.category_post.add_category_post');
    }
    public function save_category_post(Request $request){
        $this -> Authlogin();
        $data = $request -> all();
        $category_post = new CatePost();
        $category_post -> category_post_name = $data['cate_post_name'];
        $category_post -> category_post_slug = $data['cate_post_slug'];
        $category_post -> category_post_desc = $data['cate_post_desc'];
        $category_post -> category_post_status = $data['cate_post_status'];
        $category_post -> save();
        
        Session::put('message','Thêm danh mục bài viết thành công');
        return redirect()->back();

        
    }
    public function edit_category_post($category_post_id){
        $this -> Authlogin();
        $category_post = CatePost::find($category_post_id);
       
        
        return view('admin.category_post.edit_category_post')->with(compact('category_post'));
    }
    public function all_category_post(){
        $this -> Authlogin();
        $category_post = CatePost::orderBy('category_post_id','DESC')->paginate(5);
        return view('admin.category_post.list_category_post')->with(compact('category_post'));
    }
    public function update_category_post(Request $request, $post_id){
        $this -> Authlogin();
       
        $data = $request -> all();
        $category_post = CatePost::find($post_id);
        $category_post -> category_post_name = $data['cate_post_name'];
        $category_post -> category_post_slug = $data['cate_post_slug'];
        $category_post -> category_post_desc = $data['cate_post_desc'];
        $category_post -> category_post_status = $data['cate_post_status'];
        $category_post -> save();
        
        Session::put('message','Cập nhật danh mục bài viết thành công');
        return redirect('/all-category-post');
    }
    public function unactive_category_post($category_post_id){
        $this -> Authlogin();
        DB::table('tbl_category_post') -> where('category_post_id',$category_post_id) -> update(['category_post_status'=>1]); 
        Session::put('message','Ẩn slider thành công');
        return redirect()->back();
    }
    public function active_category_post($category_post_id){
        $this -> Authlogin();
        DB::table('tbl_category_post') -> where('category_post_id',$category_post_id) -> update(['category_post_status'=>0]); 
        Session::put('message','Hiển thị slider thành công');
        return redirect()->back();
    }
    public function delete_category_post($post_id){
        $category_post = CatePost::find($post_id);
        $category_post -> delete();
        
        Session::put('message','Xoá danh mục bài viết thành công');
        return redirect()->back();
    }
    //trang product
    
}
