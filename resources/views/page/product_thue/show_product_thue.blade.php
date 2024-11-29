@extends('show_layout_thue')
@section('content')
<div class="features_items"><!--features_items-->
    
    <div class="category-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                
            </ul>
        </div>
        <div id="tab_product"></div>
       
    </div><!--/category-tab-->
    <h2 class="title text-center">Pet cho thuê</h2>
    @foreach ($all_product_thue as $key => $product)
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">

                    <div class="productinfo text-center">
                        <form >
                            @csrf
                            <input type="hidden" class="cart_thue_id_{{$product -> pet_id}}" value="{{$product -> pet_id}}">
                            <input type="hidden" id="wishlist_petname{{$product -> pet_id}}" value="{{$product -> pet_name}}" class="cart_thue_name_{{$product -> pet_id}}">
                            <input type="hidden" value="{{$product -> pet_image}}" class="cart_thue_image_{{$product -> pet_id}}">
                            <input type="hidden" id="wishlist_prodcutprice{{$product -> pet_id}}" value="{{$product -> rental_price_per_day}}" class="cart_thue_price_{{$product -> pet_id}}">

                            <input type="hidden" id="wishlist_petprice{{$product -> pet_id}}" value="{{$product -> pet_slug}}" class="cart_thue_slug_{{$product -> pet_id}}">

                            <input type="hidden" class="cart_product_gender_{{ $product->pet_id }}" value="{{ $product->pet_gender }}">


                            <input type="hidden" value="{{$product -> pet_type}}" class="cart_thue_type_{{$product->pet_id}}">

                            <input type="hidden" value="{{$product -> pet_content}}" class="cart_thue_content_{{$product->pet_id}}">

                            <input type="hidden" value="{{$product -> pet_desc}}" class="cart_thue_desc_{{$product->pet_id}}">

                            <input type="hidden" value="1" class="cart_thue_qty_{{$product->pet_id}}">
                           
                            
                            <!-- <input type="hidden" value="1" class="cart_product_qty_{{$product -> pet_id}}"> -->
                             <a id="wishlist_prodcuturl{{$product -> pet_id}}" href="{{URL::to('/chi-tiet-thue/'.$product->pet_id)}}">
                                <img id="wishlist_prodcutimage{{$product -> pet_id}}" src="{{URL::to('public/uploads/product/'.$product -> pet_image)}}" alt="" />
                                <h2>{{number_format($product->rental_price_per_day,0,',','.').' VNĐ'}}</h2>
                                <p> Tên : {{$product -> pet_name}}</p>
                                <p>Màu sắc :{{$product -> pet_slug}}</p>
                                <p>Giống :{{$product -> pet_gender}}</p>       
                            </a>

                            <style>
                                .xemnhanhthue{
                                    background: #F5F5ED;
                                    border: 0 none;
                                    border-radius: 0;
                                    color: #696763;
                                    font-family: 'Roboto',sans-serif;
                                    font-size: 15px;
                                    margin-bottom: 25px;
                                }
                                .stylebut{
                                   background: #F5F5ED;
                                    border: 0 none;
                                    border-radius: 0;
                                    color: #696763;
                                    font-family: 'Roboto',sans-serif;
                                    font-size: 15px;
                                    margin-bottom: 25px; 
                                }
                            </style>
                            <button type="button" class="btn btn-default add-to-cart-thue stylebut" data-id_thue="{{$product -> pet_id}}" name="add-to-cart-thue">Thuê pet</button>
                            <button type="button" data-toggle="modal" data-target="#xemnhanhthue" value="Xem nhanh" class="btn btn-default   xemnhanhthue" data-id_pet="{{$product -> pet_id}}" 
                                name="add-to-cart-thue">Xem nhanh</button>
                          
                         <!--   <a href="{{URL::to('/chi-tiet-thue/'.$product->pet_id)}}">
                             <button type="button" class="btn btn-default add-to-cart"  name="">Thuê</button> -->  

                           </a>
                           
                            <!-- <button type="button" data-toggle="modal" data-target="#xemnhanh" value="Xem nhanh" class="btn btn-default xemnhanh" data-id_product="{{$product -> pet_id}}" 
                                name="add-to-cart">Xem nhanh</button> -->
                        </form>
                    </div>
                    
                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{number_format($product -> product_price).' '.'VNĐ'}}</h2>
                            <p>{{$product -> pet_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thuê</a>

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
 

                </ul>
            </div>
        </div>
    </div>

    @endforeach
</div><!--features_items-->
<!-- Modal Xem nhanh -->
<div class="modal fade" id="xemnhanhthue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    .texxt{
                        font-size: 25px;
                    }
                    span#product_quickview_title {

                        font-size: 30px;
                    }
                    .modal-title {
                            text-align: center;
                            margin: 0;
                            line-height: 1.428571429;
                        }
                    h5.modal-title.product_quickview_title{
                    text-align: center;
                    font-size: 20px;
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
                        <span id="product_quickview_image"></span>
                        <span id="product_quickview_gallery"></span>
                    </div>
                    <form>
                        @csrf
                        <div class="col-md-7 texxt">
                            <h2 class="quickview"><span id="product_quickview_title"></span></h2>
                            <p>Mã ID: <span id="product_quickview_id"></span></p>
                            <p>Loại thú cưng: <span id="product_quickview_type"></span></p>
                            <p>Số tuổi: <span id="product_quickview_age"></span></p>
                            <p>Giới tính: <span id="product_quickview_gender"></span></p>
                            <h2 style="font-size: 35px; font-weight: bold; color: #FE980F">Giá sản phẩm: <span id="product_quickview_price"></span></h2>

                            <input type="hidden" name="productid_hidden" value="">
                            <p style="font-size: 35px;" class="quickview">Mô tả sản phẩm</p>
                            <span id="product_quickview_desc"></span>
                            <span id="product_quickview_content"></span>
                            <div id="product_quickview_button"></div>
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
         {!!$all_product_thue->links('pagination::bootstrap-4')!!}
    </ul> 
</div>

    
    <div class="category-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                
            </ul>
        </div>
        <div id="tab_product"></div>
       
    </div><!--/category-tab-->
    <h2 class="title text-center">Combo đi kèm thuê pet</h2>
    @foreach ($all_product_combo as $key => $pro)
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">

                    <div class="productinfo text-center">
                        <form >
                            @csrf
                            <input type="hidden" class="cart_combo_id_{{$pro -> combo_id}}" value="{{$pro -> combo_id}}">
                            <input type="hidden" id="wishlist_petname{{$pro -> combo_name}}" value="{{$pro -> combo_name}}" class="cart_combo_name_{{$pro -> combo_id}}">
                            <input type="hidden" value="{{$pro ->combo_image}}" class="cart_combo_image_{{$pro -> combo_id}}">
                            <input type="hidden" id="wishlist_prodcutprice{{$pro -> combo_id}}" value="{{$pro -> combo_gia}}" class="cart_combo_price_{{$pro ->combo_id}}">

                          
              
                             <!-- <a id="wishlist_prodcuturl{{$product -> pet_id}}" href="{{URL::to('/chi-tiet-thue/'.$product->pet_id)}}"> -->
                                <img id="wishlist_prodcutimage{{$pro-> combo_id}}" src="{{URL::to('public/uploads/product/'.$pro -> combo_image)}}" alt="" />
                                <h2>{{number_format($pro->combo_gia,0,',','.').' VNĐ'}}</h2>
                                <p>  {{$pro -> combo_name}}</p>
                                      
                            </a>
                            
                            <style>
                                .combo{
                                    background: #F5F5ED;
                                    border: 0 none;
                                    border-radius: 0;
                                    color: #696763;
                                    font-family: 'Roboto',sans-serif;
                                    font-size: 15px;
                                    margin-bottom: 25px;
                                }

                            </style>
                            <button type="button" class="btn btn-default add-to-cart-combo combo " data-id_combo="{{$pro -> combo_id}}" name="add-to-cart-combo">Mua combo</button>    
                          
                         <!--   <a href="{{URL::to('/chi-tiet-thue/'.$product->pet_id)}}">
                             <button type="button" class="btn btn-default add-to-cart"  name="">Thuê</button> -->  

                           </a>
                           
                            <!-- <button type="button" data-toggle="modal" data-target="#xemnhanh" value="Xem nhanh" class="btn btn-default xemnhanh" data-id_product="{{$product -> pet_id}}" 
                                name="add-to-cart">Xem nhanh</button> -->
                        </form>
                    </div>
                    
                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{number_format($product -> product_price).' '.'VNĐ'}}</h2>
                            <p>{{$product -> pet_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thuê</a>

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
 

                </ul>
            </div>
        </div>
    </div>

    @endforeach
</div><!--features_items-->
<!-- Modal Xem nhanh -->

<div class="col-sm-7 text-right text-center-xs">  
    <ul class="pagination pagination-sm m-t-none m-b-none">
         {!!$all_product_thue->links('pagination::bootstrap-4')!!}
    </ul> 
</div>
@endsection