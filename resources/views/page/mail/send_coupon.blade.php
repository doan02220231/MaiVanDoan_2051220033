<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale = 1" >
        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
            }
            .coupon{
                border: 5px dotted #bbb;
                width: 80%;
                border-radius: 15px;
                margin: 0 auto;
                max-width: 600px;
            }
            .contatiner{
                background: #ccc;
                padding: 3px;
            }
            .promo{
                background: #ccc;
                padding: 3px;
            }
            .expire{
                color: red;
            }
            p.code{
                text-align: center;
                font-size: 20px;
            }
            p.expire{
                text-align: center;
            }
            h2.note{
                text-align: center;
                font-size: large;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="coupon">
            <div class="contatiner">
                <h3>Mã khuyến mãi từ shop <a target="_blank" href="http://localhost/petshop">http://petshop.com</a></h3>
            </div>
            <div class="contatiner" style="background-color: white">
                <h2 class="note"><b><i>
                    {{$coupon['coupon_name']}}
                   @if ($coupon['coupon_condition'] == 1)
                        Giảm {{$coupon['coupon_number']}} %
                   @else
                        Giảm {{number_format($coupon['coupon_number'],0,',','.')}} VNĐ
                   @endif
                </i></b></h2>
                <p>Quý khách đã từng mua tại PetShop
                     <a target="_blank" style="color: red;" href="http://localhost/petshop">
                        petshop.com
                    </a>
                    nếu đã có tài khoản xin vui lòng <a target="_blank" style="color: red;" href="http://localhost/petshop/login-checkout">đăng nhập</a>
                    vào tài khoản để mua hàng và nhập mã code phí dưới để được giảm giá mua hàng , xin cảm ơn quý khách. Chúc quý khách 
                    thật nhiều sức khoẻ và bình an trong cuộc sống 
                </p>
            </div>
            <div class="contatiner" >
                <p class="code">sử dụng code sau: <span class="promo">{{$coupon['coupon_code']}}</span> với chỉ {{$coupon['coupon_time']}} mã giảm giá</p>
                <p class="expire">Ngày bắt đầu:{{$coupon['start_coupon']}} - ngày hết hạn:{{$coupon['end_coupon']}}</p>
                <p class="expire" style=" font-size: 15px;">Nhanh tay kẻo lở</p>
            </div>
            
        </div>
    </body>
</html>