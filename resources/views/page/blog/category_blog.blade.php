@extends('show_layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center"style="margin: 0px; position: inherit;font-size: 22px">{{$meta_titel}}</h2>

    <div class="product-image-wrapper">
        @foreach ($post_by_id as $key => $po)
        <div class="single-products"style="margin: 10px 0">
            <div class="posss text-left "style="padding-left: 370px;padding-right: 330px;padding-bottom: 15px;">
                    <a href="{{url('/bai-viet/'.$po -> post_slug)}}"style="color: #000">
                        <style type="text/css">
                            p:hover{
                                color: #FE980F;
                            }
                        </style>
                        <img style="float: left ; width: 18%; padding-right: 10px;" 
                        src="{{URL::to('public/uploads/post/'.$po -> post_image)}}" alt="{{$po -> post_slug}}" />
                        <h4 style="padding: 5px">{{$po -> post_title}}</h4>
                        <p>{!!$po -> post_desc!!}</p>
                    </a>
            </div>
        </div>
            {{-- <div class="single-products" style="margin: 10px 0">
                    <div class=" text-center"style="padding-left: 150px;padding-right: 150px;">
                            <img style="float: left ; width: 15%; padding: 5px;" 
                            src="{{URL::to('public/uploads/post/'.$po -> post_image)}}" alt="{{$po -> post_slug}}" />
                            <h4 style="color: black;padding: 5px">{{$po -> post_title}}</h4>
                            <p>{!!$po -> post_desc!!}</p>  
                    </div>
                    <div class="text-right"style="padding-right: 150px;">
                        <a href="{{url('/bai-viet/'.$po -> post_slug)}}" class="btn btn-default btn-sm">Xem bài viết</a>
                    </div>
            </div> --}}
            <div class="clearfix"></div>
        @endforeach
    </div>
</div><!--features_items-->
<div class="col-sm-7 text-right text-center-xs">  
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {!!$post_by_id->links('pagination::bootstrap-4')!!}
    </ul>
</div>
@endsection