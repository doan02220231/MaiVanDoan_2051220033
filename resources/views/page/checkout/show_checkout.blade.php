@extends('show_layout_SP')
@section('content')
<style type="text/css">
    #cart_items .cart_info .cart_menu {
        background: #5454f3;

    }
</style>
<section id="cart_items">
    
    <div class="container">
        <div class="breadcrumbs">
        </br>
            <ol class="breadcrumb"style=" margin-bottom: 30px;">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Thanh toán</li>
            </ol>
        </div><!--/breadcrums-->
        <div class="register-req">
            <p>Làm ơn đăng ký hoặc đăng nhập để thanh toán và xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-5 ">
                    <div class="bill-to">
                        
                        <div class="form-one ">
                            <p>Tính phí vận chuyển</p>
                            <form >
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputdesc">Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                        <option value="">--Chọn thành phố--</option>
                                        @foreach ($city as $key => $ci)
                                        <option value="{{$ci -> matp}}">{{$ci -> name_tp}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputdesc">Chọn quận huyện</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                        <option value="">--Chọn quận huyện--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputdesc">Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                        <option value="">--Chọn xã phường--</option>
                                    </select>
                                </div>
                            <input style="background:blue;" type="button" value="Tính phí ship" name="send_order" class="btn btn-primary btn-sm calculate_delivery " >
                            </form>
                            <p>Điền thông tin đại chỉ</p>
                            <form  method="POST">
                                @csrf
                                <input type="text" name="shipping_email" class="shipping_email" placeholder="Email">
                                <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
                                <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
                                <textarea name="shipping_nodes" class="shipping_nodes" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
                                
                                @if(Session::get('fee'))
                                    <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}" >
                                @else
                                    <input type="hidden" name="order_fee" class="order_fee" value="" >
                                @endif

                                @if(Session::get('coupon'))
                                    @foreach (Session::get('coupon') as $key => $cou)
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                    @endforeach
                                    
                                @else
                                    <input type="hidden" name="order_coupon" class="order_coupon" value="no" >
                                @endif   
                                
                                <div class="">
                                    <div class="form-group">
                                        <label for="exampleInputdesc">Chọn phương thức thanh toán</label>
                                        <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
                                            <option value="1">Nhận hàng - trả tiền</option>
                                            <option value="0">Chuyển khoản ngân hàng</option>
                                            
                                        </select>
                                    </div>
                                    
                                </div>
                                <input style="background:blue;" type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send-order" >
                            </form>
                            
                        </div>
                        
                    </div>
                </div>	
                <div class="col-sm-7">
                    <h4>Xem lại giỏ hàng</h4>
                    @if (session()->has('message'))
                         <div class="alert alert-success">
                             {{session()->get('message')}}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            {{session()->get('error')}}
                        </div>
                    @endif
                    <div class="table-responsive cart_info" style="margin-top: 34px">
                        
                         <form action="{{url('/update-cart')}}" method="POST">
                             @csrf
                         <table class="table table-condensed">
                             <thead>
                                 <tr class="cart_menu">
                                     <td class="image">Hình ảnh</td>
                                     <td class="description">Tên sản phẩm</td>
                                     <td class="price">Giá sản phẩm</td>
                                     <td class="quantity">Số lượng</td>
                                     <td class="total">Thành tiền</td>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                                 @if(Session::get('cart') == true)
                                 @php
                                     $total = 0;
                                 @endphp
                                 @foreach (Session::get('cart') as $key => $cart)
                                     @php
                                         $suptotal = $cart['product_price'] * $cart['product_qty'];
                                         $total += $suptotal;
                                     @endphp
                                     <tr>
                                         <td class="cart_product">
                                             <a href=""><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}"></a>
                                         </td>
                                         <td class="cart_description">
                                             <h4><a href=""></a></h4>
                                             <p>{{$cart['product_name']}}</p>
                                         </td>
                                         <td class="cart_price">
                                             <p style=" margin-bottom: 0px; ">{{number_format($cart['product_price'],0,',','.')}}VNĐ</p>
                                         </td>
                                         <td class="cart_quantity">
                                             <div class="cart_quantity_button">
                                                     <input class="cart_quantity" style="width: 63px" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" >
                                                 
                                             </div>
                                         </td>
                                         <td class="cart_total">
                                             <p style=" margin-bottom: 0px; " class="cart_total_price">{{number_format($suptotal,0,',','.')}}VNĐ</p>
                                         </td>
                                         {{-- <td class="cart_delete">
                                             <a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                                         </td> --}}
                                     </tr>
                                 @endforeach
                                 <tr>
                                     <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out" ></td>
                                     <td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả sản phẩm</a></td>
                                    
                                     {{-- <td>
                                         <?php 
                                                 $customer_id = Session::get('customer_id');
                                                 if($customer_id != NULL){
                                             ?>
                                                 <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Đặt hàng</a>
                                     
                                             <?php 
                                                 }else{
                                             ?>
                                                 <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đặt hàng</a>
                                             <?php 
                                                 }
                                             ?>
                                         
                                     </td>
                                     <td>
                                         @if (Session::get('coupon'))
                                         <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã giảm giá</a>
                                         @endif
                                         
                                     </td> --}}
                                   
                                     <td colspan="2">
                                         <li>Tổng tiền: <span>{{number_format($total,0,',','.')}}VNĐ</span></li>
                                         @if (Session::get('coupon'))
                                             <li>
                                                 @foreach (Session::get('coupon') as $key =>$cou)
                                                     @if ($cou['coupon_condition'] == 1)
                                                         Mã giảm: {{$cou['coupon_number']}} %
                                                         <p>
                                                             @php
                                                                 $total_coupon = ($total*$cou['coupon_number'])/100;
                                                                 echo '<p> <li>Tổng tiền % giảm: '.number_format($total_coupon,0,',','.').'VNĐ</li></p>';
                                                             @endphp
                                                         </p>
                                                        <p>
                                                            @php
                                                                $total_after_coupon = $total-$total_coupon ;
                                                            @endphp
                                                        </p>
                                                     @elseif ($cou['coupon_condition'] == 2)
                                                         Mã giảm: {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
                                                         <p>
                                                             @php
                                                                 $total_coupon = $total - $cou['coupon_number'];
                                                                
                                                             @endphp
                                                         </p>
                                                        @php
                                                            $total_after_coupon = $total_coupon ;
                                                        @endphp
                                                     @endif
                                                 @endforeach 
                                             </li>
                                         @endif
                                         @if(Session::get('fee'))
                                        <li>
                                            <a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>
                                            Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}} VNĐ</span>
                                            @php
                                                $total_after_fee = $total + Session::get('fee');
                                            @endphp
                                        </li>
                                         @endif
                                         <li>Thành tiền:
                                        @php
                                            if (Session::get('fee') && !Session::get('coupon')) {
                                                $total_after =  $total_after_fee;
                                                echo number_format($total_after,0,',','.').'VNĐ';
                                            }elseif(!Session::get('fee') && Session::get('coupon')){
                                                $total_after =  $total_after_coupon;
                                                echo number_format($total_after,0,',','.').'VNĐ';
                                            }elseif(Session::get('fee') && Session::get('coupon')){
                                                $total_after =  $total_after_coupon;
                                                $total_after = $total_after + Session::get('fee');
                                                echo number_format($total_after,0,',','.').'VNĐ';
                                            }elseif(!Session::get('fee') && !Session::get('coupon')){
                                                $total_after = $total;
                                                echo number_format($total_after,0,',','.').'VNĐ';
                                            }
                                        @endphp
                                        </li>
                                         {{-- {{-- <li>Thuế <span></span></li> --}}
                                         
                                     </td>
                                    
                                 </tr>
                                 @else
                                     <td colspan="5">
                                         <center>
                                         @php
                                             echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
                                         @endphp
                                         </center>
                                     </td>
                                 @endif
                                 
                             </tbody>  
                         </form>
                         @if (Session::get('cart'))
                         <tr>
                            <td>
                                <form action="{{url('/vnpay-payment')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total_vnpay" value="{{$total_after}}">
                                    <button type="submit" class="btn btn-default check_out" name="redirect">Thanh toán VNPAY</button>
                                </form>
                                {{-- <form action="{{url('/momo-payment')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total_momo" value="{{$total_after}}">
                                    <button type="submit" class="btn btn-default check_out" name="payUrl">Thanh toán MOMO</button>
                                </form> --}}
                            </td>
                         </tr>
                         @endif
                         {{-- @if(Session::get('cart'))
                         <tr>
                             <td >
                             <form method="POST" action="{{url('/check-coupon')}}">
                                 @csrf
                                 <input type="text" class="form-control" name="coupon" placeholder="nhập mã giảm giá"><br>
                                 <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                             </form></td>
                         </tr>
                         @endif --}}
                         
                         </table>
                     </div>
                </div>			
            </div>
        </div>
       
   
    </div>
</section> <!--/#cart_items-->

@endsection