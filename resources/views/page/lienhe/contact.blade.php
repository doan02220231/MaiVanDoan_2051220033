@extends('show_layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Liên Hệ PET SHOP</h2>
    @foreach ($contact as $key => $cont)
	<div class="row">
        <div class="col-md-12"style="padding-left: 300px;padding-right: 310px;">
            <h4>Thông tin liên hệ</h4>
            {!!$cont ->info_contact!!}
            {!!$cont ->info_fanpage!!}
           
           
        </div>
        <div class="col-md-12"style="padding-left: 300px;padding-right: 310px;">
            <h4>Bản đồ</h4>
            {!!$cont ->info_map!!}
        </div>
    </div>
    @endforeach
</div><!--features_items-->

@endsection