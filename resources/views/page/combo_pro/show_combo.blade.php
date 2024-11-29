 @extends('show_layout_thue')
@section('content')
 <div class="category-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                
            </ul>
        </div>
        <div id="tab_product"></div>
       
    </div><!--/category-tab-->
    <h2 class="title text-center">Combo đi kèm thuê pet</h2>
    @foreach ($all_combo as $key => $product)
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
                            </style>
                            <button type="button" class="btn btn-default add-to-cart-thue" data-id_thue="{{$product -> pet_id}}" name="add-to-cart-thue">Thuê pet</button>
                            <button type="button" data-toggle="modal" data-target="#xemnhanhthue" value="Xem nhanh" class="btn btn-default  xemnhanhthue" data-id_pet="{{$product -> pet_id}}" 
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
    @endsection
