<?php
//CẤU HÌNH TÀI KHOẢN (Configure account)
define('EMAIL_BUSINESS','daibkz@gmail.com');//Email Bảo kim
define('MERCHANT_ID','22026');                // Mã website tích hợp
define('SECURE_PASS','7b26530c582e5fe6');   // Mật khẩu

// Cấu hình tài khoản tích hợp
define('API_USER','thamhaivan');  //API USER
define('API_PWD','scZNtw6Vl0hnW0jgH2EDmR914B1Mq');       //API PASSWORD
define('PRIVATE_KEY_BAOKIM','-----BEGIN PRIVATE KEY-----
MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQC5+doqZEZXzTs8
Vy8iN6hmdzXJW1cd1ySYgjAGcEtu1X3khBGRh1izCKhq4p4VFuX4NJViUpM3NusJ
jGBRGovUfK1+O+d5BDuA212ZWMM8gpxMJpqjYLR3Xp+GcSxpn9A/6dJfwCbcWe7G
kp/0W0qPhjK0rbjCTRlYIY03NwMtaqrixI9rxAhyK1UuLkghu9sVYBVy9zbjJyyc
xWIJ+jSnsdipyWeYZTX9UXhPPWa7EDS5qw2WA3VLgqVqwI/XOlMKP5OnGpdJxtfn
I5XMhzwMc91xpZfUHl+tiV4cXHTC5pKrYoOeKFcsZN7zmFdF7cuu+OduhUV+GXiQ
FeH5F8vPAgMBAAECggEBAJitmUDSH7m3YFkSTjyuKs8sMPkExslVtdKKlrjCefsc
xATVs8Kgtd4NTo6pSxSPPu785GLa3ccni9/D4dLTk1Y3oQsQTODZ66vG69mXuHi1
1XDjBHL6Uk3pXde2k7qHHCVMZYx8KKsgHdnhx/WI+PZJOtmAAT1qpFLpAJEC1dXy
4/0QZXMOZp02jCO/hY8Ui8+EPqBKUzQXHD6rSsw1oxKjfHDD9NnQ070aGatt3/XE
tIohd/6tCgQKCinrDbLEDJVlNo+CQSJeFJulLIN9/35ESDk1ENxLJVE3QgJ99ChQ
Y1MNc5AYCC03LQJyxs9cMkPbPb1kzce2Eg2D2GoEEpkCgYEA6inMFp5BRTNyicrC
Yy6rfR29Oo9TVwfXaeQj8DbM4s4cKhFM9zxYoZ3hAwmG7NxHmmOCfsLUK3iYdVwN
1k7Q+t42qEFlDWSRVf1qvd8Zo+hNkdPsCZf16ecUUgNZsW5hZuAbBmVe83/pHG8u
D8eiaBSsjk4RdoZ/TDe8AMSf6+MCgYEAy1Gs2VZzGIfwT3BAO4jUUMvuyLrSFS74
ww9h6/opruXkKC7TazUnOOiAeZXcQh3Vs1E+Ry1Cl+xGc3hpnRXFZJfiBHu7AeV6
rRMzDfKfG24f9Iuax6dt6ndD873/gCinFqlHaPuoE5zhRJ6m/wM3emwdHJYhwRSj
Cec5F4xAvCUCgYAkZ70oIxCIvrfm/lP8cYwN1qrNyOyvEjQGbYa82Pg/psWwMKJj
qckpz07lVvzYJGMpeKEYLhgobgZd8KLiF7zb0+JxhEE+tMz3rn+C54Wn+vzcWDNR
RoPgCqIZIhY2xK91/A+XjfkWKGPInOxvXZ09S0GMmkySvdRauCuNfwRR+wKBgQCW
cUfxxWsCssuZLBkLNFLNuihktP/wFsKRKtetEX04Yfjx1rwvbrQoArnVvZKuBX9z
4OCxMAc/fOAgXu/fARX/OfdOk/MrEw8z86nqXyVl2ZWhkI8lvnixbjCEsYjV3r7M
INOrFdMnOATjjnVI6qtpVYgw99HgGZIOKN5w0yGvVQKBgQDDIWBItk5ZxN+9eqhE
tURStN5N8E1Aw2C+5tNSdC6iVpHkFol9XU/6yhnegYS0lIrnKIkbCFXBTzqsuB7b
e+IA1l+sIGIKgvzEXgGtClloBmThLZjtiBg3pD79IljSEwcXGBLRjI79edtPRdcR
IAkV8jYubA7fLbtwEIm/xw1+qA==
-----END PRIVATE KEY-----');

define('BAOKIM_API_SELLER_INFO','/payment/rest/payment_pro_api/get_seller_info');
define('BAOKIM_API_PAY_BY_CARD','/payment/rest/payment_pro_api/pay_by_card');
define('BAOKIM_API_PAYMENT','/payment/order/version11');

define('BAOKIM_URL','https://www.baokim.vn');
//define('BAOKIM_URL','http://kiemthu.baokim.vn');

//Phương thức thanh toán bằng thẻ nội địa
define('PAYMENT_METHOD_TYPE_LOCAL_CARD', 1);
//Phương thức thanh toán bằng thẻ tín dụng quốc tế
define('PAYMENT_METHOD_TYPE_CREDIT_CARD', 2);
//Dịch vụ chuyển khoản online của các ngân hàng
define('PAYMENT_METHOD_TYPE_INTERNET_BANKING', 3);
//Dịch vụ chuyển khoản ATM
define('PAYMENT_METHOD_TYPE_ATM_TRANSFER', 4);
//Dịch vụ chuyển khoản truyền thống giữa các ngân hàng
define('PAYMENT_METHOD_TYPE_BANK_TRANSFER', 5);

?>