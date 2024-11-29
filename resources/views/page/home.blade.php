@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <div class="category-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                @php
                    $i = 0;
                @endphp
                @foreach ($category_pro_tabs as $key => $cate_tab)
                    @php
                        $i++;
                    @endphp
                    <li class="tabs_pro {{$i == 1 ? 'active' : ''}}" data-id="{{ $cate_tab->category_id}}" ><a href="#tshirt" data-toggle="tab">{{ $cate_tab->category_name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div id="tab_product"></div>
        
    </div><!--/category-tab-->
    <h2 class="title text-center">Sản phẩm mới</h2>
	@foreach ($all_product as $key => $product)
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <form >
                            @csrf
                            <input type="hidden" value="{{$product -> product_id}}" class="cart_product_id_{{$product -> product_id}}">
                            <input type="hidden" id="wishlist_prodcutname{{$product -> product_id}}" value="{{$product -> product_name}}" class="cart_product_name_{{$product -> product_id}}">
                            <input type="hidden" value="{{$product -> product_image}}" class="cart_product_image_{{$product -> product_id}}">
                            <input type="hidden" value="{{$product -> product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                            <input type="hidden" id="wishlist_prodcutprice{{$product -> product_id}}" value="{{$product -> product_price}}" class="cart_product_price_{{$product -> product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$product -> product_id}}">
                            <a id="wishlist_prodcuturl{{$product -> product_id}}" href="{{URL::to('chi-tiet-san-pham/'.$product -> product_slug)}}">
                                <img id="wishlist_prodcutimage{{$product -> product_id}}" src="{{URL::to('public/uploads/product/'.$product -> product_image)}}" alt="" />
                                <h2>{{number_format($product->product_price,0,',','.').' VNĐ'}}</h2>
                                <p>{{$product -> product_name}}</p>
                            </a>
                            <style>
                                .xemnhanh{
                                    background: #F5F5ED;
                                    border: 0 none;
                                    border-radius: 0;
                                    color: #696763;
                                    font-family: 'Roboto',sans-serif;
                                    font-size: 15px;
                                    margin-bottom: 25px;
                                }
                            </style>
                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product -> product_id}}" name="add-to-cart">Thêm vào giỏ</button>
                            
                            <button type="button" data-toggle="modal" data-target="#xemnhanh" value="Xem nhanh" class="btn btn-default xemnhanh" data-id_product="{{$product -> product_id}}" 
                                name="add-to-cart">Xem nhanh</button>
                        </form>
                    </div>
                    
                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{number_format($product -> product_price).' '.'VNĐ'}}</h2>
                            <p>{{$product -> product_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                        </div>
                    </div> --}}
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <style>
                        ul.nav-pills.nav-justified li{
                            text-align: center;
                            font-size: 16px;
                        }
                        .button_wishlist{
                            border: none;
                            background: #fff;
                            color: #b3afa8;
                        }
                        ul.nav-pills.nav-justified i{
                            color: #b3afa8
                        }
                        .button_wishlist:hover{
                            color: #FE980F;
                        }
                        .button_wishlist:focus{
                            border: none;
                            outline: none;
                        }
                    </style>
                    <li>
                        <i class="fa fa-plus-square"></i><button class="button_wishlist" id="{{$product->product_id}}"
                            onclick="add_wishlist(this.id);"><span>Yêu thích</span></button>
                        
                    {{-- <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a>--}}</li> 
                </ul>
            </div>
        </div>
    </div>
   
	@endforeach
</div><!--features_items-->
<!-- Modal Xem nhanh -->
<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <span id="product_quickview_title"></span>
          
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <style>
                h5.modal-title.product_quickview_title{
                    text-align: center;
                    font-size: 25px;
                    color: brown;
                }
                p.quickview{
                    font-size: 20px;
                    color: brown;
                }
                span#product_quickview_content img{
                    width: 100%;
                }
                
                    @media screen and (min-width: 768px){
                        .modal-dialog{
                            width:700px
                        }
                        .modal-sm{
                            width: 350px;
                        }
                    }
                    @media screen and (min-width: 992px){
                        .modal-lg{
                            width: 1200px;
                        }
                    }
                
            </style>
            <div class="row">
                <div class="col-md-5">
                    {{-- <span id="product_quickview_image"></span> --}}
                    <span id="product_quickview_gallrey"></span>
                </div>
                <form >
                    @csrf
                    <div id="product_quickview_value"></div>
                    <div class="col-md-7">
                        
                        <h2 class="quickview"><span id="product_quickview_title"></span></h2>
                        <p>Mã ID: <span id="product_quickview_id"></span></p>
                        <span>
                            <h2 style="font-size: 20px; font-weight: bold; color: #FE980F">Giá sản phẩm: <span id="product_quickview_price"></span></h2>
                            <label>Số lượng: </label>
                            <input name="qty" type="number" min="1" class="cart_product_qty_" value="1">
                            <input type="hidden" name="productid_hidden" value="">

                        </span><br>
                        <p class="quickview" >Mô tả sản phẩm</p>
                        <fieldset>
                            <span style="width: 100%;" id="product_quickview_desc"></span>
                            <span style="width: 100%;" id="product_quickview_content"></span>
                        </fieldset>
                        <div id="product_quickview_button"></div> 
                        <div id="beforsend_quckview"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-default redirect-cart">Đi tới sản phẩm</button>
            </div>
        </div>
      </div>
    </div>
  </div>
<div class="col-sm-7 text-right text-center-xs">  
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {!!$all_product->links('pagination::bootstrap-4')!!}
    </ul>
</div>
@endsection