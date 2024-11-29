<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\CatePost;
use App\Models\Contact;
use App\Models\Slider;

session_start();
class ContactController extends Controller
{
    public function lien_he(Request $request){
        $category_post = CatePost::orderBy('category_post_id','DESC')->where('category_post_status','0')->get();
        // $category_post = DB::table('tbl_category_post')-> where('category_post_status','0')->orderBy('category_post_id','desc')->get();
        //slider
        // $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();
        //endslider

        //Seo
            $meta_decs ="Liên hệ";
            $meta_keywords = "Liên hệ";
            $meta_titel ="Liên hệ";
            $url_canonical = $request->url();
        //EndSeo
        $cate_product = DB::table('tbl_caregory_product')-> where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')-> where('brand_status','0')->orderBy('brand_id','desc')->get();
        $contact = Contact::where('info_id',1)->get();
        return view('page.lienhe.contact')-> with('category',$cate_product) -> with('brand',$brand_product)
        -> with('meta_decs',$meta_decs)
        -> with('meta_keywords',$meta_keywords)
        -> with('meta_titel',$meta_titel)
        -> with('url_canonical',$url_canonical)
        -> with('contact',$contact)
        -> with('category_post',$category_post);
    }
    public function information(Request $request){
        $contact = Contact::where('info_id',1)->get();
        return view('admin.information.add_information')->with(compact('contact'));
    }
    public function update_info(Request $request,$info_id){
        $data = $request->all();
        $contact =  Contact::find($info_id);
        $contact -> info_contact = $data['info_contact'];
        $contact -> info_map = $data['info_map'];
        $contact -> info_fanpage = $data['info_fanpage'];
        $get_image = $request ->file('info_image');
        $path = 'public/uploads/contact/';
        if($get_image){
            unlink($path.$contact->info_image);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
            $get_image -> move($path,$new_image);
            $contact -> info_image = $new_image;

            
        }
        $contact -> save();
        return redirect()->back()->with('message','Cập nhật thông tin website thành công');
    }
    public function save_info(Request $request){
        $data = $request->all();
        $contact = new Contact();
        $contact -> info_contact = $data['info_contact'];
        $contact -> info_map = $data['info_map'];
        $contact -> info_fanpage = $data['info_fanpage'];
        $get_image = $request ->file('info_image');
        $path = 'public/uploads/contact/';
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
            $get_image -> move($path,$new_image);
            $contact -> info_image = $new_image;

            
        }
        $contact -> save();
        return redirect()->back()->with('message','Cập nhật thông tin website thành công');
    }
}
