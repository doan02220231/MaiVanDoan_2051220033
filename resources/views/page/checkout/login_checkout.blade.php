@extends('show_layout_SP')
@section('content')

     {{--<section id="form"><!--form--> --}}
<div class="container">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {!!session()->get('message')!!}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {!!session()->get('error')!!}
        </div>
        @endif
         <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #FF6347;">Chào mừng đến với cửa hàng Pet Shop của chúng tôi</h2>
       
    </div>
        <div class="register-req">

            <p style="text-align: center;">Làm ơn đăng ký hoặc đăng nhập đúng email để nhận được nhiều ưu đải từ shop</p>
        </div>
        <div class="row" style="padding-bottom: 50px;">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                   
                    <h2>Đăng nhập</h2>
                    <form action="{{URL::to('/login-customer')}}" method="POST">
                        @csrf
                        <input type="text" name="email_accout" placeholder="Nhập email" />
                        <input type="password" name="password_accout" placeholder="Nhập password" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Nhớ đăng nhập |
                        </span>
                        <span>
                            <a href="{{URL::to('/quen-mat-khau')}}">Quên mật khẩu</a>
                        </span>
                        <button type="submit"   style="background: blue;" class="btn btn-default">Đăng nhập</button>
                    </form>
                    <style>
                        ul.list-login{
                            margin: 10px;
                            padding: 0;
                        }ul.list-login li{
                            margin: 5px;
                            display: inline;
                        }
                    </style>
                    {{-- <ul class="list-login">
                        <li>
                            <a href="{{url('login-customer-google')}}" >
                            <img  width ="10%" alt = " Đăng nhập bằng tài khoản google" 
                            src = "{{ asset('public/frontend/images/1298745_google.png') }}">
                        </a>
                        </li>
                    </ul> --}}
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or" style="background: blue;">Hoặc</h2>
            </div>
            <div class="col-sm-5">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        @csrf
                        <input type="text" name="customer_name" placeholder="Họ và tên"/>
                        <input type="email" name="customer_email" placeholder="Nhập Email"/>
                        <input type="password" name="customer_password" placeholder="Nhập Password"/>
                        <input type="text" name="customer_phone" placeholder="Nhập Phone"/>
                        <button  style="background: blue;" type="submit"class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
 {{--</section><!--/form--> --}}

@endsection