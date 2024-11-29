@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thông tin liên hệ
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
                        @foreach ($contact as $key => $val)
                        <form role="form" action="{{URL::to('/update-info/'.$val->info_id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputdesc">Thông tin liên hệ</label>
                                <textarea style="resize: none"data-validation="length"  data-validation-length="min10" 
                                data-validation-error-msg="làm ơn điền ít nhất 10 ký tự" rows="4" class="form-control"
                                name="info_contact" id="ckeditor" >{{$val->info_contact}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputdesc">Bản đồ</label>
                                <textarea style="resize: none"data-validation="length"  data-validation-length="min10" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự"
                                 rows="4" class="form-control" name="info_map" id="exampleInputdesc" >{{$val->info_map}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputdesc">Fanpage</label>
                                <textarea style="resize: none" data-validation="length"  data-validation-length="min10" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự"
                                rows="4" class="form-control" name="info_fanpage" id="exampleInputdesc" >{{$val->info_fanpage}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDM">Image logo</label>
                                <input type="file" name="info_image" class="form-control" id="exampleInputDM" >
                                <img src="{{URL::to('public/uploads/contact/'.$val->info_image)}}" height="100" width="100">
                            </div>
                            
                            <button type="submit" name="add_infor" class="btn btn-info">Cập nhật thông tin</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection