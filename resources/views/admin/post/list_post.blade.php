@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê bài viết
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
              {{-- <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th> --}}
              <th>Tên bài viết</th>
              <th>Image</th>
              <th>slug</th>
              <th>Mô tả bài viết</th>
              <th>Từ khoá bài viết</th>
              <th>Danh mục bài viết</th>
              <th>Hiển thị</th>

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_post as $key => $a_post)
            <tr>
                {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
                <td>{{ $a_post -> post_title}}</td>
                <td><img src="public/uploads/post/{{ $a_post -> post_image}}" height="100" width="100"></td>
                <td>{{ $a_post -> post_slug}}</td>
                <td>{!! $a_post -> post_meta_desc!!}</td>
                <td>{{ $a_post -> post_meta_keywords}}</td>
                <td>{{ $a_post -> cate_post -> category_post_name}}</td>
                <td><span class="text-ellipsis">
                    <?php
                        if($a_post -> post_status == 0){
                    ?>
                        <a href="{{URL::to('/unactive-post/'.$a_post -> post_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-o-up"></span></a>
                    <?php
                        }else {
                    ?>
                        <a  href="{{URL::to('/active-post/'.$a_post -> post_id)}}"> <span class="fa fa-thumbs-o-down"></span></a>
                    <?php
                        }
                    ?>
                </span></td>

                <td>
                    <a href="{{URL::to('/edit-post/'.$a_post -> post_id)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-pencil-square-o text-success text-active"></i>
                    </a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa bài viết nầy không?')" href="{{URL::to('/delete-post/'.$a_post -> post_id)}}" class="active styling-edit" ui-toggle-class="">
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
            <small class="text-muted inline m-t-sm m-b-sm"></small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!!$all_post->links('pagination::bootstrap-4')!!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection