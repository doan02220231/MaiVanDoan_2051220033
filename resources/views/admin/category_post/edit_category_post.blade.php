@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục tin tức
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
                        <form role="form" action="{{URL::to('/update-category-post/'.$category_post-> category_post_id)}}" method="post">
                           @csrf
                        <div class="form-group">
                            <label for="exampleInputDM">Tên danh mục</label>
                            <input type="text" name="cate_post_name" value="{{$category_post-> category_post_name}}" onkeyup="ChangeToSlug();" class="form-control" id="slug" placeholder="tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="cate_post_slug" value="{{$category_post-> category_post_slug}}" class="form-control" id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Mô tả danh mục</label>
                            <textarea style="resize: none" value="" rows="4" class="form-control" name="cate_post_desc" id="exampleInputdesc" placeholder="Mô tả thương hiệu">{{$category_post-> category_post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Hiển thị</label>
                            <select name="cate_post_status" value="{{$category_post-> category_post_status}}"class="form-control input-sm m-bot15">
                                @if ($category_post-> category_post_status == 0)
                                    <option selected value="0">Hiện</option>
                                    <option value="1">Ẩn</option>   
                                @else
                                    <option  value="0">Hiện</option>
                                    <option selected value="1">Ẩn</option>   
                                @endif
                                
                               
                            </select>
                        </div>
                        
                        <button type="submit" name="update_post_cate" class="btn btn-info">Cập nhật danh mục BV</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection