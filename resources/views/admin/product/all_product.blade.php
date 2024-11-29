@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê sản phẩm
      </div>
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
        <table id="myTable" class="table table-striped b-t b-light" >
          <thead>
            <tr>
              {{-- <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th> --}}
              <th>Tên sản phẩm</th>
              <th>Thư viện ảnh</th>
              <th>SL sản phẩm</th>
              <th>Giá gốc</th>
              <th>Giá bán</th>
              <th>Image</th>
              <th>Danh mục</th>
              <th>Thương hiệu</th>
              <th>Hiển thị</th>

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_product as $key => $pro)
            <tr>
                {{-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> --}}
                <td>{{ $pro -> product_name}}</td>
                <td ><a href="{{url('/add-gallery/'.$pro -> product_id)}}">Thêm TV ảnh</a></td>
                <td>{{ $pro -> product_quantity}}</td>
                <td>{{number_format($pro -> price_cost,0,',','.')}}VNĐ</td>
                <td>{{number_format($pro -> product_price,0,',','.')}}VNĐ</td>
                
                <td><img src="public/uploads/product/{{ $pro -> product_image}}" height="100" width="100"></td>
                <td>{{ $pro -> category_name}}</td>
                <td>{{ $pro -> brand_name}}</td>
                
                <td>
                  <span class="text-ellipsis">
                    <?php
                        if($pro -> product_status == 0){
                    ?>
                        <a href="{{URL::to('/unactive-product/'.$pro -> product_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-o-up"></span></a>
                    <?php
                        }else {
                    ?>
                        <a  href="{{URL::to('/active-product/'.$pro -> product_id)}}"> <span class="fa fa-thumbs-o-down"></span></a>
                    <?php
                        }
                    ?>
                  </span>
                </td>

                <td>
                    <a href="{{URL::to('/edit-product/'.$pro -> product_id)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-pencil-square-o text-success text-active"></i>
                    </a>
                    <a onclick="return confirm('Bạn có chắc chắn xóa sản phẩm nầy không?')" href="{{URL::to('/delete-product/'.$pro -> product_id)}}" class="active styling-edit" ui-toggle-class="">
                      <i class="fa fa-times text-danger text"></i>
                    </a>
                </td>
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