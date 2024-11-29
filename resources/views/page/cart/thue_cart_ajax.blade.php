@extends('show_layout_thue')
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

        @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <div class="table-responsive cart_info">
          
            <form action="{{url('/update-qty-thue')}}" method="POST">
                @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        
                        <td   class="description " >Tên Cún</td>
                        <td class="image">Hình ảnh</td>
                        <td class="description">Màu sắc</td>
                        <td class="description">Giới tính</td>
                        <td class="price">Giá sản phẩm</td>
                        <td class="price">Số tuần thuê</td>
                      
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>


                </thead>
                <tbody>

                    @if(Session::get('cart_thue') == true)
                    @php
                        $totals = 0;  
                    @endphp
                  
                    @foreach (Session::get('cart_thue') as $key => $cart_thue)
                        @php
                            $suptotal = $cart_thue['pet_price'] * ($cart_thue['pet_qty'] * 7);
                             $discount = 0;
                             $discountMessage = '';
                             if ($cart_thue['pet_qty'] >= 4) {
                                    $discount = 0.20; // 20% discount for quantity 4 or more
                                    $discountMessage = 'Bạn đã được giảm 20% theo combo';
                                } elseif ($cart_thue['pet_qty'] == 3) {
                                    $discount = 0.15; // 15% discount for quantity 3
                                    $discountMessage = 'Bạn đã được giảm 15% theo combo';
                                } elseif ($cart_thue['pet_qty'] == 2) {
                                    $discount = 0.10; // 10% discount for quantity 2
                                    $discountMessage = 'Bạn đã được giảm 10% theo combo';
                                }
                                 elseif ($cart_thue['pet_qty'] == 10) {
                                    $discount = 0.25; // 25% discount for quantity 2
                                    $discountMessage = 'Bạn đã được giảm 25% theo combo';
                                }
                                elseif ($cart_thue['pet_qty'] == 15) {
                                    $discount = 0.30; // 30% discount for quantity 2
                                    $discountMessage = 'Bạn đã được giảm 30% theo combo';
                                } 
                                else {
                                    $discount = 0.05;
                                    $discountMessage = 'Bạn đã được giảm 5% theo combo';
                                }
                           
                                $totals = $suptotal - ($suptotal * $discount);
                        @endphp
                        <tr>
                            
                            <td class="cart_description">
                                <h4><a href=""></a></h4>
                                <h3 style="margin-left: 20px"><p>{{$cart_thue['pet_name']}}</p></h3>
                            </td>
                            <td class="cart_product">
                                <a href=""><img src="{{asset('public/uploads/product/'.$cart_thue['pet_image'])}}" width="90" alt="{{$cart_thue['pet_name']}}"></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href=""></a></h4>
                                <p>{{$cart_thue['pet_slug']}}</p>
                            </td>
                            <td class="cart_description">
                                <h4><a href=""></a></h4>
                                <p>{{$cart_thue['pet_gender']}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($cart_thue['pet_price'],0,',','.')}}VNĐ</p>
                            </td>
                       <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                        <input class="cart_quantity_thue" type="number" min="1" name="cart_qty_thue[{{$cart_thue['session_id_thue']}}]" value="{{$cart_thue['pet_qty']}}" >
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($suptotal,0,',','.')}}VNĐ</p>
                            </td>

                            
                            <td class="cart_delete">
                               <a class="" href="{{url('/delete-thue/'.$cart_thue['session_id_thue'])}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                      
                       
                    @endforeach
                    @php
                        $combo = 0;
                        $total = $totals;
                    @endphp
                         @if (Session::has('cart_combo') && is_array(Session::get('cart_combo')))
                        @foreach (Session::get('cart_combo') as $key => $cart_combo)
                            @php
                                $comsup = $cart_combo['combo_gia'] ?? 0; // Đảm bảo $comsup là 0 nếu combo_gia không được đặt
                                $combo += $comsup;
                                $total = Session::get('cart_combo') ? $totals + $combo : $totals;
                            @endphp

                            <tr>
                                <td class="cart_description">
                                    <h4><a href=""></a></h4>
                                    <h3 style="margin-left: 20px"><p>{{ $cart_combo['combo_name'] }}</p></h3>
                                </td>
                                <td class="cart_product">
                                    <a href=""><img src="{{ asset('public/uploads/product/'.$cart_combo['combo_image']) }}" width="120" height="100" alt="{{ $cart_combo['combo_name'] }}"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""></a></h4>
                                    <p></p>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""></a></h4>
                                    <p></p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($cart_combo['combo_gia'], 0, ',', '.') }} VNĐ</p>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""></a></h4>
                                    <p></p>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">{{ number_format($cart_combo['combo_gia'], 0, ',', '.') }} VNĐ</p>
                                </td>
                                <td class="cart_quantity">
                                <td class="cart_delete">
                                    <a class="" href="{{ url('/delete-combo/'.$cart_combo['session_id_combo']) }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        
                    @endif

                    <tr>
                        <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty_thue" class="btn btn-default check_out" ></td>
                      <td><a class="btn btn-default check_out" href="{{url('/del-pet')}}">Xóa để có thể thuê pet mới</a></td>
                        <td>
                            <?php 
									$customer_id = Session::get('customer_id');
									if($customer_id != NULL){
								?>
									<a class="btn btn-default check_out" href="{{URL::to('/checkout-thue')}}">Đặt hàng</a>
                        
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
                            <li>{{ $discountMessage }}</li>

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
            @if(Session::get('cart_thue'))
            <tr>
                <td >
                <form method="POST" action="{{url('/check-coupon-thue')}}">
                    @csrf
                    <input type="text" class="form-control" name="coupon" placeholder="nhập mã giảm giá"><br>
                    <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">

                </form>

                
            </td>
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