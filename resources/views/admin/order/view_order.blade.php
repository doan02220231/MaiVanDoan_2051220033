@extends('admin_layout')
@section('admin_content')
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
           
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
             <td>{{$shipping->shipping_phone}}</td>
             <td>{{$shipping->shipping_email}}</td>
             <td>{{$shipping->shipping_nodes}}</td>
             <td>@if($shipping->shipping_method==0) 
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
      Liệt kê chi tiết đơn hàng
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
            <th>  </th>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho</th>
            <th>Mã giảm giá</th>
            <th>Phí ship</th>
            <th>Số lượng mua</th>
            <th>Giá SP</th>
            <th>Giá gốc</th>
            <th>Tổng tiền từng SP</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          @php 
          $i = 0;
          $total = 0;
          @endphp

          @foreach ($order_details as $key => $details)
          @php 
          $i++;
          $subtotal = $details->product_price*$details->product_sales_quantity;
          $total += $subtotal;
          @endphp
          <tr class="color_qty_{{$details->product_id}}">
            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product->product_quantity}}</td>
            <td>@if($details->product_coupon!='no')
                  {{$details->product_coupon}}
                @else 
                  Không có mã giảm giá
                @endif
            </td>
            <td>{{number_format($details->product_feeshipp,0,',','.')}} VNĐ</td>
            <td>
              <input type="number" min="1" {{$order_status == 2 || $order_status == 4 ? 'disabled' : ''}}  class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity" style="width: 40px;">
              
              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">

              <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
              
              <input type="hidden" name="order_prodcut_id" class="order_prodcut_id" value="{{$details->product_id}}">
              @if ($order_status != 2 && $order_status != 4)
                <button class="btn btn-default update_quantity_order" data-product_id="{{$details->product_id}}" 
                  name="update_quantity_order">Cập nhật</button>
              @endif
              
            </td>
            <td>{{number_format($details->product_price ,0,',','.')}} VNĐ</td>
            <td>{{number_format($details->product->price_cost ,0,',','.')}} VNĐ</td>
            <td>{{number_format($subtotal,0,',','.')}} VNĐ</td>
          </tr>
          
          @endforeach
          <tr>
            
            <td colspan="12">
              Tổng tiền: {{number_format($total,0,',','.')}} VNĐ </br>
              @php
                  $total_coupon =0;
              @endphp
              @if ($coupon_condition == 1)
                @php
                    $total_after_coupon = ($total * $coupon_number)/100;
                    echo 'Tổng % giảm : - '.number_format($total_after_coupon,0,',','.').'VNĐ'.'</br>';
                    $total_coupon = $total - $total_after_coupon + $details->product_feeshipp;
                @endphp
                
              @else
                @php
                  echo 'Tổng giảm : - '.number_format($coupon_number,0,',','.').'VNĐ'.'</br>';
                  $total_coupon = $total - $coupon_number + $details->product_feeshipp;
                @endphp
              @endif
              Phí ship: + {{number_format($details->product_feeshipp,0,',','.')}} VNĐ</br>
              Thành tiền: {{number_format($total_coupon,0,',','.')}} VNĐ
            </td>
          </tr>
          <tr>
            <td colspan="12">
              @foreach($order as $key => $or)
                @if($or->order_status==1)
                <form>
                   @csrf
                  <select class="form-control order_details" id="{{$or->order_id}}">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option selected value="1">Chưa xử lý</option>
                    <option value="2">Đã xử lý - Đang giao hàng</option>
                  </select>
                </form>
                @else
                <form>
                  @csrf
                  <select class="form-control order_details" id="{{$or->order_id}}">
                   <option value="">----Chọn hình thức đơn hàng-----</option>
                   <option value="1">Chưa xử lý</option>
                   <option selected value="2">Đang xử lý - đã giao hàng</option>
                 </select>
                </form>

                @endif
                @endforeach
            </td>
          </tr>
        </tbody>
      </table>
      <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
    </div>
   
  </div>
</div>
@endsection