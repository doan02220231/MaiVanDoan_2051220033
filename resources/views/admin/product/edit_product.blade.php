@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class = "text-alert">',$message.'</span>';
                            Session::put('message',null);
                        }
                    ?>
                <div class="panel-body">
                    
                    <div class="position-center">
                        @foreach ($edit_product as $key => $pro)
                        
                        <form role="form" action="{{URL::to('/update-product/'.$pro -> product_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputDM">Tên sản phẩm</label>
                                <input type="text" name="product_name" onkeyup="ChangeToSlug();" data-validation="length"  data-validation-length="min10" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự" class="form-control" id="slug" value="{{$pro -> product_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDM">Số lượng sản phẩm</label>
                                <input type="text" name="product_quantity" data-validation="number" data-validation-error-msg="làm ơn điền số lượng"
                                 class="form-control" id="exampleInputDM"  value="{{$pro -> product_quantity}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" name="product_slug" class="form-control" id="convert_slug" value="{{$pro->product_slug}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDM">Giá sản phẩm</label>
                                <input type="text" name="product_price" data-validation="length" data-validation-length="min4" data-validation-error-msg="làm ơn điền số tiền" class="form-control price_format" id="exampleInputDM" value="{{$pro -> product_price}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDM">Giá gốc sản phẩm</label>
                                <input type="text" name="price_cost" data-validation="length" data-validation-length="min4" data-validation-error-msg="làm ơn điền số tiền" class="form-control price_format" id="exampleInputDM" value="{{$pro -> price_cost}}" placeholder="giá sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDM">Image sản phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputDM" >
                                <img src="{{URL::to('public/uploads/product/'.$pro ->product_image)}}" height="100" width="100">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputdesc">Mô tả sản phẩm</label>
                                <textarea style="resize: none" rows="4" class="form-control" name="product_desc" 
                                id="ckeditor2" >{{$pro -> product_desc}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputdesc">Nội dung sản phẩm</label>
                                <textarea style="resize: none" rows="4" class="form-control" name="product_content" 
                                id="ckeditor3" >{{$pro -> product_content}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputdesc">Danh mục sản phẩm</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    @foreach ($cate_product as $key => $cate)
                                            @if ($cate ->category_parent == 0)
                                                <option {{$cate ->category_id == $pro ->category_id ? 'selected':''}} value="{{$cate -> category_id}}">
                                                    {{$cate -> category_name}}</option>
                                            @endif
                                            @foreach ($cate_product as $key => $cate_2)
                                                @if ($cate_2 ->category_parent == $cate ->category_id)
                                                    <option {{$cate_2 ->category_id == $pro ->category_id ? 'selected':''}} value="{{$cate_2 -> category_id}}">
                                                        -- {{$cate_2 -> category_name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                       
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDM">Tags sản phẩm</label>
                                <input type="text" data-role="tagsinput" value="{{$pro->product_tags}}" name="product_tags"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputdesc">Thương hiệu sản phẩm</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach ($brand_product as $key => $brand)
                                        @if($cate -> category_id == $pro -> category_id)
                                            <option selected value="{{$brand -> brand_id}}">{{$brand -> brand_name}}</option>
                                        @else
                                            <option value="{{$brand -> brand_id}}">{{$brand -> brand_name}}</option>
                                        @endif   
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            
                            <button type="submit" name="add_product" class="btn btn-info">cập nhật sản phẩm</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection