<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
 use App\Models\Order_thue;
use Illuminate\Http\Request;
session_start();

class CartPetController extends Controller

{
     public function add_to_cart_combo(Request $request) {
    $data = $request->all();

    // Tạo session_id ngẫu nhiên cho combo
    $session_id_combo = substr(md5(microtime()), rand(0, 26), 5);
    $cart_combo = Session::get('cart_combo');

    if ($cart_combo) {
        $is_avaiable = 0;
        // Kiểm tra nếu combo đã tồn tại trong giỏ hàng
        foreach ($cart_combo as $key => $val) {
            if ($val['combo_id'] == $data['cart_combo_id']) {
                $is_avaiable++;
            }
        }

        // Nếu combo chưa tồn tại, thêm vào giỏ hàng
        if ($is_avaiable == 0) {
            $cart_combo[] = array(
                'session_id_combo' => $session_id_combo,
                'combo_name' => $data['cart_combo_name'],
                'combo_id' => $data['cart_combo_id'],
                'combo_image' => $data['cart_combo_image'],
                'combo_gia' => $data['cart_combo_price'],
            );
            Session::put('cart_combo', $cart_combo);
        }
    } else {
        // Nếu giỏ hàng chưa có combo nào, khởi tạo giỏ hàng với combo mới
        $cart_combo[] = array(
            'session_id_combo' => $session_id_combo,
            'combo_name' => $data['cart_combo_name'],
            'combo_id' => $data['cart_combo_id'],
            'combo_image' => $data['cart_combo_image'],
            'combo_gia' => $data['cart_combo_price'],
        );
        Session::put('cart_combo', $cart_combo);
    }

    Session::save();
}
 public function delete_combo($session_id_combo){
        $cart_combo = Session::get('cart_combo');
        if($cart_combo == true){
            foreach($cart_combo as $key => $val){
                if($val['session_id_combo']== $session_id_combo){
                    unset($cart_combo[$key]);
                }
            }
            Session::put('cart_combo', $cart_combo);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
    }
        ///////////////////
        public function update_suc_khoe(Request $request){
        $data = $request->all();
        // $order_id = $data['order_id'];
        // $order = Order::where('order_id',$order_id)->first();
        $update_khoe = Order_thue::find($data['order_thue_id']);
        $update_khoe->order_thue_suc_khoe = $data['pet_thue_suc_khoe'];
        $update_khoe->save();  
    }
     public function update_mua_ban(Request $request){
        $data = $request->all();
        // $order_id = $data['order_id'];
        // $order = Order::where('order_id',$order_id)->first();
        $update_mua = Order_thue::find($data['order_thue_id']);
        $update_mua->order_thue_status = $data['pet_thue_mua'];
        $update_mua->save();  
    }
    public function del_pet(){
        $cart_thue = Session::get('cart_thue');
        if($cart_thue == true){
            Session::forget('cart_thue');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa tất cả sản phẩm thành công');
        }
    }
public function update_qty_thue(Request $request) {
    $data = $request->all();
    $cart_thue = Session::get('cart_thue');
    if ($cart_thue == true) {
        foreach ($data['cart_qty_thue'] as $key => $qty) {
            foreach ($cart_thue as $session => $val) {
                if ($val['session_id_thue'] == $key) {  // Missing parenthesis fixed
                    $cart_thue[$session]['pet_qty'] = $qty;
                }
            }
        }
        Session::put('cart_thue', $cart_thue);
        return redirect()->back()->with('message', 'Cập nhật số lượng thành công'); // Added success message
    } else {
        return redirect()->back()->with('message', 'Cập nhật số lượng thất bại');
    }
}

    public function delete_thue($session_id_thue){
        $cart_thue = Session::get('cart_thue');
        if($cart_thue == true){
            foreach($cart_thue as $key => $val){
                if($val['session_id_thue']== $session_id_thue){
                    unset($cart_thue[$key]);
                }
            }
            Session::put('cart_thue', $cart_thue);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
    }
    public function gio_hang_thue(Request $request){
         
        return view('page.cart.thue_cart_ajax');
    }
    public function add_cart_ajax_thue(Request $request){
  
         $data = $request->all();
         print_r($data);
        $session_id_thue = substr(md5(microtime()),rand(0,26),5);
        $cart_thue = Session::get('cart_thue');

           if($cart_thue == true){
            $is_avaiable = 0;
            foreach($cart_thue as $key => $val){
                if($val['pet_id'] == $data['cart_thue_id']){
                     $is_avaiable == true;
                     break; 
                }
            }
   
        }else{
                 $cart_thue[]= array(
                'session_id_thue' => $session_id_thue,
                'pet_name' => $data['cart_thue_name'],
                'pet_id' => $data['cart_thue_id'],
                'pet_image' => $data['cart_thue_image'],
                'pet_price' => $data['cart_thue_price'],
                'pet_gender' => $data['cart_thue_gender'],
                'pet_type' => $data['cart_thue_type'],
                'pet_slug' => $data['cart_thue_slug'],
                'pet_content' => $data['cart_thue_content'],
                'pet_desc' => $data['cart_thue_desc'],
                'pet_qty' => $data['cart_thue_qty'],
       
            );
            Session::put('cart_thue', $cart_thue);
        }
        
        Session::save();
    }  
    
}
