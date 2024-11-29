@extends('show_layout')
@section('content')
@foreach ($product_details as $key => $value)
<div class="product-details"><!--product-details-->
    {{-- <div class="fb-like" data-href="{{$url_canonical}}"
     data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div> --}}
     <style>
        .lSSlideOuter .lSPager.lSGallery img {
            display: block;
            height: 90px;
            max-width: 100%;
        }
        li.active {
            border: 2px solid #FE980F;
        }

        .category-tab ul {
            background: #fff;
        }
     </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: none">
          <li class="breadcrumb-item"><a href="{{url('/')}}" style=" color: #FE980F">Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="{{url('/danh-muc-san-pham/'.$cate_slug)}}"style=" color: #FE980F">{{ $product_cate}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$meta_titel }}</li>
        </ol>
      </nav>
    <div class="col-sm-5" style=" padding-left: 280px;padding-right: 0px;">
        <ul id="imageGallery">
            @foreach ($gallery as $key => $gall)
                
           
            <li data-thumb="{{asset('public/uploads/gallery/'.$gall->gallery_image)}}" 
            data-src="{{asset('public/uploads/gallery/'.$gall->gallery_image)}}">
              <img width="100%" alt="{{$gall->gallery_name}}" src="{{asset('public/uploads/gallery/'.$gall->gallery_image)}}"/>
            </li> 
            @endforeach
            
          </ul>
         

    </div>
    
    <div class="col-sm-7"style=" padding-left: 189px;">
        
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$value -> product_name}}</h2>
            <p>Mã ID: {{$value -> product_id}}</p>
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{URL::to('/save-cart')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                      
            <span>
                <span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>
            
                <label>Số lượng:</label>
                <input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
                <input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
            </span>
            <input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
            </form>
            <p><b>Số lượng còn:</b> {{$value -> product_quantity}} sản phẩm </p>
            <p><b>Điều kiện:</b> New 100%</p>
            <p><b>Thương hiệu:</b> {{$value -> brand_name}}</p>
            <p><b>Danh mục:</b> {{$value -> category_name}}</p>
            <style>
                a.tags_style{
                    margin: 3px 2px;
                    border: 1px solid;
                    height: auto;
                    background: #428bca;
                    color: #ffff;
                    padding: 0px

                }
                a.tags_style:hover{
                    background: black;
                }
            </style>
            <fieldset>
                <legend>Tags</legend>
                <p><i class="fa fa-tag"></i>
                    @php
                        $tags = $value ->product_tags;
                        $tags = explode(",",$tags);
                    @endphp

                    @foreach ($tags as $tag)
                        <a href="{{url('/tags-t/'.$tag)}}" class="tags_style">{{$tag}}</a>
                    @endforeach
                </p>
            </fieldset>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->
{{-- <div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div> --}}
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li ><a href="#details" data-toggle="tab">Mô tả</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane " id="details" >
            <div class="col-sm-12">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfi ">
                           <p>{!!$value -> product_desc!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <div class="col-sm-12">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfi text-center">
                            <p>{!!$value -> product_content!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                {{-- <ul>
                    <li><a href=""><i class="fa fa-user"></i>admin</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2023</a></li>
                </ul> --}}
                <style>
                    .style_comment{
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background: #F0F0E9;
                        
                    }
                </style>
                <form >
                    @csrf
                    <input type="hidden" name="comment_prodcut_id" class="comment_prodcut_id" value="{{$value->product_id}}">
                    <div id="comment_show"></div>
                    
                </form>
                <p><b>Đánh giá sao: </b></p>
                <ul class="list-inline rating" title="Average Rating">
                    
                    @for ($count = 1; $count <= 5; $count++)
                        @php
                            if ($count <= $rating) {
                                $color = 'color: #ffcc00;';
                            } else {
                                $color = 'color: #ccc;';
                            }
                            
                        @endphp
                   
                    <li title="star_rating" id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}" 
                        data-product_id="{{$value->product_id}}" data-rating="{{$rating}}" class="rating" 
                        style="color: pointer ;{{$color}} font-size: 30px;">&#9733;

                    </li>
                    @endfor
                </ul>
                <p><b>Viết đánh giá của các bạn</b></p>
                <form action="#">
                    @csrf
                    <span>
                        <input style="width: 99.5%; margin-left: 0px" type="text" class="comment_name" placeholder="Nhập tên"/>
                    </span>
                    <textarea name="comment" class="comment_content" placeholder="Nhập nội dung"></textarea>
                    <div id="notify_comment"></div>
                    
                    <button type="button" class="btn btn-default pull-right send-comment">
                        Gửi bình luận
                    </button>
                   
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach ($relate as $key => $lienquan)	
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <form >
                                    @csrf
                                    <input type="hidden" value="{{$lienquan -> product_id}}" class="cart_product_id_{{$lienquan -> product_id}}">
                                    <input type="hidden" value="{{$lienquan -> product_name}}" class="cart_product_name_{{$lienquan -> product_id}}">
                                    <input type="hidden" value="{{$lienquan -> product_image}}" class="cart_product_image_{{$lienquan -> product_id}}">
                                    <input type="hidden" value="{{$lienquan -> product_price}}" class="cart_product_price_{{$lienquan -> product_id}}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{$lienquan -> product_id}}">
                                <a href="{{URL::to('chi-tiet-san-pham/'.$lienquan -> product_slug)}}">
                                    <img src="{{URL::to('public/uploads/product/'.$lienquan -> product_image)}}" alt="" />
                                    <h2>{{number_format($lienquan -> product_price).' '.'VNĐ'}}</h2>
                                    <p>{{$lienquan -> product_name}}</p>
                                </a>
                                {{-- <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$lienquan -> product_id}}" name="add-to-cart">Thêm vào giỏ hàng</button> --}}
                                </form>
                                {{-- <img src="{{URL::to('public/uploads/product/'.$lienquan -> product_image)}}" alt="" />
                                <h2>{{number_format($lienquan -> product_price).' '.'VNĐ'}}</h2>
                                <p>{{$lienquan -> product_name}}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>  --}}
                            </div>
                        </div>
                    </div> 
                </div>  
                @endforeach 
            </div>
            
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->
@endsection