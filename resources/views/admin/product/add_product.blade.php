@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputDM">Tên sản phẩm</label>
                            <input type="text" data-validation="length"  data-validation-length="min10" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự"
                            name="product_name" onkeyup="ChangeToSlug();" class="form-control" id="slug" placeholder="tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Số lượng sản phẩm</label>
                            <input type="text" name="product_quantity" data-validation="number" data-validation-error-msg="làm ơn điền số lượng"
                             class="form-control" id="slug" placeholder="SL sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="product_slug" class="form-control" id="convert_slug" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Giá sản phẩm</label>
                            <input type="text" name="product_price" data-validation="length" data-validation-length="min4" data-validation-error-msg="làm ơn điền số tiền"
                             class="form-control price_format" id="exampleInputDM" placeholder="giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Giá gốc sản phẩm</label>
                            <input type="text" name="price_cost" data-validation="length" data-validation-length="min4" data-validation-error-msg="làm ơn điền số tiền"
                             class="form-control price_format" id="exampleInputDM" placeholder="giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Image sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputDM" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Thư viện ảnh gallery</label>
                                <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                                <span id="error_gallery"></span>
                        </div>
                       

                        <div class="form-group">
                            <label for="exampleInputdesc">Mô tả sản phẩm</label>
                            <textarea style="resize: none"  rows="4" class="form-control" name="product_desc" 
                            id="ckeditor1" placeholder="Mô tả sản phẩm"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputdesc">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="product_content" 
                            id="ckeditor" placeholder="Nội dung sản phẩm"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputdesc">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach ($cate_product as $key => $cate)
                                @if ($cate ->category_parent == 0)
                                    <option value="{{$cate -> category_id}}">{{$cate -> category_name}}</option>
                                @endif
                                @foreach ($cate_product as $key => $cate_2)
                                    @if ($cate_2 ->category_parent == $cate ->category_id)
                                        <option value="{{$cate_2 -> category_id}}">
                                            -- {{$cate_2 -> category_name}}
                                        </option>
                                    @endif
                                @endforeach
                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Tags sản phẩm</label>
                            <input type="text" data-role="tagsinput" name="product_tags"  class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Thương hiệu sản phẩm</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach ($brand_product as $key => $brand)
                                <option value="{{$brand -> brand_id}}">{{$brand -> brand_name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                        
                        
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                    
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection
