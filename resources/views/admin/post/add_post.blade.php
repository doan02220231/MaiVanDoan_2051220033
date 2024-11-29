@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm bài viết
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
                        <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputDM">Tên bài viết</label>
                            <input type="text" name="post_title" data-validation="length"  data-validation-length="min10" 
                            data-validation-error-msg="làm ơn điền ít nhất 10 ký tự" onkeyup="ChangeToSlug();" class="form-control" id="slug" placeholder="tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="post_slug" class="form-control" id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Image bài viết</label>
                            <input type="file" name="post_image" class="form-control" id="exampleInputDM" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Tóm tắt bài viết</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="post_desc" id="ckeditor3" placeholder="Mô tả thương hiệu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Nội dung bài viết</label>
                            <textarea id="ckeditor2" style="resize: none" rows="4" class="form-control" name="post_conten"  placeholder="Mô tả thương hiệu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Meta từ khóa</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="post_meta_keywords" id="exampleInputdesc" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Meta nội dung</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="post_meta_desc" id="exampleInputdesc" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Danh mục bài viết</label>
                            <select name="category_post_id" class="form-control input-sm m-bot15">
                                @foreach ($cate_post as $key =>$cate_p)
                                    <option value="{{$cate_p -> category_post_id}}">{{$cate_p -> category_post_name}}</option> 
                                @endforeach
                                
                               
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Hiển thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                        
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm bài viết</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection