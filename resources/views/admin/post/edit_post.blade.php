@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật bài viết
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
                        <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputDM">Tên bài viết</label>
                            <input type="text" name="post_title" value="{{$post->post_title}}" onkeyup="ChangeToSlug();" class="form-control" id="slug" placeholder="tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="post_slug" value="{{$post->post_slug}}" class="form-control" id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Image bài viết</label>
                            <input type="file" name="post_image"  class="form-control" id="exampleInputDM" >
                            <img src="{{asset('public/uploads/post/'.$post->post_image)}}" height="100" width="100">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Tóm tắt bài viết</label>
                            <textarea style="resize: none" rows="4"  class="form-control" name="post_desc" id="ckeditor3" placeholder="Mô tả thương hiệu">{{$post->post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Nội dung bài viết</label>
                            <textarea id="ckeditor2" style="resize: none" rows="4" class="form-control" name="post_conten"  placeholder="Mô tả thương hiệu">{{$post->post_conten}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Meta từ khóa</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="post_meta_keywords" id="exampleInputdesc" placeholder="Mô tả danh mục">{{$post->post_meta_keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Meta nội dung</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="post_meta_desc" id="exampleInputdesc" placeholder="Mô tả danh mục">{{$post->post_meta_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Danh mục bài viết</label>
                            <select name="category_post_id" class="form-control input-sm m-bot15">
                                @foreach ($cate_post as $key =>$cate_p)
                                    <option {{$post -> category_post_id == $cate_p ->category_post_id ? 'selected' : '' }} value="{{$cate_p -> category_post_id}}">{{$cate_p -> category_post_name}}</option> 
                                @endforeach
                                
                               
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Hiển thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                @if ($post -> post_status ==0)
                                    <option selected value="0">Hiện</option>
                                    <option value="1">Ẩn</option>
                                @else
                                    <option value="0">Hiện</option>
                                    <option selected value="1">Ẩn</option>
                                @endif
                                
                            </select>
                        </div>
                        
                        <button type="submit" name="add_brand_product" class="btn btn-info">Cập nhật bài viết</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection