@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm mã giảm giá
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
                        <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputDM">Tên mã giảm giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="exampleInputDM" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Ngày bắt đầu</label>
                            <input type="text" name="coupon_date_start" class="form-control" id="start_coupon" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Ngày kết thúc</label>
                            <input type="text" name="coupon_date_end" class="form-control" id="end_coupon" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Mã giảm giá</label>
                            <input type="text" name="coupon_code" class="form-control" id="exampleInputDM">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Sô lượng mã</label>
                            <input type="text" name="coupon_times" class="form-control" id="exampleInputDM">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Tình trạng</label>
                            <select name="coupon_status" class="form-control input-sm m-bot15">
                                <option value="0">--Chọn--</option>
                                <option value="1">kích hoạt</option>
                                <option value="2">Khoá</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Tính năng mã</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="0">--Chọn--</option>
                                <option value="1">Giảm theo %</option>
                                <option value="2">Giảm theo số tiền</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Nhập số % hoặc tiền giảm</label>
                            <input type="text" name="coupon_number" class="form-control" id="exampleInputDM">
                        </div>
                        
                        
                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm Mã</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection