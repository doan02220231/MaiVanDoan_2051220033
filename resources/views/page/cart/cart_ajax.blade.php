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
            <ol class="breadcrumb" style="margin-bottom: 30px;">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {!!session()->get('message')!!}
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger">
            {!!session()->get('error')!!}
            </div>
        @endif
        <div class="table-responsive cart_info">
          
            <form action="{{url('/update-cart')}}" method="POST">
                @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="description">Số lượng còn</td>
                        <td class="price">Giá sản phẩm</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
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
                            <td class="cart_description">
                                <h4><a href=""></a></h4>
                                <p>{{$cart['product_quantity']}} SP</p>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($cart['product_price'],0,',','.')}}VNĐ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                        <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" >
                                    
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($suptotal,0,',','.')}}VNĐ</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out" ></td>
                        <td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả sản phẩm</a></td>
                        <td>
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
                            
                        </td>
                      
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
                                            <p><li>Tiền sau khi giảm: {{number_format($total-$total_coupon,0,',','.')}} VNĐ</li></p>
                                        @elseif ($cou['coupon_condition'] == 2)
                                            Mã giảm: {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
                                            <p>
                                                @php
                                                    $total_coupon = $total - $cou['coupon_number'];
                                                @endphp
                                            </p>
                                            <p><li> Tiền sau khi giảm:{{number_format($total_coupon,0,',','.')}} VNĐ</li></p>
                                        @endif
                                    @endforeach 
                                </li>
                            @endif
                            {{-- <li>Thuế <span></span></li>
                            <li>Phí vận chuyển <span>Free</span></li>
                            <li>thành tiền <span></span></li> --}}
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
            @if(Session::get('cart'))
            <tr>
                <td >
                <form method="POST" action="{{url('/check-coupon')}}">
                    @csrf
                    <input type="text" class="form-control" name="coupon" placeholder="nhập mã giảm giá"><br>
                    <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                </form></td>
            </tr>
            @endif
            
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
{{-- <section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>Thanh toán </h3>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng tiền <span>{{number_format($total,0,',','.')}}VNĐ</span></li>
                        <li>Thuế <span></span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>thành tiền <span></span></li>
                    </ul>
                       
                        <a class="btn btn-default check_out" href="">Thanh toán</a>
                        <a class="btn btn-default check_out" href="">Tính mã giảm giá</a>
                        
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action--> --}}

@endsection