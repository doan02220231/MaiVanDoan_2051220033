<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- SEO --}}
    {{-- <meta name="description" content="{{$meta_decs}}">
    <meta name="author" content="">
	<meta name="keywords" content="{{$meta_keywords}}">
	<meta name="robots" content="INDEX,FOLLOW">
	<link  rel="canonical" href="{{$url_canonical}}" />
	<link  rel="icon" type="image/x-icon" href="" /> --}}
	{{-- END-SEO --}}
    <title>Cho thuê thú cưng giá rẻ chất lượng</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/style1.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('public/backend/css/jquery-ui.css')}}">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
							<li><a href="#"><i class="fa fa-phone"></i> +84 362 225 211</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i> doan_2051220033@dau.edu.vn</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
						<a href="{{URL::to('/trang-chu')}}">
    						<img src="{{asset('public/frontend/images/logo_petnew.png')}}" style="height: 60px; width: 100px;" />
						</a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									VN
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">USA</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									VNĐ
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">$</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								{{-- <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li> --}}
                                <li><a href="{{URL::to('/san-pham-thue')}}"><i class="fa fa-star"></i> Thuê Pet</a></li> 
                                 	@php 
									$customer_id = Session::get('customer_id');
									if($customer_id != NULL){
								@endphp
									<li><a href="{{URL::to('history-thue')}}"><i class="fa fa-bell"></i> Lịch sữ Thuê pet</a></li>
								@php
									}
								@endphp
                               
								<?php 
									$customer_id = Session::get('customer_id');
									
									if($customer_id != NULL ){
								?>
									<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thang toán</a></li>
									 <li><a href="{{URL::to('/checkout-thue')}}"><i class="fa fa-star"></i>Thanh Toán thuê Pet</a></li> 
								<?php 
									}else{
								?>
									<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Thang toán	</a></li>

								<?php 
									}
								?>
								
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>


								<li><a href="{{URL::to('/gio-hang-thue')}}"><i class="fa fa-star"></i> Giỏ hàng thuê Pet</a></li> 
								<?php 
									$customer_id = Session::get('customer_id');
									if($customer_id != NULL){
								?>
									<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								<?php 
									}else{
								?>
									<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php 
									}
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						{{-- <div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div> --}}
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Danh mục<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Thương hiệu<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu" style="width: 100px">
                                   
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu" >
										
										</ul>
								</li> 
								<li><a href="{{url('/lien-he')}}">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					{{-- <div class="col-sm-5">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
							@csrf
							<div class="search_box pull-right">
								<input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
								<input type="submit" style="margin-top: 0px; color: #000;" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
							</div>
						</form>
					</div> --}}
				</div>
			</div>
		</div><!--/header-bottom-->
		
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 padding-right">
					@yield('content')		
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
						<h2><span>PET</span>-SHOP</h2>
						<p>Chào mừng bạn đã đến với PET SHOP</p>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-3" style="">
						<!-- <div class="single-widget">
							<h2>Danh mục sản phẩm</h2>
							
						</div> -->
					</div>
				 	<div class="col-sm-3">
						<div class="single-widget">
							<h2>Tin tức</h2>
							
						</div>
					</div> 
					{{-- <div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div> --}}
					{{-- <div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div> --}}
					<div class="col-sm-3 col-sm-offset-1" style="">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © PetShop Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
	<script src="{{asset('public/frontend/js/prettify.js')}}"></script>

<script rel="stylesheet" src="{{asset('public/backend/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
    // Lấy phần tử tbody của bảng và phần hiển thị trung bình
    const feedbackTable = document.getElementById("feedbackTable");
    const averageRatingDisplay = document.getElementById("averageRating");
    const averageStarsDisplay = document.getElementById("averageStars");

    // Lưu trạng thái đánh giá
    const ratings = {};
    const totalWeeks = 7; // Tổng số ngày

    // Tạo bảng theo ngày
    for (let week = 1; week <= totalWeeks; week++) {
        // Tạo một dòng mới
        const row = document.createElement("tr");

        // Thứ tự ngày
        const weekCell = document.createElement("td");
        weekCell.textContent = week;
        row.appendChild(weekCell);

        // Đánh giá sao
        const ratingCell = document.createElement("td");
        const starContainer = document.createElement("ul");
        starContainer.className = "list-inline rating";
        starContainer.style.listStyleType = "none"; // Loại bỏ kiểu danh sách
        starContainer.style.padding = "0";
        starContainer.style.display = "flex";

        for (let star = 1; star <= 5; star++) {
            const starElement = document.createElement("li");
            starElement.textContent = "★"; // Biểu tượng sao
            starElement.style.fontSize = "24px";
            starElement.style.cursor = "pointer";
            starElement.style.color = "#ccc"; // Màu mặc định
            starElement.dataset.index = star;
            starElement.dataset.week = week;

            // Hover sao
            starElement.addEventListener("mouseenter", () => {
                if (canRate(week)) updateStars(week, star);
            });

            // Rời chuột khỏi sao
            starElement.addEventListener("mouseleave", () => {
                if (canRate(week)) resetStars(week);
            });

            // Click để đánh giá
            starElement.addEventListener("click", () => {
                if (canRate(week)) {
                    setRating(week, star);
                } else {
                    alert(`Bạn cần đánh giá ngày ${week - 1} trước khi đánh giá ngày ${week}.`);
                }
            });

            starContainer.appendChild(starElement);
        }

        ratingCell.appendChild(starContainer);
        row.appendChild(ratingCell);

        // Thêm dòng vào bảng
        feedbackTable.appendChild(row);
    }

    // Hàm kiểm tra xem có thể đánh giá ngày hiện tại không
    function canRate(week) {
        if (week === 1) return true; // ngày đầu tiên luôn có thể đánh giá
        return ratings[week - 1] !== undefined; // Kiểm tra ngày trước đã được đánh giá chưa
    }

    // Hàm cập nhật sao khi hover
    function updateStars(week, rating) {
        const stars = document.querySelectorAll(`[data-week="${week}"]`);
        stars.forEach((star, index) => {
            star.style.color = index < rating ? "#ffcc00" : "#ccc";
        });
    }

    // Hàm đặt lại màu sao khi rời chuột
    function resetStars(week) {
        const stars = document.querySelectorAll(`[data-week="${week}"]`);
        const currentRating = ratings[week] || 0;
        stars.forEach((star, index) => {
            star.style.color = index < currentRating ? "#ffcc00" : "#ccc";
        });
    }

    // Hàm thiết lập đánh giá
    function setRating(week, rating) {
        ratings[week] = rating;
        alert(`Bạn đã đánh giá ngày ${week} là ${rating} sao.`);

        // Tính toán và cập nhật điểm trung bình
        updateAverageRating();
        resetStars(week);
    }

    // Hàm tính điểm trung bình và cập nhật hiển thị
    function updateAverageRating() {
        const totalRatings = Object.values(ratings).reduce((acc, value) => acc + value, 0);
        const ratedWeeks = Object.keys(ratings).length;
        const averageRating = ratedWeeks > 0 ? (totalRatings / ratedWeeks).toFixed(2) : 0;

        // Hiển thị mức độ trung bình yêu thích bằng số
        averageRatingDisplay.textContent = ratedWeeks > 0 
            ? `${averageRating} sao (${ratedWeeks} ngày đã được đánh giá)` 
            : "Chưa có đánh giá";

        // Hiển thị mức độ trung bình yêu thích bằng sao
        const roundedAverage = Math.round(averageRating);
        averageStarsDisplay.innerHTML = ""; // Xóa sao cũ
        for (let i = 1; i <= 5; i++) {
            const star = document.createElement("li");
            star.textContent = "★"; // Biểu tượng sao
            star.style.fontSize = "24px";
            star.style.color = i <= roundedAverage ? "#ffcc00" : "#ccc";
            star.style.display = "inline-block";
            star.style.marginRight = "2px";
            averageStarsDisplay.appendChild(star);
        }
    }
</script>
	<script>
    $('.xemnhanhthue').click(function(){
        var pet_id = $(this).data('id_pet');
        var _token = $('input[name="_token"]').val();
        
        $.ajax({
            url: '{{ url('/quickview-thue') }}',
            method: 'POST',
            dataType: 'JSON',
            data: { pet_id: pet_id, _token: _token },
            success: function(data){
                $('#product_quickview_title').html(data.pet_name);
                $('#product_quickview_id').html(data.pet_id);
                $('#product_quickview_slug').html(data.pet_slug);
                $('#product_quickview_type').html(data.pet_type);
                $('#product_quickview_age').html(data.pet_age);
                $('#product_quickview_gender').html(data.pet_gender);
                $('#product_quickview_price').html(data.rental_price_per_day);
                $('#product_quickview_image').html(data.product_image);
                $('#product_quickview_gallery').html(data.product_gallery);
                $('#product_quickview_desc').html(data.pet_desc);
                $('#product_quickview_content').html(data.pet_content);
                $('#product_quickview_button').html(data.product_button); // Example button
                
            }
        });
    });
</script>

<script>
	$('.pet_thue_mua_ban').change(function(){
		var pet_thue_mua = $(this).val();
		var order_thue_id = $(this).attr('idd');
		var _token = $('input[name = "_token"]').val();
	
		$.ajax({
				url : '{{url('/update-mua-ban')}}',
				method : 'POST',
				data:{_token:_token,pet_thue_mua:pet_thue_mua,order_thue_id:order_thue_id},
				success:function(){
					alert('Thay đổi tình trạng đơn hàng thành công');
					location.reload();
				}
			});
		
	});
</script>

<script>
	$('.pet_thue_suc_khoe').change(function(){
		var pet_thue_suc_khoe = $(this).val();
		var order_thue_id = $(this).attr('idd_s');
		var _token = $('input[name = "_token"]').val();
	
		$.ajax({
				url : '{{url('/update-suc-khoe')}}',
				method : 'POST',
				data:{_token:_token,pet_thue_suc_khoe:pet_thue_suc_khoe,order_thue_id:order_thue_id},
				success:function(){
					alert('Thay đổi tình trạng đơn hàng thành công');
					location.reload();
				}
			});
		
	});
</script>

<script type="text/javascript">
		$(document).ready(function(){
			$('.send-order-thue').click(function(){
				swal({
					title: "Xác nhận đơn hàng",
					text: "Cảm ơn bạn đã tin dùng sản phẩm của PetShop,bạn có chắc chắc muốn đặt không ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Xác nhận",
					cancelButtonText: "Thoát",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm) {
					if (isConfirm) {
						var shipping_email = $('.shipping_email').val();
						var shipping_name = $('.shipping_name').val();
						var shipping_address = $('.shipping_address' ).val();
						var shipping_phone = $('.shipping_phone').val();
						var shipping_nodes = $('.shipping_nodes' ).val();
						var shipping_method = $('.payment_select' ).val()
						var order_coupon = $('.order_coupon').val();
						var _token = $('input[name = "_token"]').val();
						$.ajax({
							url: '{{url('/conform-order-thue')}}',
							method: 'POST',
							data: {shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,
								shipping_phone:shipping_phone,shipping_nodes:shipping_nodes,
								order_coupon:order_coupon,shipping_method:shipping_method,_token:_token},
							success:function(){
								swal("Đặt hành thành công", "Cản ơn bạn đã đặt sản phẩm của nhà PetShop", "success");
							}
						});
						window.setTimeout(() => {
							location.reload();
						}, 3000);
						
					} else {
						swal("Xem lại", "Cảm ơn bạn đã đến với PetShop)", "error");
					}
				});
				
			});
		});
	</script>


<script>

	$(function(){
		$("#datepicker1").datepicker({
			prevText:"Tháng trước",
			nextText:"Tháng sau",
			dateFormat:"yy-mm-dd",
			dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
			duration:"slow"
		});
		$("#datepicker2").datepicker({
			prevText:"Tháng trước",
			nextText:"Tháng sau",
			dateFormat:"yy-mm-dd",
			dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
			duration:"slow"
		});
	});
</script>


<script type="text/javascript">
$(document).ready(function() {
	
    $('.add-to-cart-thue').click(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var id = $(this).data('id_thue');
        var cart_thue_id = $('.cart_thue_id_' + id).val();
        var cart_thue_name = $('.cart_thue_name_' + id).val();
        var cart_thue_image = $('.cart_thue_image_' + id).val();
        var cart_thue_price = $('.cart_thue_price_' + id).val();
        var cart_thue_gender = $('.cart_product_gender_' + id).val(); 
        var cart_thue_type = $('.cart_thue_type_' + id).val(); 
        var cart_thue_slug = $('.cart_thue_slug_' + id).val(); 
        var cart_thue_content = $('.cart_thue_content_' + id).val(); 
        var cart_thue_desc = $('.cart_thue_desc_' + id).val(); 
        var cart_thue_qty = $('.cart_thue_qty_' + id).val(); 
         var week = $(this).val();
        var _token = $('input[name="_token"]').val();

       

        $.ajax({
            url: '{{url('/add-to-cart-thue')}}',
            method: 'POST',
            data: {
                cart_thue_id: cart_thue_id,
                cart_thue_name: cart_thue_name,
                cart_thue_image: cart_thue_image,
                cart_thue_price: cart_thue_price,
                cart_thue_gender: cart_thue_gender,
                cart_thue_type: cart_thue_type,
                cart_thue_slug: cart_thue_slug,
                cart_thue_content: cart_thue_content,
                cart_thue_desc: cart_thue_desc,
                cart_thue_qty: cart_thue_qty,
                week:week,
               // Send the total days
               
                _token: _token
            },
            success: function(data) {
               
            
						swal({
							title: "Đã thêm sản phẩm vào giỏ hàng",
							text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để thanh toán ",
							showCancelButton: true,
							cancelButtonText: "Xem tiếp",
							confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
							closeOnConfirm: false
						},
						function(){
							window.location.href = "{{url('/gio-hang-thue')}}"
						});
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	
    $('.add-to-cart-combo').click(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var id = $(this).data('id_combo');
        var cart_combo_id = $('.cart_combo_id_' + id).val();
        var cart_combo_name = $('.cart_combo_name_' + id).val();
        var cart_combo_image = $('.cart_combo_image_' + id).val();
        var cart_combo_price = $('.cart_combo_price_' + id).val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{url('/add-to-cart-combo')}}' ,
            method: 'POST',
            data: {
                cart_combo_id: cart_combo_id,
                cart_combo_name: cart_combo_name,
                cart_combo_image: cart_combo_image,
                cart_combo_price: cart_combo_price,
                _token: _token
            },

            success: function(data) {
               
						swal({
							title: "Đã thêm sản phẩm vào giỏ hàng",
							text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để thanh toán ",
							showCancelButton: true,
							cancelButtonText: "Xem tiếp",
							confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
							closeOnConfirm: false
						},
						function(){
							window.location.href = "{{url('/gio-hang-thue')}}"
						});
            }
        });
    });
});
</script>
	<script>
		$(document).ready(function() {
			$('#imageGallery').lightSlider({
				gallery:true,
				item:1,
				loop:true,
				thumbItem:4,
				slideMargin:0,
				enableDrag: false,
				currentPagerPosition:'left',
				onSliderLoad: function(el) {
					el.lightGallery({
						selector: '#imageGallery .lslide'
					});
				}   
			});  
  		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.send-order').click(function(){
				swal({
					title: "Xác nhận đơn hàng",
					text: "Cảm ơn bạn đã tin dùng sản phẩm của PetShop,bạn có chắc chắc muốn đặt không ?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Xác nhận",
					cancelButtonText: "Thoát",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm) {
					if (isConfirm) {
						var shipping_email = $('.shipping_email').val();
						var shipping_name = $('.shipping_name').val();
						var shipping_address = $('.shipping_address' ).val();
						var shipping_phone = $('.shipping_phone').val();
						var shipping_nodes = $('.shipping_nodes' ).val();
						var shipping_method = $('.payment_select' ).val()
						var order_fee = $('.order_fee').val();
						var order_coupon = $('.order_coupon').val();
						var _token = $('input[name = "_token"]').val();
						$.ajax({
							url: '{{url('/conform-order')}}',
							method: 'POST',
							data: {shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,
								shipping_phone:shipping_phone,shipping_nodes:shipping_nodes,order_fee:order_fee,
								order_coupon:order_coupon,shipping_method:shipping_method,_token:_token},
							success:function(){
								swal("Đặt hành thành công", "Cản ơn bạn đã đặt sản phẩm của nhà PetShop", "success");
							}
						});
						window.setTimeout(() => {
							location.reload();
						}, 3000);
						
					} else {
						swal("Xem lại", "Cảm ơn bạn đã đến với PetShop)", "error");
					}
				});
				
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name = "_token"]').val();
				$.ajax({
					url: '{{url('/add-cart-ajax')}}',
					method: 'POST',
					data: {cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,
					cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
					success:function(data){
						swal({
							title: "Đã thêm sản phẩm vào giỏ hàng",
							text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để thanh toán ",
							showCancelButton: true,
							cancelButtonText: "Xem tiếp",
							confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
							closeOnConfirm: false
						},
						function(){
							window.location.href = "{{url('/gio-hang')}}"
						});
					}
				});
			});
		});

	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.choose').on('change',function(){
			var action = $(this).attr('id');
			var ma_id = $(this).val();
			var _token = $('input[name = "_token"]').val();
			var result = '';
			// alert(action);
			// alert(matp);
			// alert(_token);
			if(action == 'city'){
				result = 'province';
			}else{
				result = 'wards';
			}
				$.ajax({
					url : '{{url('/select-delivery-home')}}',
					method : 'POST',
					data:{action:action,ma_id:ma_id,_token:_token},
					success:function(data){
						$('#'+result).html(data);
					}
				});
			});
		});
		
	</script>

	<script>
		$('.xemnhanh').click(function(){
			var pet_id =$(this).data('id_product');
			var _token = $('input[name = "_token"]').val();
			$.ajax({
				///  video 143
					url : '{{url('/quickview')}}',
					method : 'POST',
					dataType: 'JSON',
					data:{pet_id:pet_id,_token:_token},
					success:function(data){
						$('#product_quickview_title').html(data.pet_name);
						$('#product_quickview_id').html(data.pet_id);
						$('#product_quickview_price').html(data.rental_price_per_day);
						$('#product_quickview_image').html(data.pet_image);
						$('#product_quickview_gallrey').html(data.pet_type); // thêm  gallrey Bài 124
						$('#product_quickview_desc').html(data.pet_desc);
						$('#product_quickview_content').html(data.pet_content);
						$('#product_quickview_button').html(data.product_button);
					}
				});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.calculate_delivery').click(function(){
				var matp = $('.city').val();
				var maqh =  $('.province').val();
				var xaid =  $('.wards').val();
				var _token = $('input[name = "_token"]').val();
				if(matp == ''&& maqh == '' && xaid == ''){
					alert('Làm ơn chọn để tính phí vận chuyển');
				}else{
					$.ajax({
						url : '{{url('/calculate-fee')}}',
						method : 'POST',
						data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
						success:function(data){
							location.reload();
						}
					});
				}
				
			});
		});
	</script>
</body>
</html>