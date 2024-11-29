<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Coupon;
session_start();
class CouponController extends Controller
{ 

    public function validateCoupon(Request $request)
        {
            $couponCode = $request->input('coupon_code');
            $coupon = Coupon::where('coupon_code', $couponCode)
                            ->where('coupon_status', 1) // Assuming coupon_status 1 means active
                            ->first();

            if ($coupon && $this->isCouponValid($coupon)) {
                return response()->json([
                    'success' => true,
                    'discount' => $coupon->coupon_number
                ]);
            } else {
                return response()->json(['success' => false]);
            }
        }

private function isCouponValid($coupon)
{
    $currentDate = date('Y-m-d');
    return ($coupon->coupon_date_start <= $currentDate && $coupon->coupon_date_end >= $currentDate);
}

    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin') -> send();
        }
    }
    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã giảm giá thành công');
        }
    }
    public function insert_coupon(){
        return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id){
        $this ->Authlogin();
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id) -> delete();
        Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }
    public function list_coupon(){
        $this ->Authlogin();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $coupon = Coupon::orderby('coupon_id','desc')->paginate(5);
        return view('admin.coupon.list_coupon')-> with(compact('coupon','today'));
    }
    public function insert_coupon_code(Request $request){
        $this ->Authlogin();
        $data = $request ->all();
        $coupon = new Coupon;

        $coupon -> coupon_name = $data['coupon_name'];
        $coupon -> coupon_date_start = $data['coupon_date_start'];
        $coupon -> coupon_date_end = $data['coupon_date_end'];
        $coupon -> coupon_number = $data['coupon_number'];
        $coupon -> coupon_code = $data['coupon_code'];
        $coupon -> coupon_times = $data['coupon_times'];
        $coupon -> coupon_condition = $data['coupon_condition'];
        $coupon -> coupon_status = $data['coupon_status'];
        $coupon -> save();
        Session::put('message','thêm mã giảm giá thành công');
        return Redirect::to('insert-coupon');
    }
    public function edit_coupon(Request $request,$coupon_id){
        $this -> Authlogin();
        $coupon_edit = Coupon::find($coupon_id);
        return view('admin.coupon.edit_coupon')-> with(compact('coupon_edit'));
    }
    public function update_coupon_code(Request $request,$coupon_id){
        $this -> Authlogin();
       
        $data = $request -> all();
        $coupon_update = Coupon::find($coupon_id);
        $coupon_update -> coupon_name = $data['coupon_name'];
        $coupon_update -> coupon_date_start = $data['coupon_date_start'];
        $coupon_update -> coupon_date_end = $data['coupon_date_end'];
        $coupon_update -> coupon_number = $data['coupon_number'];
        $coupon_update -> coupon_code = $data['coupon_code'];
        $coupon_update -> coupon_times = $data['coupon_times'];
        $coupon_update -> coupon_status = $data['coupon_status'];
        $coupon_update -> coupon_condition = $data['coupon_condition'];
        
        $coupon_update -> save();
        
        Session::put('message','Cập nhật mã giảm giá thành công');
        return redirect('/list-coupon');
    }

}
