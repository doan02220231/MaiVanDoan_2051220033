@extends('show_layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 style="margin: 0px; position: inherit; font-size: 22px" class="title text-center">{{$meta_titel}}</h2>
	
    <div class="product-image-wrapper">
        @foreach ($post_by_id as $key => $pb )
            <div class="single-products" style="margin: 10px 0">
                    <div class=" text-left"style="padding-left: 370px;padding-right: 330px;">
                        {!! $pb -> post_conten !!}
                            
                    </div>
                    
            </div>
            <div class="clearfix"></div>
        @endforeach
    </div>
    <h2 style="  font-size: 15px " class="title text-center">Bài viết liên quan</h2>
    <style type="text/css">
         ul.post_relate{
            padding-left: 370px;
            padding-right: 330px;
            margin-bottom: 30px;
         }
        ul.post_relate li a{
            color: #000;
        }
        ul.post_relate li a:hover{
            color: #FE980F;
        }
    </style>
    <ul class="post_relate"  >
        @foreach ($related as $key => $post_relate)
            <li><a href="{{url('/bai-viet/'.$post_relate -> post_slug)}}">
                <img style="float: left ; width: 12%; padding-right: 10px;" 
                src="{{URL::to('public/uploads/post/'.$post_relate -> post_image)}}" alt="{{$post_relate -> post_slug}}" />
                {{$post_relate -> post_title}}
                <p>{!!$post_relate -> post_desc!!}</p>
                </a>
            </li>
        @endforeach
        
    </ul>
	
</div><!--features_items-->

@endsection