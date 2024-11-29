@extends('admin_layout')

@section('admin_content')
 <div class="container-fluid">
    <style>
        p.title_thongke{
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
<div class="row">
    <p class="title_thongke">Thống kê đơn hàng doanh số</p>
    <form autocomplete="off">
        @csrf
        <div class="col-md-2">
            <p>Từ ngày: <input type="text" id="datepicker1" class="form-control"></p>
            <input type="button" id="btn-dashborad-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
        </div>
        <div class="col-md-2">
            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
            
        </div>
        <div class="col-md-2">
            <p>Lọc theo:
                <select class="dashboard-filter form-control">
                    <option>--Chọn--</option>
                    <option value="7ngay">7 ngày qua</option>
                    <option value="thangtruoc">Tháng trước</option>
                    <option value="thangnay">Tháng này</option>
                    <option value="365ngayqua">365 ngày qua</option>
                </select>
            </p>
            
        </div>
    </form>
    <div class="col-md-12">
        <div id="myfirstchart" style="height: 250px;"></div>
    </div>
</div>
<div class="row">
    <style>
        table.table.table-bordered.table-dark{
            background: #32383e;
        }
        table.table.table-bordered.table-dark tr th{
            color: #fff;
        }
    </style>
    <p class="title_thongke">Thống kê truy cập</p>
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th class="col">Đang online</th>
                <th class="col">Tổng tháng trước</th>
                <th class="col">Tổng tháng này</th>
                <th class="col">Tổng một năm</th>
                <th class="col">Tổng truy cập</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$visitors_count}}</td>
                <td>{{$visitors_last_month_count}}</td>
                <td>{{$visitors_this_month_count}}</td>
                <td>{{$visitors_year_count}}</td>
                <td>{{$visitors_total}}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row"> 
    <div class="col-md-4 col-xs-12">
        <p class="title_thongke">Thống kê tổng sản phẩm bài viết đơn hàng </p>
        <div id="donut" class="morris-donut-inverse"></div>
    </div >
    <style>
        ol.list_views{
            margin: 10px 0;
            color: #fff;
        }
        ol.list_views a{
            font-weight: 400;
            color:orange;
        }
    </style>
    <div class="col-md-4 col-xs-12">
        <h3>Bài viết xem nhiều</h3>
        
        <ol class="list_views">
            @foreach ($post_views as $key => $post)
            <li style="    color: black;">
                <a target="_blank" href="{{url('/bai-viet/'.$post->post_slug)}}">{{$post->post_title}} </a>
            </li>
            @endforeach
        </ol>
       
    </div>
    <div class="col-md-4 col-xs-12">
        <h3>Sản phẩm xem nhiều</h3>
        
        <ol class="list_views">
            @foreach ($product_views as $key => $pro)
            <li style="    color: black;">
                <a target="_blank" href="{{url('/chi-tiet-san-pham/'.$pro->product_slug)}}">{{$pro->product_name}} 
                   </a>
            </li>
            @endforeach
        </ol>
       
    </div>
</div>
</div>   
@endsection
