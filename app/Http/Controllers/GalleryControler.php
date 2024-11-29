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
use App\Models\PetGallery;
class GalleryControler extends Controller
{

      public function add_pet_gallery($pet_id){
        $this ->Authlogin();
        $pro_id = $pet_id;

        return view('admin.pet_gallery.add_pet_gallery')->with(compact('pro_id'));
    }
     public function  select_pet_gallery(Request $request){
       echo $request->pro_id;
    
    }
        public function insert_pet_gallery(Request $request,$pro_id){
        $this ->Authlogin();
        $get_image = $request -> file('file');
        if($get_image){
            foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image -> getClientOriginalExtension();
                $image -> move('public/uploads/gallery',$new_image);
                $gallery = new PetGallery(); 
                $gallery -> gallery_pet_name = $new_image ;
                $gallery -> gallery_pet_image = $new_image ;
                $gallery -> pet_id = $pro_id ;
                $gallery -> save();
            
            }
        }
        Session::put('message','Thêm ảnh chi tiết thành công');
            return Redirect()->back();

    }
   
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function add_gallery($product_id){
        $this ->Authlogin();
        $pro_id = $product_id;

        return view('admin.gallery.add_gallery')->with(compact('pro_id'));
    }
    public function update_gallery_name(Request $request){
        $this ->Authlogin();
        $gal_id = $request -> gal_id;
        $gal_text = $request -> gal_text;
        $gallery = Gallery::find($gal_id ); 
        $gallery -> gallery_name = $gal_text ;
        $gallery -> save();
    }
    public function insert_gallery(Request $request,$pro_id){
        $this ->Authlogin();
        $get_image = $request -> file('file');
        if($get_image){
            foreach($get_image as $image){
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
        Session::put('message','Thêm ảnh chi tiết thành công');
            return Redirect()->back();

    }
    public function delet_gallery(Request $request){
        $this ->Authlogin();
        $gal_id = $request -> gal_id;
        $gallery = Gallery::find($gal_id ); 
        $gallery_g_image = $gallery -> gallery_image;
        unlink('public/uploads/gallery/'.$gallery_g_image);
        $gallery -> delete();
    }
    public function update_gallery_image(Request $request){
        $this ->Authlogin();
        $get_image = $request -> file('file');
        $gal_id = $request -> gal_id;
        if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
                $get_image -> move('public/uploads/gallery',$new_image);
                $gallery =  Gallery::find($gal_id); 
                unlink('public/uploads/gallery/'.$gallery->gallery_image);
                $gallery -> gallery_image = $new_image ;
                $gallery -> save();
        }
    }
    public function select_gallery(Request $request){
        $this ->Authlogin();
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id',$product_id)->get();
        $gallery_cout = $gallery->count();
        $output = '
        <form>
            '.csrf_field().'
            <table class="table">
                <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên hình ảnh</th>
                        <th>Hình ảnh</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
            ';
        if($gallery_cout > 0){
            $i = 0;
            foreach($gallery as $key => $gal){
                $i++;
                $output .='
                
                    <tr> 
                        <td>'.$i.'</td>
                        <td contenteditable class="edit_gallery_name" data-gal_id="'.$gal -> gallery_id.'">'.$gal -> gallery_name .'</td>
                        <td>
                            <img src = "'.url('public/uploads/gallery/'.$gal -> gallery_image).'" class = "img-thumbnail" width = "120" height="120">
                            <input type="file" class="file_image" style="width: 40%;" data-gal_id="'.$gal -> gallery_id.'" 
                            id="file-'.$gal -> gallery_id.'" name="file" accpet="image/*">
                        </td>
                        <td>
                            <button type="button" data-gal_id ="'.$gal -> gallery_id.'" class = "btn btn-xs btn-danger delete-gallery">Xoá</button>
                        </td>
                    </tr>
                 
                ';
                
            }
        }
        else{
            $output .='
            <tr>
                <td colspan = "4">Chưa có thư viện ảnh</td>
                
             </tr>
            ';
        }
        $output .='
                </tbody>
            </table>
        </form>
        ';
        echo $output;
    }
}
