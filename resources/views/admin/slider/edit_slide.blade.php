@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Slider
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
                        <form role="form" action="{{URL::to('/update-slider/'.$slider -> slider_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputDM">Tên slide</label>
                            <input type="text" name="slider_name" class="form-control" value="{{$slider->slider_name}}" id="exampleInputDM" placeholder="tên Slide">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Slider">
                            <img src="{{asset('public/uploads/banner/'.$slider->slider_image)}}" height="100" width="100">
                           
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Mô tả Slider</label>
                            <textarea style="resize: none" rows="4" class="form-control"  name="slider_desc" id="exampleInputdesc" placeholder="Mô tả slide">{{$slider->slider_desc}}</textarea>
                        </div>
                        
                        
                        <button type="submit" name="add_slider" class="btn btn-info">cập nhật slider</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection