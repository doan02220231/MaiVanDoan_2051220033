@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
                </header>
                <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class = "text-alert">',$message.'</span>';
                            Session::put('message',null);
                        }
                    ?>
                <div class="panel-body">
                    @foreach ($edit_category_product as $key => $edit_value)
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_value -> category_id)}}" method="post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputDM">Tên danh mục</label>
                            <input type="text" value="{{$edit_value -> category_name}}" onkeyup="ChangeToSlug();" name="category_product_name" class="form-control" id="slug" placeholder="tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{$edit_value->slug_category_product}}" name="slug_category_product" class="form-control" id="convert_slug" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="category_product_desc" id="exampleInputdesc" >{{$edit_value -> category_desc}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Từ khóa danh mục</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="category_product_keywords" id="exampleInputdesc" placeholder="Mô tả danh mục">{{$edit_value -> meta_keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Thuộc danh mục</label>
                            <select name="category_product_parent" class="form-control input-sm m-bot15">
                                <option value="0">------- Danh mục cha -------</option>
                                @foreach ($category as $key => $val)
                                    @if ($val ->category_parent == 0)
                                        <option {{$val ->category_id }} value="{{$val -> category_id}}">{{$val -> category_name}}</option>
                                    @endif
                                    @foreach ($category as $key => $val_2)
                                        @if ($val_2 ->category_parent == $val ->category_id)
                                            <option {{$val_2 ->category_id == $edit_value ->category_id ? 'selected':''}} value="{{$val_2 -> category_id}}">
                                                -- {{$val_2 -> category_name}}
                                            </option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật</button>
                    </form>
                    </div>   
                    @endforeach
                </div>
            </section>

    </div>
    
</div>
@endsection