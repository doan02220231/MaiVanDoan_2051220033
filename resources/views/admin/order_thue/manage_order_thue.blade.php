@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê Đơn hàng cho thuê pet
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
              
              <th>Thứ tự</th>
              <th>Mã đơn hàng</th>
              <th>Ngày tháng đặt hàng</th>
              
              <th>Tình trạng chủ sở hữu</th>
              <th>Tình trạng sức khoẻ</th>
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
                $i++;
            @endphp
            <tr>
                <td><i>{{$i}}</i></td>
                <td>{{ $ord -> order_thue_code}}</td>
                <td>{{ $ord -> created_at}}</td>
                

               <td>
                @if($ord->order_thue_suc_khoe == 1)
                  Pet đang bệnh nặng

                 @elseif ($ord->order_thue_suc_khoe == 2)
                  Pet đang bệnh nhẹ
                  @else
                  Pet đang khoẻ mạnh
                @endif
                </td>

                <td>
                    @if($ord->order_thue_status == 1)
                       Yêu thích pet
                   @elseif ($ord->order_thue_status == 2) 
                        Không thích pet
                        @else
                         Muốn mua pet
                    @endif
                </td>
                <td>
                    <a href="{{URL::to('/view-order-thue/'.$ord -> order_thue_code)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-eye text-success text-active"></i>
                    </a>
                    @foreach ($pet_show as $key => $tru)
                <td>@if ($tru -> pet_status == 0)
                       
                    @else
                        
                    @endif
                </td>
                @endforeach
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