<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
class SliderController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function manage_slider(){
        $this ->Authlogin();
        $all_slider = Slider::orderBy('slider_id','DESC')->paginate(3);
        return view('admin.slider.list_slider')->with(compact('all_slider'));
    }
    public function add_slider(){
        $this ->Authlogin();
        return view('admin.slider.add_slider');
    }
    public function insert_slider(Request $request){
        $this ->Authlogin();
        $data = $request->all();
       
        
        $get_image = $request ->file('slider_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
            $get_image -> move('public/uploads/banner',$new_image);
            
            $slider = new Slider();
            $slider -> slider_name = $data['slider_name'];
            $slider -> slider_image = $new_image;       
            $slider -> slider_status = $data['slider_status'];
            $slider -> slider_desc = $data['slider_desc'];
            $slider -> save();
            Session::put('message','Thêm slide thành công');
            return Redirect::to('add-slider');
        }
        else{
            Session::put('message','Làm ơn thêm hình ảnh');
            return Redirect::to('add-slider');
        }
        
    }
    public function unactive_slider($slide_id){
        $this -> Authlogin();
        DB::table('tbl_slider') -> where('slider_id',$slide_id) -> update(['slider_status'=>1]); 
        Session::put('message','Ẩn slider thành công');
        return Redirect::to('manage-slider');
    }
    public function active_slider($slide_id){
        $this -> Authlogin();
        DB::table('tbl_slider') -> where('slider_id',$slide_id) -> update(['slider_status'=>0]); 
        Session::put('message','Hiển thị slider thành công');
        return Redirect::to('manage-slider');
    }
    public function delete_slider($slide_id){
        $this ->Authlogin();
        $slider = Slider::find($slide_id);
        $slider_image = $slider -> slider_image;
        if($slider_image){
            $path = ('public/uploads/banner/'.$slider_image);
            unlink($path);
        }
        
        $slider -> delete();
        Session::put('message','Xoá banner thành công');
        return Redirect() -> back();
    }
    public function edit_slider($slide_id){
        $this ->Authlogin();
       
        $slider = Slider::find($slide_id);
        return view('admin.slider.edit_slide')->with(compact('slider'));
    }
    public function update_slider($slide_id ,Request $request){
        $this -> Authlogin();
        $data = $request->all();
        $slider = Slider::find($slide_id);
        $slider -> slider_name = $data['slider_name'];
        $slider -> slider_desc = $data['slider_desc'];
        $get_image = $request ->file('slider_image');
       
        if($get_image){
            $slider_image_old = $slider -> slider_image;
            $path = ('public/uploads/banner/'.$slider_image_old);
            unlink($path);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
            $get_image -> move('public/uploads/banner',$new_image);
            $slider -> slider_image = $new_image;   
          
        }
          
        $slider -> save();
        Session::put('message','Cập nhật slide thành công');
        return Redirect::to('manage-slider');
       
    }
}
