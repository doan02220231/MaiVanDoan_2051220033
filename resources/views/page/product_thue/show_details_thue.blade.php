@extends('show_layout_thue')
@section('content')
@foreach($details_thue as $key => $value)
<div class="col-sm-12 padding-right">
				<div class="product-details " style="width: 96%; margin: 0 auto;"><!--product-details-->
                        <div class="col-sm-5">  
                            
                            <div class="view-product">
                                <img  src="{{URL::to('/public/uploads/product/'.$value->pet_image)}}"  style="height: 600px; width: 500px;" alt="">
                               
                            </div>
                            <div id="similar-product" class="carousel slide "  data-ride="carousel" >
                                  <!-- Wrapper for slides -->
                                    <div id="carouselExample" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($gallery_pet->chunk(3) as $key => $gallery_chunk)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="d-flex justify-content-center">
                                                @foreach($gallery_chunk as $gal)
                                                    <img alt="{{ $gal->gallery_pet_name }}" 
                                                         src="{{ asset('public/uploads/gallery/'.$gal->gallery_pet_image) }}" 
                                                         style="height: 110px; width: 150px; margin: 5px;" />
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            </div>
                           
                        </div>
                        
                            <div class=" col-sm-6 product-information" style=""><!--/product-information-->
                                <img src="" class="newarrival" alt="">
                                 <form>
                                   @csrf
                            <input type="hidden" class="cart_thue_id_{{$value -> pet_id}}" value="{{$value -> pet_id}}">
                            <input type="hidden" id="wishlist_prodcutname{{$value -> pet_id}}" value="{{$value -> pet_name}}" class="cart_thue_name_{{$value -> pet_id}}">
                            <input type="hidden" value="{{$value -> pet_image}}" class="cart_thue_image_{{$value -> pet_id}}">
                            <input type="hidden" id="wishlist_prodcutprice{{$value -> pet_id}}" value="{{$value -> rental_price_per_day}}" class="cart_thue_price_{{$value -> pet_id}}">

                            <input type="hidden" class="cart_product_gender_{{ $value->pet_id }}" value="{{ $value->pet_gender }}">
                            <input type="hidden" id="wishlist_prodcutprice{{$value -> pet_id}}" value="{{$value -> pet_slug}}" class="cart_thue_slug_{{$value -> pet_id}}">

                            <input type="hidden" value="{{$value -> pet_type}}" class="cart_thue_type_{{$value->pet_id}}">

                            <input type="hidden" value="{{$value -> pet_content}}" class="cart_thue_content_{{$value->pet_id}}">

                            <input type="hidden" value="{{$value -> pet_desc}}" class="cart_thue_desc_{{$value->pet_id}}">

                            <input type="hidden" value="1" class="cart_thue_qty_{{$value->pet_id}}">
                                <h2><p><b>Tên vật nuôi: {{$value->pet_name}}</b></p></h2>
                                <h4><p><b>Màu sắc:</b>   {{$value->pet_slug}}</p></h4>
                                <h4><p>Mã ID: {{$value->pet_id}}</p></h4>
                                <img src="" alt="">

                                <span>
                                    <span> Giá thuê 1 ngày :{{number_format($value->rental_price_per_day, 0,',','.')}}VNĐ</span>
                                    <input name="productid_hidden" type="hidden" value="16">
                                </span>

                                <h4><p><b>Loại thú cưng:</b>   {{$value->pet_type}}</p></h4>
                               <h4> <p><b>Giới tính:</b>   {{$value->pet_gender}}</p></h4>
                              <h4><p> <b>Tuổi:</b>  {{$value->pet_age}}</p></h4>
                             <p style="font-size: 17px;"><b>Mô tả cún:</b>   {{$value->pet_desc}}</p>
                                
                                <a href=""><img src="" class="share img-responsive" alt=""></a>
                               
                                 <button type="submit" class="btn btn-default add-to-cart-thue" style="background: yellow;" data-id_thue="{{$value -> pet_id}}" name="add-to-cart-thue">Thêm vào giỏ hàng thuê</button>
                                </form>
                            </div><!--/product-information-->
  
                        </div>
                      <div class="content" style="width: 90%; margin:0 auto   ;" >
                       <h2 style="margin-top: 50px;" >Mô tả chi tiết</h2>

                       <p style="font-size: 20px">  {{$value->pet_content}}</p>     
                      </div>
                    
</div><!--/product-details-->
  @endforeach
@endsection