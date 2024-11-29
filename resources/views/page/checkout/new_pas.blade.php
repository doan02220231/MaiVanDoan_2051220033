@extends('show_layout_SP')
@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row"style="padding-left: 400px;padding-right: 500px; ">
            <div class="col-sm-12 col-sm-offset-1">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {!!session()->get('message')!!}
                    </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-danger">
                        {!!session()->get('error')!!}
                    </div>
                @endif
                <div class="login-form"><!--login form-->
                    @php
                        $email = $_GET['email'];
                        $token = $_GET['token'];
                    @endphp
                       
                    
                    <h2>Điền mật khẩu mới</h2>
                    <form action="{{URL::to('/reset-new-pass')}}" method="POST">
                        @csrf
                        <input type="hidden" name="email"  value="{{$email}}" />
                        <input type="hidden" name="token"  value="{{$token}}" />
                        <input type="password" name="password_accout" placeholder="Nhập mật khẩu mới.........." />
                        <button type="submit" class="btn btn-default">Gửi</button>
                    </form>
                </div><!--/login form-->
            </div>
            {{-- <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        @csrf
                        <input type="text" name="customer_name" placeholder="Họ và tên"/>
                        <input type="email" name="customer_email" placeholder="Nhập Email"/>
                        <input type="password" name="customer_password" placeholder="Nhập Password"/>
                        <input type="text" name="customer_phone" placeholder="Nhập Phone"/>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div> --}}
        </div>
    </div>
</section><!--/form-->

@endsection