@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê banner
      </div>
      <div class="row w3-res-tb">
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
              <th style="width:20px;">
                {{-- <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label> --}}
              </th>
              <th>Tên banner</th>
              <th>Hình ảnh</th>
              <th>Mô tả</th>
              <th>Hiển thị(ẩn)</th>

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_slider as $key => $slide)
            <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{ $slide -> slider_name}}</td>
                <td><img src="public/uploads/banner/{{ $slide -> slider_image}}"height="80" width="150"></td>
                <td>{{ $slide -> slider_desc}}</td>
                <td><span class="text-ellipsis">
                    <?php
                        if($slide -> slider_status == 0){
                    ?>
                        <a href="{{URL::to('/unactive-slider/'.$slide -> slider_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-o-up"></span></a>
                    <?php
                        }else {
                    ?>
                        <a  href="{{URL::to('/inctive-slider/'.$slide -> slider_id)}}"> <span class="fa fa-thumbs-o-down"></span></a>
                    <?php
                        }
                    ?>
                </span></td>

                <td>
                    <a href="{{URL::to('/edit-slider/'.$slide -> slider_id)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-pencil-square-o text-success text-active"></i>
                    </a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa slide nầy không?')" href="{{URL::to('/delete-slider/'.$slide -> slider_id)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-times text-danger text"></i>
                    </a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!!$all_slider->links('pagination::bootstrap-4')!!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection