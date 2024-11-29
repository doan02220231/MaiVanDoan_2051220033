@extends('layout')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center; color: black; font-size: 20px;" >
        Lịch sữ mua hàng của khách hàng
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
              
              <th>Thứ tự</th>
              <th>Mã đơn hàng</th>
              <th>Ngày tháng đặt hàng</th>
              <th>Tình trạng đơn hàng</th>
              <th>Xem chi tiết </th>

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $i =0;
            @endphp
            @foreach ($getorder as $key => $ord)
            @php
                $i++;
            @endphp
            <tr>
                <td><i>{{$i}}</i></td>
                <td>{{ $ord -> order_code}}</td>
                <td>{{ $ord -> created_at}}</td>
                <td>@if ($ord -> order_status == 1)
                        Chưa được kiểm duyệt
                    @else
                        Đã được duyệt
                    @endif
                </td>
                

                <td>
                    <a href="{{URL::to('/view-history-order/'.$ord -> order_code)}}" >
                      <i >xem đơn hàng</i>
                    </a>
                    {{-- <a onclick="return confirm('Bạn có chắc chắn xóa thương nầy không?')" href="{{URL::to('/delete-order/'.$ord -> order_code)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-times text-danger text"></i>
                    </a> --}}
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
              
            </ul>
          </div>
        </div>
      </footer> 
    </div>
  </div>
@endsection