@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê danh mục bài viết
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
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th>
              <th>Tên danh mục bài viết</th>
              <th>Slug</th>
              <th>Hiển thị</th>

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($category_post as $key => $cate_post)
            <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{ $cate_post -> category_post_name}}</td>
                <td>{{ $cate_post -> category_post_slug}}</td>
                <td>
                    <span class="text-ellipsis">
                        <?php
                            if($cate_post -> category_post_status == 0){
                        ?>
                            <a href="{{URL::to('/unactive-category-post/'.$cate_post -> category_post_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-o-up"></span></a>
                        <?php
                            }else {
                        ?>
                            <a  href="{{URL::to('/active-category-post/'.$cate_post -> category_post_id)}}"> <span class="fa fa-thumbs-o-down"></span></a>
                        <?php
                            }
                        ?>
                    </span>
                </td>

                <td>
                    <a href="{{URL::to('/edit-category-post/'.$cate_post -> category_post_id)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-pencil-square-o text-success text-active"></i>
                    </a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa bài viết nầy không?')" href="{{URL::to('/delete-category-post/'.$cate_post -> category_post_id)}}" class="active styling-edit" ui-toggle-class="">
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
              {!!$category_post->links('pagination::bootstrap-4')!!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection