
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
									$shipping_id = Session::get('shipping_id');
									if($customer_id != NULL && $shipping_id == NULL){
								?>
									<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thang toán</a></li>
									 <li><a href="{{URL::to('/checkout-thue')}}"><i class="fa fa-star"></i>Thanh Toán thuê Pet</a></li> 
								<?php 
									}elseif($customer_id != NULL && $shipping_id != NULL){
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
								<li><a href="{{URL::to('/gio-hang-thue')}}"><i class="fa fa-star"></i> Giỏ hàng thuê Pet</a></li> 

								@php 
									$customer_id = Session::get('customer_id');
									if($customer_id != NULL){
								@endphp
									<li><a href="{{URL::to('history')}}"><i class="fa fa-bell"></i> Lịch sữ mua hàng</a></li>
								@php
									}
								@endphp

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
					<div class="col-sm-7"style="padding-left: 130px;padding-right: 0px;">
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
										<li class="panel-title"><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand -> brand_slug)}}"> <span class="pull-right"></span>{{$brand -> brand_name}}</a></li>
											
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
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							@php
								$i = 0;
							@endphp
							@foreach ($slider as $key => $slide)
								@php
									$i++;
								@endphp
							<div class="item {{$i == 1 ? 'active' : ''}}">
								
								{{-- <div class="col-sm-6">
									<h1><span>WIND</span>-SHOP</h1>
									<h2>Free PetShop Template</h2>
									<p>{{$slide -> slider_desc}}</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div> --}}

								<div class="col-sm-12">
									<img alt="{{$slide -> slider_desc}}"src="public/uploads/banner/{{ $slide -> slider_image}}" height="500" width="1280">
								</div>
							</div>
							@endforeach
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="left-sidebar">
						 <h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach ($category as $key => $cate)
							<div class="panel panel-default">
								@if ($cate -> category_parent ==0 )
							
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{$cate -> slug_category_product}}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$cate -> category_name}}
										</a>
									</h4>
								</div>
								<div id="{{$cate -> slug_category_product}}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@foreach ($category as $key => $cate_sub)
												@if ($cate_sub -> category_parent == $cate -> category_id)
													<li>
														<a href="{{URL::to('/danh-muc-san-pham/'.$cate_sub -> slug_category_product)}}">
															{{$cate_sub -> category_name}}
														</a>
													</li>
												@endif
											@endforeach
										</ul>
									</div>
								</div>
								@endif
							</div>
							@endforeach
						</div><!--/category-products--> 
						<div class="brands_products">
							<h2>Sản phẩm yêu thích</h2>
								<div class="brands-name">
									<div id="row_wishlist" class="row"></div>
								</div>
							
						</div>
						{{-- <div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu sản phẩm</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach ($brand as $key => $brand)
									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand -> brand_id)}}"> <span class="pull-right"></span>{{$brand -> brand_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div><!--/brands_products--> --}}
						
						{{-- <div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range--> --}}
						
						{{-- <div class="shipping text-center"><!--shipping-->
							<img src="{{('public/frontend/images/home/shipping.jpg')}}" alt="" />
						</div><!--/shipping--> --}}
					
					</div>
				</div>
				
				<div class="col-sm-10 padding-right">
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
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/home/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								{{-- <p>Circle of Hands</p>
								<h2>24 DEC 2014</h2> --}}
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/home/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								{{-- <p>Circle of Hands</p>
								<h2>24 DEC 2014</h2> --}}
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/home/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								{{-- <p>Circle of Hands</p>
								<h2>24 DEC 2014</h2> --}}
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{('public/frontend/images/home/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								{{-- <p>Circle of Hands</p>
								<h2>24 DEC 2014</h2> --}}
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{('public/frontend/images/home/map.png')}}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
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
					<p class="pull-left">Copyright ©PetShop Inc. All rights reserved.</p>
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
	{{-- Yêu thích --}}
	<script>
		function view(){
			if(localStorage.getItem('data') != null){
				var data = JSON.parse(localStorage.getItem('data'));
				data.reverse();
				document.getElementById('row_wishlist').style.overflow = 'scroll';
				document.getElementById('row_wishlist').style.height = '500px';
				for(i=0;i<data.length;i++){
					var name = data[i].name;
					var price = data[i].price;
					var image = data[i].image;
					var url = data[i].url;
					$("#row_wishlist").append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img src="'+image+'" width="100%"></div><div  class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color:#FE980F">'+price+' VNĐ</p><a href="'+url+'">Đặt hàng</a></div></div>');
				}
			}
		}
		view();
		function add_wishlist(clicked_id){
			
			var id =clicked_id;
			// alert(id);
			var name = document.getElementById('wishlist_prodcutname'+id).value;
			var price = document.getElementById('wishlist_prodcutprice'+id).value;
			var image = document.getElementById('wishlist_prodcutimage'+id).src;
			var url = document.getElementById('wishlist_prodcuturl'+id).href;
			// alert(name);
			// alert(price);
			// alert(image);
			// alert(url);
			var newItem = {
				'url':url,
				'id':id,
				'name':name,
				'price':price,
				'image':image
			}
			if(localStorage.getItem('data') == null){
				localStorage.setItem('data','[]');
			}
			var old_data = JSON.parse(localStorage.getItem('data'));
			
			var matches = $.grep(old_data,function(obj){
				return obj.id ==id;
			});
			if(matches.length){
				alert('Sản phẩm bạn đã yêu thích, nên không thể thêm')
			}else{
				old_data.push(newItem);
				$("#row_wishlist").append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img src="'+newItem.image+'" width="100%"></div><div  class="col-md-8 info_wishlist"><p>'+newItem.name+'</p><p style="color:#FE980F">'+newItem.price+'</p><a href="'+newItem.url+'">Đặt hàng</a></div></div>');
			}
			localStorage.setItem('data',JSON.stringify(old_data));
		}
	</script>
	{{-- tabs product --}}
	<script>
		$(document).ready(function(){
			var cate_id = $('.tabs_pro').data('id');
			var _token = $('input[name = "_token"]').val();
			$.ajax({
				url: '{{url('/product-tabs')}}',
				method: 'POST',
				data: {cate_id:cate_id,_token:_token},
						
				success:function(data){
					$("#tab_product").html(data);
							
				}
			});
			$('.tabs_pro').click(function(){
				var cate_id = $(this).data('id');
				// alert(cate_id);
				var _token = $('input[name = "_token"]').val();
				$.ajax({
					url: '{{url('/product-tabs')}}',
					method: 'POST',
					data: {cate_id:cate_id,_token:_token},
							
					success:function(data){
						$("#tab_product").html(data);
								
					}
				});
			});

		});
	</script>
	{{-- add-to-cart-quickview --}}
	<script type="text/javascript">
		
			$(document).on('click','.add-to-cart-quickview' ,function(){
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
						
						beforeSend:function(){
							$("#beforsend_quckview").html("<p class='text text-primary'> Đang thêm sản phẩm vào giỏ hàng...</p>");
						},
						success:function(){
							$("#beforsend_quckview").html("<p class='text text-success'> Sản phẩm đã thêm vào giỏ hàng</p>");
							
						}
					});
				}
				
			});
		$(document).on('click','.redirect-cart',function(){
			window.location.href =" {{url('/gio-hang')}}";
		})

	</script>
	<script>
		$('.xemnhanh').click(function(){
			var product_id =$(this).data('id_product');
			var _token = $('input[name = "_token"]').val();
			$.ajax({
					url : '{{url('/quickview')}}',
					method : 'POST',
					dataType: 'JSON',
					data:{product_id:product_id,_token:_token},
					success:function(data){
						$('#product_quickview_title').html(data.product_name);
						$('#product_quickview_id').html(data.product_id);
						$('#product_quickview_price').html(data.product_price);
						$('#product_quickview_image').html(data.product_image);
						$('#product_quickview_gallrey').html(data.product_gallrey);
						$('#product_quickview_desc').html(data.product_desc);
						$('#product_quickview_content').html(data.product_content);
						$('#product_quickview_button').html(data.product_button);
					}
				});
		});
	</script>
	<script>
		$('#keywords').keyup(function(){
			var query = $(this).val();
			if(query != ''){
				var _token = $('input[name = "_token"]').val();
				$.ajax({
					url : '{{url('/autocomplete-ajax')}}',
					method : 'POST',
					data:{query:query,_token:_token},
					success:function(data){
						$('#sarech_ajax').fadeIn();
						$('#sarech_ajax').html(data);
					}
				});
			}else{
				$('#sarech_ajax').fadeOut();
			}
		});
		$(document).on('click','.li_serach_ajax',function(){
			$('#keywords').val($(this).text());
			$('#sarech_ajax').fadeOut();
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
	{{-- add-to-cart home và chi tiết sản phẩm --}}
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