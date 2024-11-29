@extends('show_layout_thue')
@section('content')
 <div class="table-agile-info">
    <div class="panel panel-default">
      <div  class="panel-heading">
        <span style="font-weight: bold; font-size: 20px;">Chi tiết pet cho thuê</span>
      </div>
      <div class="row w3-res-tb">
      </div>
      <div class="table-responsive">
        
        <table class="table table-striped b-t b-light" id="myTable">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class = "text-alert">',$message.'</span>';
                Session::put('message',null);
            }
        ?>
          <thead>
            <tr>
              
              <th></th> 
              <th>Mã đơn hàng</th> 
              <th>Ngày tháng thuê</th>
              <th>Tình trạng sức khoẻ</th>
              <th>Tình cảm với thú cưng</th>
              <th>Xem chi tiết</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $i =0;
            @endphp
            @foreach ($order as $key => $ord)
            @php
                
            @endphp
            <tr>
                <td><i>Vui lòng cập nhật tình trạng </i></td>
                <td>{{ $ord -> order_thue_code}}</td>
                <td>{{ $ord -> created_at}}</td>
              <td >

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
            <td >

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
          
                <td>
                    <a href="{{URL::to('/view-history-order-thue/'.$ord -> order_thue_code)}}" class="active styling-edit" ui-toggle-class="">
                      <i >Xem pet thuê</i>
                    </a>
                    {{-- <a onclick="return confirm('Bạn có chắc chắn xóa thương nầy không?')" href="{{URL::to('/delete-order/'.$ord -> order_code)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-times text-danger text"></i>
                    </a> --}}
                </td>
            </tr>
            @endforeach
            
            <thead>
               <style>
    table {
      width: 50%;
      border-collapse: collapse;
      margin: 20px auto;
    }
    th, td {
      border: 1px solid #ccc;
      text-align: center;
      padding: 8px;
    }
    th {
      background-color: #f4f4f4;
    }
    .like-btn, .dislike-btn {
      padding: 5px 10px;
      cursor: pointer;
      border: none;
      color: white;
      border-radius: 5px;
    }
    .like-btn {
      background-color: #4CAF50;
    }
    .dislike-btn {
      background-color: #f44336;
    }
    .like-btn:hover, .dislike-btn:hover {
      opacity: 0.9;
    }
  </style>
        <h2 style="text-align: center;">Khách hàng đánh giá tình trạng thuê pet theo tuần</h2>
        @foreach($order as $key => $moi)
  <table>

    <thead>
        <tr>
            <th>Thứ tự các ngày trong tuần</th>
            <th>Đánh giá</th>
        </tr>
    </thead>
    <tbody id="feedbackTable" >
        <!-- Dữ liệu sẽ được tạo động bằng JavaScript -->

    </tbody>

</table>
@endforeach
<div style="text-align: center;" >
<p><b>Mức độ trung bình yêu thích pet:</b> 
    <ul id="averageStars" style="display: inline-block; padding: 0; list-style-type: none;"></ul>
    (<span id="averageRating">Chưa có đánh giá</span>)
</p>
</div>
      </div>
      {{-- <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm"></small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!!$order->links('pagination::bootstrap-4')!!}
            </ul>
          </div>
        </div>
      </footer> --}}
    </div>
  </div> 
@endsection