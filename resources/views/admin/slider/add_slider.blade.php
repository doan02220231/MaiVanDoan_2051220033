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
                        <form role="form" action="{{URL::to('/insert-slider')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputDM">Tên slide</label>
                            <input type="text" name="slider_name" class="form-control" id="exampleInputDM" placeholder="tên Slide">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Slider">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Mô tả Slider</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="slider_desc" id="exampleInputdesc" placeholder="Mô tả slide"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Hiển thị</label>
                            <select name="slider_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện thị slider</option>
                                <option value="1">Ẩn slider</option>
                            </select>
                        </div>
                        
                        <button type="submit" name="add_slider" class="btn btn-info">Thêm slider</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection