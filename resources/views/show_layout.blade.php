<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- SEO --}}
    <meta name="description" content="{{$meta_decs}}">
    <meta name="author" content="">
	<meta name="keywords" content="{{$meta_keywords}}">
	<meta name="robots" content="INDEX,FOLLOW">
	<link  rel="canonical" href="{{$url_canonical}}" />
	<link  rel="icon" type="image/x-icon" href="" />
	{{-- END-SEO --}}
    <title>{{$meta_titel}}</title>
    
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('public/frontend/css/jquery-ui.css')}}">
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
								<?php 
									$customer_id = Session::get('customer_id');
									
									if($customer_id != NULL ){
								?>
									<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thang toán</a></li>
								
								<?php 
									}else{
								?>
									<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Thang toán	</a></li>
								<?php 
									}
								?>
								
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								
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
                                    @foreach ($category as $key => $cate)
										@if ($cate -> category_parent ==0)
											<li><a href="{{URL::to('/danh-muc-san-pham/'.$cate -> slug_category_product)}}">{{$cate -> category_name}} </i></a></li>
										@endif		
									@endforeach
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Thương hiệu<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu" style="width: 150px">
                                    @foreach ($brand as $key => $brand)
										<li class="panel-title"><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand -> brand_slug)}}">{{$brand -> brand_name}}</a></li>
											
									@endforeach
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu" >
										@foreach ($category_post as $key => $catee_post)
											<li ><a href="{{URL::to('/danh-muc-bai-viet/'.$catee_post -> category_post_slug)}}">{{$catee_post -> category_post_name}}</a></li>
												
										@endforeach
										</ul>
								</li> 
								<li><a href="{{url('/lien-he')}}">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-5"style="padding-left: 0px;padding-right: 110px;">
						<form action="{{URL::to('/tim-kiem')}}"  method="POST">
							@csrf
							<div class="search_box pull-right">
								{{--autocomplete="off" <input type="text" name="keywords_submit"id="keywords"  placeholder="Tìm kiếm sản phẩm"/>
								<div id="sarech_ajax"></div> --}}
								<input type="text" name="keywords_submit"  placeholder="Tìm kiếm sản phẩm"/>
								<input type="submit" style="margin-top: 0px; color: #000;" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
							</div>
						</form>
					</div>
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
							@foreach ($category as $key => $cate)
								<ul class="nav nav-pills nav-stacked">
									@if ($cate -> category_parent == 0)
										<li><a href="{{URL::to('/danh-muc-san-pham/'.$cate -> slug_category_product)}}">
											{{$cate -> category_name}}</a>
										</li>
									@endif
								</ul>
							@endforeach
						</div> -->
					</div>
				 	<div class="col-sm-3">
						<div class="single-widget">
							<h2>Tin tức</h2>
							@foreach ($category_post as $key => $catee_post)
								<ul class="nav nav-pills nav-stacked">
									
										<li ><a href="{{URL::to('/danh-muc-bai-viet/'.$catee_post -> category_post_slug)}}">{{$catee_post -> category_post_name}}</a></li>
									
								</ul>
							@endforeach
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
	<script rel="stylesheet" src="{{asset('public/frontend/js/jquery-ui.js')}}"></script>
	<script src="{{asset('public/frontend/js/simple.money.format.js')}}"></script>
	{{-- <div id="fb-root"></div>
	<script async defer crossorigin="anonymous" 
	src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="ys333WJq">
	</script> --}}
	<script>
		$(document).ready(function(){
			$( "#slider-range" ).slider({
				orientation: "horizonto",
				range: true,
				
				min:{{$price_min}},
				max:{{$price_max}},
				values: [ {{$price_min}}, {{$price_max}} ],
				step:10000,
				slide: function( event, ui ) {
					$( "#amount_start" ).val(  ui.values[ 0 ]).simpleMoneyFormat();
					$( "#amount_end" ).val(  ui.values[ 1 ]).simpleMoneyFormat();
					$( "#start_price" ).val(  ui.values[ 0 ] );
					$( "#end_price" ).val(  ui.values[ 1 ] );
				}
			});
			$( "#amount_start" ).val( $( "#slider-range" ).slider( "values", 0 )).simpleMoneyFormat();
			$( "#amount_end" ).val( $( "#slider-range" ).slider( "values", 1 )).simpleMoneyFormat();
		});
	</script>
	<script>
		$(document).ready(function(){
			$('#sort').on('change',function(){
				var url = $(this).val();
				// alert(url);
				if(url){
					window.location = url;
				}
				return false;
			});
		});
	</script>
	<script>
		function remov_background(product_id){
			for(var count = 1;count<=5; count++ ){
				$('#'+product_id+'-'+count).css('color','#ccc');
			}
		}
		//hover chuột đánh giá sao
		$(document).on('mouseenter','.rating',function(){
			var index = $(this).data("index");
			var product_id = $(this).data('product_id');
			// alert(index);
			// alert(product_id);
			remov_background(product_id);
			for(var count = 1;count<=index; count++ ){
				$('#'+product_id+'-'+count).css('color','#ffcc00');
			}
		});
		//nhả chuột không đánh giá sao
		$(document).on('mouseleave','.rating',function(){
			var index = $(this).data("index");
			var product_id = $(this).data('product_id');
			var rating = $(this).data("rating");
			
			remov_background(product_id);
			for(var count = 1;count <= rating; count++ ){
				$('#'+product_id+'-'+count).css('color','#ffcc00');
			}
		});
		//click đánh giá sao
		$(document).on('click','.rating',function(){
			var index = $(this).data("index");
			var product_id = $(this).data('product_id');
			var _token = $('input[name = "_token"]').val();
			$.ajax({
					url : '{{url('/insert-rating')}}',
					method : 'POST',
					data:{index:index,product_id:product_id,_token:_token},
					success:function(data){
						if(data == 'done'){
							alert("Bạn đã đánh giá " +index+ " sao trên 5 sao");
						}else{
							alert("Lỗi đánh giá");
						}
						location.reload();
					}
				});
		});
	</script>
	<script>
		$(document).ready(function(){
			load_comment();

			function load_comment(){
				var product_id = $('.comment_prodcut_id').val();
				var _token = $('input[name = "_token"]').val();
				$.ajax({
					url : '{{url('/load-comment')}}',
					method : 'POST',
					data:{product_id:product_id,_token:_token},
					success:function(data){
						$('#comment_show').html(data);
					}
				});
			}
		
			$('.send-comment').click(function(){
				var product_id = $('.comment_prodcut_id').val();
				var comment_name = $('.comment_name').val();
				var comment_content = $('.comment_content').val();
				var _token = $('input[name = "_token"]').val();
				$.ajax({
						url : '{{url('/send-comment')}}',
						method : 'POST',
						data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},
						success:function(data){
							$('#notify_comment').html('<span class="text text-success">Bình luận thành công,bình luận đang chờ duyệt</span>');
							load_comment();
							$('#notify_comment').fadeOut(5000);
							$('.comment_name').val('');
							$('.comment_content').val('');
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
				var cart_product_quantity = $('.cart_product_quantity_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name = "_token"]').val();
				if(parseInt(cart_product_qty) > parseInt(cart_product_quantity)){
					alert('Làm ơn đặt nhỏ hơn ' +cart_product_quantity);
				}else{
					$.ajax({
					url: '{{url('/add-cart-ajax')}}',
					method: 'POST',
					data: {cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,
					cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
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
				}
				
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