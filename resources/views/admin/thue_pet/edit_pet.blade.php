@extends('admin_layout')
@section('admin_content')

   <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sữa pet
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
                                 @foreach($edit_pet as $key => $pro)
                               <form role="form" action="{{URL::to('/update-pet/'.$pro->pet_id)}}" method="post" enctype="multipart/form-data">

                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thú cưng</label>
                                    <input type="text" name="pet_name" class="form-control" id="exampleInputEmail1" value="{{$pro->pet_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Màu sắc</label>
                                    <input type="text" name="pet_slug" class="form-control" id="exampleInputEmail1" value="{{$pro->pet_slug}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Loại thú cưng</label>
                                    <input type="text" name="pet_type" class="form-control" id="exampleInputEmail1" value="{{$pro->pet_type}}">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Số tuổi</label>
                                    <input type="text" name="pet_age" class="form-control" id="exampleInputEmail1" value="{{$pro->pet_age}}">
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh thú cưng</label>
                                    <input type="file" name="pet_image" class="form-control" id="exampleInputEmail1" >
                                    <img src="{{URL::to('public/uploads/product/'.$pro->pet_image)}}" height="100" width="100">
                                </div>

                             
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <input type="text" name="pet_gender" class="form-control" id="exampleInputEmail1"  value="{{$pro->pet_gender}}" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Giá thuê 1 ngày</label>
                                    <input type="text" name="rental_price_per_day" class="form-control" id="exampleInputEmail1" value="{{$pro->rental_price_per_day}}">
                                </div>

                                <div class="form-group">
                                    <label for="text">Mô tả sản phẩm</label>
                                    <textarea  style="resize: none " rows="6" name="pet_desc" class="form-control" >{{$pro->pet_desc}}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="text">Nội dung sản phẩm</label>
                                    <textarea  style="resize: none " rows="10" name="pet_content" class="form-control"  >
                                        {{$pro->pet_content}}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="pet_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn </option>
                                        <option value="1">Hiển thị</option>
                                     </select>
                                </div>


                               
                                <button type="submit" name="add_pet" class="btn btn-info">Cập nhật pet</button>
                            </form>
                           @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection