@extends('show_layout_thue')
@section('content')

<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin đăng nhập
    </div>
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin vận chuyển hàng
    </div>
    
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
           
            <td>{{$shipping->shipping_thue_name}}</td>
            <td>{{$shipping->shipping_thue_address}}</td>
             <td>{{$shipping->shipping_thue_phone}}</td>
             <td>{{$shipping->shipping_thue_email}}</td>
             <td>{{$shipping->shipping_thue_nodes}}</td>
             <td>@if($shipping->shipping_thue_method==0) 
                    Chuyển khoản 
                @else
                    Tiền mặt 
                @endif</td>
            
          
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br><br>

<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết Cún cho thuê
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
    
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th> STT </th>
            <th>Tên Cún Yêu</th>
            <th>Màu sắc</th>
            <th>Số tuần thuê</th>
            <th>Mã giảm giá</th>
            <th>Giá thuê một ngày</th>
            <th>Giá gốc tinh theo tuần thuê</th>
            <th>Số tiền được giảm theo combo</th>
            <th>Giá sau giảm theo combo</th>
            <th>Ngày thuê</th>
            <th>Số ngày thuê</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
           @php 
          $i = 0;
          $totals = 0;
          @endphp

          @foreach ($order_details as $key => $details)
              @php 
                  $i++;
                  $suptotal = $details->pet_price * $details->pet_qty * 7;
                  $discount = 0;
                  $discountMessage = '';

                  if ($details->pet_qty >= 4) {
                      $discount = 0.20; // 20% discount for quantity 4 or more
                      $discountMessage = 'Bạn đã được giảm 20% theo combo';
                  } elseif ($details->pet_qty == 3) {
                      $discount = 0.15; // 15% discount for quantity 3
                      $discountMessage = 'Bạn đã được giảm 15% theo combo';
                  } elseif ($details->pet_qty == 2) {
                      $discount = 0.10; // 10% discount for quantity 2
                      $discountMessage = 'Bạn đã được giảm 10% theo combo';
                  } else {
                      $discount = 0.05; // 5% discount for quantity 1
                      $discountMessage = 'Bạn đã được giảm 5% theo combo';
                  }

                  $totals = $suptotal - ($suptotal * $discount);
              @endphp

              <!-- Display or use $total and $discountMessage here as needed -->



          <tr class="color_qty_{{$details->pet_id}}">
            <td><i>{{$i}}</i></td>
            <td>{{$details->pet_name}}</td>
            <td>{{$details->pet_slug}}</td>
            <td>{{$details->pet_qty}}</td>
            <td>@if($details->pet_coupon!='no')
                  {{$details->pet_coupon}}
                @else 
                  Không có mã giảm giá
                @endif
            </td>
            
              
            </td>
            <td>{{number_format($details->pet_price ,0,',','.')}} VNĐ</td>
            <td>{{number_format($suptotal ,0,',','.')}} VNĐ</td>
            <td>{{number_format($suptotal-$totals ,0,',','.')}} VNĐ</td>

            <td>{{number_format($totals ,0,',','.')}} VNĐ</td>
            @foreach ($order as $key => $ord)
                <td>{{ $ord -> created_at}}</td>   
            @endforeach 
            <td> {{$details->pet_qty * 7}} ngày </td>
            
          
          </tr>
          
             @endforeach
             @php
                $combo = 0;
                $total = $totals;
              @endphp
              @foreach ($combo_dele as $key => $comb)
              @php
                                $comsup = $comb->combo_details_gia ?? 0; 
                                $combo += $comsup;
                                $total = $combo ? $totals + $combo : $totals;
                            @endphp
             <tr>
            <td><i>Đi kèm theo combo thuê cún</i></td>
            <td>{{$comb->combo_details_name}}</td>
            <td>Giá :{{number_format($comb->combo_details_gia,0,',','.')}}VNĐ </td>

          </tr>
          @endforeach
                   <tr>
            
            <td colspan="12">
             {{ $discountMessage }}</br>
              Tổng tiền: {{number_format($total,0,',','.')}} VNĐ </br>
              @php
                  $total_coupon =0;
              @endphp
              @if ($coupon_condition == 1)
                @php
                    $total_after_coupon = ($total * $coupon_number)/100  ;
                    echo 'Tổng % giảm : - '.number_format($total_after_coupon,0,',','.').'VNĐ'.'</br>';
                    $total_coupon = $total - $total_after_coupon;
                @endphp
                
              @else
                @php
                  echo 'Tổng giảm : - '.number_format($coupon_number + ($suptotal-$total),0,',','.').'VNĐ'.'</br>';
                  $total_coupon = $total - $coupon_number ;
                @endphp
              @endif
              
              Thành tiền: {{number_format($total_coupon,0,',','.')}} VNĐ
            </td>
        
            
           <tr>
            <td style="font-weight: 1000; text-align: center;" >Kiểm tra đơn duyệt </td>
            <td colspan="12">

              @foreach($pet_show as $key => $or)
                @if($or->pet_status==0)
                <form>
                   @csrf
                  <select class="form-control pet_thue_trang_thai" id="{{$or->pet_id}}" disabled>
                    <option selected value="0">Chưa xử lý-chưa có chủ</option>
                    <option value="1">thuê thành công</option>
                  </select>
                </form>
                @else
                <form>
                  @csrf
                  <select class="form-control pet_thue_trang_thai" id="{{$or->pet_id}}" disabled>
                   <option  value="0">Chưa xử lý-chưa có chủ</option>
                    <option selected value="1">thuê thành công</option>
                 </select>
                </form>
                @endif
                @endforeach
            </td>
          </tr>
          <tr>
            <td style="font-weight: 1000; text-align: center;" > Chọn phản hồi khi nuôi pet </td>
            <td colspan="12">

              @foreach($order as $key => $mua)
                @if($mua->order_thue_status==1)
                <form>
                   @csrf
                  <select class="form-control pet_thue_mua_ban" idd="{{$mua->order_thue_id}}" >
                    <option selected value="1">Yêu thích</option>
                    <option  value="2">Không thích</option>
                    <option value="3">Muốn mua</option>
                  </select>
                </form>
                @elseif($mua->order_thue_status==2)
                <form>
                  @csrf
                  <select class="form-control pet_thue_mua_ban" idd="{{$mua->order_thue_id}}">
                  <option  value="1">Yêu thích</option>
                  <option selected value="2">Không thích</option>
                  <option value="3">Muốn mua</option>
                 </select>
                </form>
                @else
                <form>
                  @csrf
                  <select class="form-control pet_thue_mua_ban" idd="{{$mua->order_thue_id}}">
                  <option  value="1">Yêu thích</option>
                  <option value="2">Không thích</option>
                  <option selected value="3">Muốn mua</option>
                 </select>
                </form>
                @endif
                @endforeach
            </td>
          </tr>
          <tr>
               <td style="font-weight: 1000; text-align: center;" > Tình trạng pet hiện tại </td>
               <td colspan="12">

              @foreach($order as $key => $khoe)
                @if($khoe->order_thue_suc_khoe==1)
                <form>
                   @csrf
                  <select class="form-control pet_thue_suc_khoe" idd_s="{{$khoe->order_thue_id}}">
                    <option selected value="1">Bệnh nặng</option>
                    <option  value="2">Bệnh nhẹ</option>
                    <option value="3">Khoẻ mạnh</option>
                  </select>
                </form>
                @elseif($khoe->order_thue_status==2)
                <form>
                  @csrf
                  <select class="form-control pet_thue_suc_khoe" idd_s="{{$khoe->order_thue_id}}">
                    <option  value="1">Bệnh nặng</option>
                    <option selected value="2">Bệnh nhẹ</option>
                    <option value="3">Khoẻ mạnh</option>
                 </select>
                </form>
                @else
                <form>
                  @csrf
                  <select class="form-control pet_thue_suc_khoe" idd_s="{{$khoe->order_thue_id}}">
                   <option  value="1">Bệnh nặng</option>
                    <option  value="2">Bệnh nhẹ</option>
                    <option selected value="3">Khoẻ mạnh</option>
                 </select>
                </form>
                @endif
                @endforeach
            </td>
          </tr>

          
        </tbody>
      </table>
    
    </div>
   
  </div>
</div>
@endsection


