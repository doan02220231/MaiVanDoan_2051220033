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
                        <form role="form" action="{{URL::to('/update-coupon-code/'.$coupon_edit->coupon_id)}}" method="post">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputDM">Tên mã giảm giá</label>
                            <input type="text" name="coupon_name" value="{{$coupon_edit ->coupon_name}}" class="form-control" id="exampleInputDM" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Ngày bắt đầu</label>
                            <input type="text" name="coupon_date_start" value="{{$coupon_edit ->coupon_date_start}}" class="form-control" id="start_coupon" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDM">Ngày kết thúc</label>
                            <input type="text" name="coupon_date_end" value="{{$coupon_edit ->coupon_date_end}}" class="form-control" id="end_coupon" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Mã giảm giá</label>
                            <input type="text" name="coupon_code" value="{{$coupon_edit ->coupon_code}}" class="form-control" id="exampleInputDM">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Sô lượng mã</label>
                            <input type="text" name="coupon_times" value="{{$coupon_edit ->coupon_times}}" class="form-control" id="exampleInputDM">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Tính năng mã</label>
                            <select name="coupon_status" value="{{$coupon_edit ->coupon_status}}" class="form-control input-sm m-bot15">
                                @if ($coupon_edit ->coupon_status == 1)
                                    <option value="0">--Chọn--</option>
                                    <option selected value="1">Kích hoạt</option>
                                    <option value="2">Khoá</option>
                                @else
                                    <option value="0">--Chọn--</option>
                                    <option value="1">Kích hoạt</option>
                                    <option selected value="2">Khoá</option>
                                @endif
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Tính năng mã</label>
                            <select name="coupon_condition" value="{{$coupon_edit ->coupon_condition}}" class="form-control input-sm m-bot15">
                                @if ($coupon_edit ->coupon_condition == 1)
                                    <option value="0">--Chọn--</option>
                                    <option selected value="1">Giảm theo %</option>
                                    <option value="2">Giảm theo số tiền</option>
                                @else
                                    <option value="0">--Chọn--</option>
                                    <option value="1">Giảm theo %</option>
                                    <option selected value="2">Giảm theo số tiền</option>
                                @endif
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc">Nhập số % hoặc tiền giảm</label>
                            <input type="text" name="coupon_number" value="{{$coupon_edit ->coupon_number}}" class="form-control" id="exampleInputDM">
                        </div>
                        
                        
                        <button type="submit" name="add_coupon" class="btn btn-info">Cập nhật mã</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
    
</div>
@endsection