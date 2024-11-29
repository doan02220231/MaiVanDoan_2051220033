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
                               <form role="form" action="{{URL::to('/save-pet')}}" method="post" enctype="multipart/form-data">

                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thú cưng</label>
                                    <input type="text" name="pet_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thú cưng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Màu sắc</label>
                                    <input type="text" name="pet_slug" class="form-control" id="exampleInputEmail1" placeholder="Màu sắc">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Loại thú cưng</label>
                                    <input type="text" name="pet_type" class="form-control" id="exampleInputEmail1" placeholder="Loại thú cưng">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Số tuổi</label>
                                    <input type="text" name="pet_age" class="form-control" id="exampleInputEmail1" placeholder="Loại thú cưng">
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh thú cưng</label>
                                    <input type="file" name="pet_image" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giới tính</label>
                                    <input type="text" name="pet_gender" class="form-control" id="exampleInputEmail1" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Giá thuê 1 ngày</label>
                                    <input type="text" name="rental_price_per_day" class="form-control" id="exampleInputEmail1" >
                                </div>

                                <div class="form-group">
                                    <label for="text">Mô tả sản phẩm</label>
                                    <textarea  style="resize: none "  rows="6" name="pet_desc" class="form-control"  placeholder="Mô tả sản phẩm">
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="text">Nội dung sản phẩm</label>
                                    <textarea   style="resize: none " rows="10" name="pet_content" class="form-control"  placeholder="Nội dung sản phẩm">
                                    </textarea>
                                </div>

                                <div class="form-group">
                                	<label for="exampleInputPassword1">Hiển thị</label>
                                	<select name="pet_status" class="form-control input-sm m-bot15">
		                                <option value="0">Ẩn </option>
		                                <option value="1">Hiển thị</option>
                        	   		 </select>
                                </div>


                               
                                <button type="submit" name="add_pet" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection