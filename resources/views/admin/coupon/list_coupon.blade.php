@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê mã giảm giá
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          {{-- <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>  --}}
         
          
        </div>
        <div class="col-sm-4">
         
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        
        <table class="table table-striped b-t b-light">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class = "text-alert">',$message.'</span>';
                Session::put('message',null);
            }
        ?>
          <thead>
            <tr>
             
              <th>Tên mã </th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
              <th>Mã</th>
              <th>Số lượng</th>
              <th>Điều kiện</th>
              <th>Số giảm</th>
              <th>Tình trạng</th>
              <th>Hết hạn</th>
              <th>Quản lý</th>
              <th>Gửi mã</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($coupon as $key => $cou   )
            <tr>
                
                <td>{{ $cou -> coupon_name}}</td>
                <td>{{ $cou -> coupon_date_start}}</td>
                <td>{{ $cou -> coupon_date_end}}</td>
                <td>{{ $cou -> coupon_code}}</td>
                <td>{{ $cou -> coupon_times}}</td>
                <td><span class="text-ellipsis">
                    <?php
                        if($cou -> coupon_condition == 1){
                    ?>
                       Giảm %
                    <?php
                        }else {
                    ?>
                        Giảm tiền
                    <?php
                        }
                    ?>
                </span></td>
                <td><span class="text-ellipsis">
                    <?php
                        if($cou -> coupon_condition == 1){
                    ?>
                       Giảm {{$cou -> coupon_number}} %
                    <?php
                        }else {
                    ?>
                        Giảm {{number_format($cou -> coupon_number)}} VNĐ
                    <?php
                        }
                    ?>
                </span></td>    
                <td><span class="text-ellipsis">
                  <?php
                      if($cou -> coupon_status == 1){
                  ?>
                     <span style="color: green">Đang kích hoạt</span> 
                  <?php
                      }else {
                  ?>
                      <span style="color: red">Đã khoá</span>
                  <?php
                      }
                  ?>
                </span></td>
                <td>
                  @if ($cou -> coupon_date_end >= $today)
                    <span style="color: green">Còn hạn</span> 
                  @else
                    <span style="color: red">Đã Hết hạn</span>
                  @endif
                    
                 
                </td>
                <td>
                  <a href="{{URL::to('/edit-coupon/'.$cou -> coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                  </a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa thương nầy không?')" href="{{URL::to('/delete-coupon/'.$cou -> coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-times text-danger text"></i>
                    </a>
                </td>
                <td>
                    {{-- <p><a href="{{url('/send-coupon-vip',['coupon_code'=>$cou->coupon_code])}} "class="btn btn-primary" style="margin: 5 0;">khách vip</a></p> --}}
                      
                    <p><a href="{{url('/send-coupon',['coupon_code'=>$cou->coupon_code])}} "class="btn btn-default">khách hàng</a></p>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm"></small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!!$coupon->links('pagination::bootstrap-4')!!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection