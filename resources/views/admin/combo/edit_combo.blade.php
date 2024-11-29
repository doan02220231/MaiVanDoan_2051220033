@extends('admin_layout')
@section('admin_content')

   <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm pet 
                        </header>
                        <div class="panel-body">

                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class = "text-alert">', $message,' </span>';
                                    Session::put('message',null);
                                }
                             ?>
                            <div class="position-center">
                                @foreach($edit_com as $key => $pro)
                               <form role="form" action="{{URL::to('/save-combo')}}" method="post" enctype="multipart/form-data">

                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên combo</label>
                                    <input type="text" name="combo_name" class="form-control" id="exampleInputEmail1" value="{{$pro->combo_name}}">
                                </div>

                               
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="combo_image" class="form-control" id="exampleInputEmail1" ><img src="{{URL::to('public/uploads/product/'.$pro->combo_image)}}" height="100" width="100">
                                </div>
                               
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Giá tiền</label>
                                    <input type="text" name="combo_gia" class="form-control" id="exampleInputEmail1" value="{{$pro->combo_gia}}">
                                </div>

                              <div class="form-group">
                                    <label for="text">Mô tả combo</label>
                                    <textarea   style="resize: none " rows="10" name="combo_content" class="form-control"  > {{$pro->combo_content}}
                                    </textarea> 
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="combo_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn </option>
                                        <option value="1">Hiển thị</option>
                                     </select>
                                </div>
                               
                                <button type="submit" name="add_pet" class="btn btn-info">Thêm combo</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection