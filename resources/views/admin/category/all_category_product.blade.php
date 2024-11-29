@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt danh mục sản phẩm
      </div>
      <div class="row w3-res-tb">
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
              <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th>
              <th>Tên danh mục</th>
              {{-- <th>Thuộc danh mục</th> --}}
              <th>Từ khóa danh mục</th>
              <th>Hiển thị</th>

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_category_product as $key => $cate_pro)
            <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{ $cate_pro -> category_name}}</td>
                <td>
                  @if ($cate_pro -> category_parent == 0)
                    <span style="color: red">- Danh mục cha -</span>
                  @else
                    @foreach ($category_product as $key => $cate_sub_pro)
                      @if ( $cate_sub_pro -> category_id == $cate_pro->category_parent)
                        <span style="color: rgb(24, 136, 159)">-- {{$cate_sub_pro -> category_name}} -- </span>
                      @endif
                      
                    @endforeach
                    
                  @endif
                </td>
                <td>{{ $cate_pro -> meta_keywords}}</td>
                <td><span class="text-ellipsis">
                    <?php
                        if($cate_pro -> category_status == 0){
                    ?>
                        <a href="{{URL::to('/unactive-category-product/'.$cate_pro -> category_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-o-up"></span></a>
                    <?php
                        }else {
                    ?>
                        <a  href="{{URL::to('/active-category-product/'.$cate_pro -> category_id)}}"> <span class="fa fa-thumbs-o-down"></span></a>
                    <?php
                        }
                    ?>
                </span></td>

                <td>
                    <a href="{{URL::to('/edit-category-product/'.$cate_pro -> category_id)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-pencil-square-o text-success text-active"></i>
                    </a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa danh mục nầy không?')" href="{{URL::to('/delete-category-product/'.$cate_pro -> category_id)}}" class="active styling-edit" ui-toggle-class="">
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
              {!!$all_category_product->links('pagination::bootstrap-4')!!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection