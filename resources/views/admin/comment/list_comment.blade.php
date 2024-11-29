@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê bình luận
      </div>
      <div id="notify_comment"></div>
      <div class="row w3-res-tb">
      </div>
      <div class="table-responsive" >
        <?php
          $message = Session::get('message');
          if ($message) {
              echo '<span class = "text-alert">',$message.'</span>';
              Session::put('message',null);
          }
        ?>
        {{-- id="myTable" --}}
        <table  class="table table-striped b-t b-light" >
          <thead>
            <tr>
             
              <th>Duyệt</th>
              <th>Tên người gửi</th>
              <th>Bình luận</th>
              <th>Ngày gửi</th>
              <th>Sản phẩm</th>
              {{-- <th>Quản lý</th> --}}
             

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($comment as $key => $com)
            <tr>
              
                <td>
                    @if ( $com -> comment_status == 1)
                        <input type="button" data-comment_status="0" data-comment_id="{{$com ->comment_id}}" id="{{$com->comment_product_id}}" class="btn btn-primary btn-xs comment_status_btn" value="Duyệt">
                    @else
                        <input type="button" data-comment_status="1" data-comment_id="{{$com ->comment_id}}" id="{{$com->comment_product_id}}" class="btn btn-danger btn-xs comment_status_btn" value="Bỏ duyệt">
                    @endif
                </td>
                <td>{{ $com -> comment_name}}</td>
                <td>{{ $com -> comment}}
                  <style>
                    ul.list_rep li{
                      list-style-type: none;
                      color: blue;
                      margin: 5px 30px;
                    }
                  </style>
                  <ul class="list_rep">
                    Trả lời:
                    @foreach ($comment_rep as $key => $comm_reply)
                    
                      @if ($comm_reply->comment_parent_comment == $com->comment_id )
                        <li>{{$comm_reply->comment_name}}: {{$comm_reply->comment}}</li>
                      @else
                            
                      @endif
                     
                    @endforeach
                    
                  </ul>
                    @if ( $com -> comment_status == 0)
                      <textarea class="form-control reply_comment_{{$com ->comment_id}}" name="" id="" cols="20" rows="2"></textarea><br>
                      <button class="btn btn-default btn-xs btn-reply-comment" data-product_id="{{$com->comment_product_id}}" data-comment_id="{{$com ->comment_id}}" >Trả lời bình luận</button>
                    @endif
               
                
                </td>
                <td>{{ $com -> comment_date}}</td>
                <td><a href="{{url('/chi-tiet-san-pham/'.$com ->product-> product_slug)}}" target="_blank">{{ $com ->product-> product_name}}</a></td>
                {{-- <td>
                    <a href="" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-pencil-square-o text-success text-active"></i>
                    </a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa bình luận nầy không?')" href="" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-times text-danger text"></i>
                    </a>
                </td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm"></small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!!$all_product->links('pagination::bootstrap-4')!!}
            </ul>
          </div>
        </div>
      </footer> --}}
    </div>
  </div>
@endsection