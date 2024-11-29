	<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>

<title>Pet Shop</title>
<meta name="csrf-token" content="{{csrf_token()}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<link rel="stylesheet" href="{{asset('public/backend/css/jquery-ui.css')}}">
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/dataTables.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
<script src="{{asset('public/backend/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('public/backend/js/simple.money.format.js')}}"></script>
<style type="text/css">
	.top-nav ul.top-menu>li>a{
		background:#d51a55 ;
	}
	.brand {
		background:#5454f3 ;
	}
	.sidebar-menu{
		background:#5454f3 ;
	}
</style>

</head>
<body>
<section id="container">
<!--header start-->
<header style="background:#5454f3;" class=" header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        SHOP PET
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/2.png')}}">
                <span class="username">
					<?php
						$name = Session::get('admin_name');
						if ($name) {
							echo $name;
						}
					?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
				<li>
                    <a class="sub-menu" href="{{URL::to('/information')}}">
                        <i class="fa fa-book"></i>
                        <span>Thông tin liên hệ website</span>
                    </a>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                        <li><a href="{{URL::to('/manage-slider')}}">Liệt kê slider</a></li>
                    </ul>
                </li>
				{{-- category-post --}}
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết</a></li>
						<li><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài viết</a></li>
                       
                    </ul>
                </li> 
				{{-- thêm bài viết --}}
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
						<li><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
                       
                    </ul>
                </li> 
                {{-- category-product --}}
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sẩn phẩm</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sẩn phẩm</a></li>
                       
                    </ul>
                </li>

                    {{-- Combo --}}
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Combo đi kèm thuê pet</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-combo')}}">Thêm combo</a></li>
						<li><a href="{{URL::to('/all-combo')}}">Liệt kê combo</a></li>
                       
                    </ul>
                </li>
				
				{{-- brand-product --}}
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sẩn phẩm</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sẩn phẩm</a></li>
                       
                    </ul>
                </li>
				{{-- product --}}
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                       
                    </ul>
                </li> 

                {{-- product --}}
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm pet</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-pet')}}">Thêm pet</a></li>
						<li><a href="{{URL::to('/all-pet')}}">Liệt kê pet</a></li>
                       
                    </ul>
                </li> 
				{{-- Order --}}
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>
						
                    </ul>
                </li>
                {{-- Order thue --}}
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng pet cho thuê</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order-thue')}}">Danh sách pet cho thuê</a></li>
						
                    </ul>
                </li>
				{{-- coupon --}}
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
						<li><a href="{{URL::to('/list-coupon')}}">Liệt kê mã giảm giá</a></li>
                    </ul>
                </li> 
				{{-- Bình luận --}}
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bình luận</span>
                    </a>
                    <ul class="sub">
						
						<li><a href="{{URL::to('/comment')}}">Liệt kê bình luận</a></li>
                       
                    </ul>
                </li>
				{{-- delivery --}}
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Vận chuyển</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/delivery')}}">Quản lý phí vận chuyển</a></li>
						
                    </ul>
                </li>  
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')
	</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2024 PetShop. All rights reserved | PetShop </p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('public/backend/js/dataTables.js')}}"></script>
<script rel="stylesheet" src="{{asset('public/backend/js/jquery-ui.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script>
	$('.price_format').simpleMoneyFormat();
	
</script>
<script >
	$(document).ready(function(){
		
		fecth_delivery();

		function fecth_delivery(){
			var _token = $('input[name = "_token"]').val();
			$.ajax({
					url : '{{url('/select-feeship')}}',
					method : 'POST',
					data:{_token:_token},
					success:function(data){
						$('#load_delivery').html(data);
					}
				});

		}
		$(document).on('blur','.fee_feeship_edit',function(){
			var feeship_id = $(this).data('feeship_id');
			var fee_value = $(this).text();
			var _token = $('input[name = "_token"]').val();
			// alert(feeship_id);
			// alert(fee_value);
			$.ajax({
					url : '{{url('/update-delivery')}}',
					method : 'POST',
					data:{feeship_id:feeship_id,fee_value:fee_value,_token:_token},
					success:function(data){
						fecth_delivery();
					}
				});
		});
			$('.add_delivery').click(function(){
				var city = $('.city').val();
				var province = $('.province').val();
				var wards = $('.wards').val();
				var fee_ship = $('.fee_ship').val();
				var _token = $('input[name = "_token"]').val();
				// alert(city);
				// alert(province);
				// alert(wards);
				// alert(fee_ship);
				$.ajax({
					url : '{{url('/insert-delivery')}}',
					method : 'POST',
					data:{city:city,province:province,wards:wards,fee_ship:fee_ship,_token:_token},
					success:function(data){
						fecth_delivery();
					}
				});
			});
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
					url : '{{url('/select-delivery')}}',
					method : 'POST',
					data:{action:action,ma_id:ma_id,_token:_token},
					success:function(data){
						$('#'+result).html(data);
					}
				});
			
			});
		
	})
</script>
<script>
	$(function(){
		$("#start_coupon").datepicker({
			prevText:"Tháng trước",
			nextText:"Tháng sau",
			dateFormat:"dd/mm/yy",
			dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
			duration:"slow"
		});
		$("#end_coupon").datepicker({
			prevText:"Tháng trước",
			nextText:"Tháng sau",
			dateFormat:"dd/mm/yy",
			dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
			duration:"slow"
		});
	});
</script>
<script>
	$('.comment_status_btn').click(function(){
		var comment_status = $(this).data('comment_status');
		var comment_id = $(this).data('comment_id');
		var comment_product_id = $(this).attr('id');
		if(comment_status ==0){
			var alert = 'Duyệt thành công';
		}
		else{
			var alert = 'Bỏ duyệt thành công';
		}
		$.ajax({
			url : '{{url('/allow-comment')}}',
			method :'POST',
			
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
			data:{comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},		
			success:function(data){
				location.reload();
				$('#notify_comment').html('<span class="text text-alert">'+alert+'</span>')
			}
		});
	});
	$('.btn-reply-comment').click(function(){
		var comment_id = $(this).data('comment_id');
		var comment = $('.reply_comment_' + comment_id).val();
		
		var comment_product_id = $(this).data('product_id');

		
		// alert(comment);
		// alert(comment_id);
		// alert(comment_product_id);
		
		
		$.ajax({
			url : '{{url('/reply-comment')}}',
			method :'POST',
			
			headers:{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
			data:{comment:comment,comment_id:comment_id,comment_product_id:comment_product_id},		
			success:function(data){
				location.reload();
				$('.reply_comment_'+ comment_id).val('');
				$('#notify_comment').html('<span class="text text-alert">Trả lời bình luận thành công</span>')
			}
		});
	});
</script>
<script>
	$(document).ready( function () {
    	$('#myTable').DataTable();
	});
</script>
{{-- admin Thống kê doanh số --}}

<script>
	$(document).ready(function(){
		var donut = Morris.Donut({
			element: 'donut',
			resize: true,
			colors: [
				'#ce616a',
				'#61a1ce',
				'#ce8f61',
				'#4842f5'
			],
			data: [
				{label:"Sản phẩm", value:<?php echo $products ?>},
				{label:"Bài viết", value:<?php echo $posts ?>},
				{label:"Đơn hàng", value:<?php echo $orders ?>},
				{label:"Khách hàng", value:<?php echo $customers ?>},
				
			]
		});

	});
</script>

<script>
	$(document).ready(function(){
		chart30daysorder();
		var chart = new Morris.Bar({
			
			element: 'myfirstchart',
			lineColors:['#819C79','#fc8710','#FF6541','#A4ADD3',],
			pointFillColors:['ffffff'],
			pointStrokeColors:['black'],
			fillOpacity:0.3,
			hideHover:'auto',
			parseTime:false,
			
			xkey: 'period',
			ykeys: ['order','sales','profit','quantity'],
			behaveLikeLine:true,
			labels:['Đơn hàng','Doanh số','Lợi nhuận','Số lượng']
		});
		function chart30daysorder(){
			var _token = $('input[name = "_token"]').val();
			$.ajax({
				url : '{{url('/days-order')}}',
				method :'POST',
				dataType:"JSON",
				data:{_token:_token},
				success:function(data){
					chart.setData(data);
				}
			});
		}
		//lọc 
		$('.dashboard-filter').change(function(){
			var dashboard_value = $(this).val();
			var _token = $('input[name = "_token"]').val();
			//alert(dashboard_value);
			$.ajax({
				url : '{{url('/dashboard-filter')}}',
				method :'POST',
				dataType:"JSON",
				data:{dashboard_value:dashboard_value,_token:_token},
				success:function(data){
					chart.setData(data);
				}
			});
		});

		$('#btn-dashborad-filter').click(function(){
			// alert('đã nhận');
			var _token = $('input[name = "_token"]').val();
			var form_data = $('#datepicker1').val();
			var to_data = $('#datepicker2').val();
			// alert(form_data);
			// alert(to_data);
			$.ajax({
				url : '{{url('/filter-by-date')}}',
				method :'POST',
				dataType:"JSON",
				data:{form_data:form_data,to_data:to_data,_token:_token},
				success:function(data){
					chart.setData(data);
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
<script>
	$(document).ready(function(){
		load_pet_gallery();
		function load_pet_gallery(){
			var pro_id = $('.pro_id').val();
			var _token = $('input[name = "_token"]').val();
			// alert(pro_id);
			$.ajax({
				url : '{{url('/select-pet-gallery')}}',
				method :'POST',
				data:{pro_id:pro_id,_token:_token},
				success:function(data){
					$('#load_pet_gallery').html(data);
				}
			});
		}
		$('#file').change(function(){
			var error = '';
			var flies = $('#file')[0].files;
			if(flies.length>6){
				error += '<p>Bạn chọn tối đa chỉ được 6 ảnh</p>'
			}else if(flies.length == ''){
				error += '<p>Bạn không được bỏ trống </p>'
			}else if(flies.size > 2000000 ){
				error += '<p>File không được lớn hơn 2MB </p>'
			}
			if(error == ''){

			}else{
				$('#file').val('');
				$('#error_gallery').html('<span class="text-danger">'+error+'</span>');
				return false;
			}
		});
	});	
</script>
<script>
	$(document).ready(function(){
		load_gallery();
		function load_gallery(){
			var pro_id = $('.pro_id').val();
			var _token = $('input[name = "_token"]').val();
			// alert(pro_id);
			$.ajax({
				url : '{{url('/select-gallery')}}',
				method :'POST',
				data:{pro_id:pro_id,_token:_token},
				success:function(data){
					$('#gallery_load').html(data);
				}
			});
		}
		$('#file').change(function(){
			var error = '';
			var flies = $('#file')[0].files;
			if(flies.length>6){
				error += '<p>Bạn chọn tối đa chỉ được 6 ảnh</p>'
			}else if(flies.length == ''){
				error += '<p>Bạn không được bỏ trống </p>'
			}else if(flies.size > 2000000 ){
				error += '<p>File không được lớn hơn 2MB </p>'
			}
			if(error == ''){

			}else{
				$('#file').val('');
				$('#error_gallery').html('<span class="text-danger">'+error+'</span>');
				return false;
			}
		});
		$(document).on('blur','.edit_gallery_name',function(){
			var gal_id = $(this).data('gal_id');
			var gal_text = $(this).text();
			var _token = $('input[name = "_token"]').val();
			$.ajax({
				url : '{{url('/update-gallery-name')}}',
				method :'POST',
				data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
				success:function(data){
					load_gallery();
					$('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
				}
			});
		});
		$(document).on('click','.delete-gallery',function(){
			var gal_id = $(this).data('gal_id');
			var _token = $('input[name = "_token"]').val();
			if(confirm('Bạn có muốn xoá hình ảnh nầy không ???')){
				$.ajax({
					url : '{{url('/delet-gallery')}}',
					method :'POST',
					data:{gal_id:gal_id,_token:_token},
					success:function(data){
						load_gallery();
						$('#error_gallery').html('<span class="text-danger">Xoá hình ảnh thành công</span>');
					}
				});
			}
		});
		$(document).on('change','.file_image',function(){
			var gal_id = $(this).data('gal_id');
			var image = document.getElementById('file-'+gal_id).files[0];
			
			var form_data = new FormData();

			form_data.append("file",document.getElementById('file-'+gal_id).files[0]);
			form_data.append('gal_id',gal_id);

			
				$.ajax({
					url : '{{url('/update-gallery-image')}}',
					method :'POST',
					headers:{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
					data:form_data,
					contentType:false,
					cache:false,
					processData:false,
					success:function(data){
						load_gallery();
						$('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
					}
				});
			
		});
	});
</script>


<script type="text/javascript">
 
    function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
         
  
</script>
<script>
	$('.update_quantity_order').click(function(){
		var order_prodcut_id = $(this).data('product_id');
		var order_qty = $('.order_qty_' + order_prodcut_id).val();
		var order_code = $('.order_code').val();

		var _token = $('input[name = "_token"]').val();
		// alert(order_prodcut_id);
		// alert(order_qty);
		// alert(order_code);
		$.ajax({
			url : '{{url('/update-qty')}}',
			method : 'POST',
			data:{_token:_token,order_prodcut_id:order_prodcut_id,order_qty:order_qty,order_code,order_code},
			success:function(){
				alert('cập nhật số lượng thành công');
				location.reload();
			}
		});
	});
</script>


<script>
	$('.pet_thue_trang_thai').change(function(){
		var pet_thue_trang_thai = $(this).val();
		var pet_id = $(this).attr('id');
		var _token = $('input[name = "_token"]').val();

		$.ajax({
				url : '{{url('/update-tinh-trang')}}',
				method : 'POST',
				data:{_token:_token,pet_thue_trang_thai:pet_thue_trang_thai,pet_id:pet_id},
				success:function(){
					alert('Thay đổi tình trạng đơn hàng thành công');
					location.reload();
				}
			});
		
	});
</script>

<script>
	$('.order_details_thue').change(function(){
		var order_thue_status = $(this).val();
		var order_id = $(this).attr('id');
		var _token = $('input[name = "_token"]').val();
		$.ajax({
				url : '{{url('/update-tinh-trang')}}',
				method : 'POST',
				data:{_token:_token,order_thue_status:order_thue_status,order_id:order_id},
				success:function(){
					alert('Thay đổi tình trạng đơn hàng thành công');
					location.reload();
				}
			});
		

	});
</script>
<script>
	$('.order_details').change(function(){
		var order_status = $(this).val();
		var order_id = $(this).attr('id');

		var _token = $('input[name = "_token"]').val();
		//alert(order_id);
		//lấy ra số lượng
		quantity = [];
		$("input[name = 'product_sales_quantity']").each(function(){
			quantity.push($(this).val());
		});
		//lấy ra product id
		order_prodcut_id = [];
		$("input[name = 'order_prodcut_id']").each(function(){
			order_prodcut_id.push($(this).val());
		});
		j = 0;
		for(i = 0;i < order_prodcut_id.length; i++){
			//Số lượng khách đặt
			var order_qty = $('.order_qty_' + order_prodcut_id[i]).val();
			//Số lượng tồn kho
			var order_qty_storage = $('.order_qty_storage_' + order_prodcut_id[i]).val();
			// alert(order_qty);
			// alert(order_qty_storage);
			if(parseInt(order_qty) > parseInt(order_qty_storage)){
				j = j+1;
				if(j == 1){
					alert('Số lượng trong kho không đủ');
				}
				//alert('Số lượng trong kho không đủ');
				$('.color_qty_' + order_prodcut_id[i]).css('background','#000');
			}

		}
		if(j == 0){
			
			$.ajax({
				url : '{{url('/update-order-qty')}}',
				method : 'POST',
				data:{_token:_token,order_status:order_status,order_id:order_id,quantity:quantity,order_prodcut_id:order_prodcut_id},
				success:function(){
					alert('Thay đổi tình trạng đơn hàng thành công');
					location.reload();
				}
			});
		}
		
	});
</script>
<script>
	$.validate({});
</script>
<script>
	CKEDITOR.replace('ckeditor');
	CKEDITOR.replace('ckeditor1');
	CKEDITOR.replace('ckeditor2');
	CKEDITOR.replace('ckeditor3');
	CKEDITOR.replace('ckeditor4');
</script>

<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
