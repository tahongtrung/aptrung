<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_payment');
    }
    public function transaction()
    {
        header('Content-Type: text/html; charset=utf-8');
        define('CORE_API_HTTP_USR', 'merchant_21410');
        define('CORE_API_HTTP_PWD', '21410tacM0mnsGSO0iF0DBVgz2j60JvI2u4');
        $bk = 'https://www.baokim.vn/the-cao/restFul/send';
        $seri = isset($_POST['txtseri']) ? $_POST['txtseri'] : '';
        $sopin = isset($_POST['txtpin']) ? $_POST['txtpin'] : '';
        //Loai the cao (VINA, MOBI, VIETEL, VTC, GATE)
        $mang = isset($_POST['chonmang']) ? $_POST['chonmang'] : '';
        $user = isset($_POST['txtuser']) ? $_POST['txtuser'] : '';
        //var_dump($user);die();
        if($mang=='MOBI'){
            $ten = "Mobifone";
        }
        else if($mang=='VIETEL'){
            $ten = "Vietel";
        }
        else if($mang=='GATE'){
            $ten = "Gate";
        }
        else if($mang=='VNM'){
            $ten = "VNM";
        }
        else $ten ="Vinaphone";

        //Mã MerchantID dang kí trên B?o Kim
        $merchant_id = '21410';
        //Api username
        $api_username = 'webtragopvnchien';
        //Api Pwd d
        $api_password = 'webtragopvnchien2334dghe';
        //Mã TransactionId
        $transaction_id = time();
        //mat khau di kem ma website dang kí trên B?o Kim
        $secure_code = 'e5ff34ea20b7f0b5';

        $arrayPost = array(
            'merchant_id'=>$merchant_id,
            'api_username'=>$api_username,
            'api_password'=>$api_password,
            'transaction_id'=>$transaction_id,
            'card_id'=>$mang,
            'pin_field'=>$sopin,
            'seri_field'=>$seri,
            'algo_mode'=>'hmac'
        );

        ksort($arrayPost);

        $data_sign = hash_hmac('SHA1',implode('',$arrayPost),$secure_code);

        $arrayPost['data_sign'] = $data_sign;

        $curl = curl_init($bk);

        curl_setopt_array($curl, array(
            CURLOPT_POST=>true,
            CURLOPT_HEADER=>false,
            CURLINFO_HEADER_OUT=>true,
            CURLOPT_TIMEOUT=>30,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPAUTH=>CURLAUTH_DIGEST|CURLAUTH_BASIC,
            CURLOPT_USERPWD=>CORE_API_HTTP_USR.':'.CORE_API_HTTP_PWD,
            CURLOPT_POSTFIELDS=>$arrayPost
        ));

        $data = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $result = json_decode($data,true);
        // $result cái nay la kết quả trả về
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time = time();
        //$time = time();
        if($status==200){
            $amount = $result['amount'];
            switch($amount) {
                case 10000: $xu = 10000; break;
                case 20000: $xu = 20000; break;
                case 30000: $xu = 30000; break;
                case 50000: $xu= 50000; break;
                case 100000: $xu = 100000; break;
                case 200000: $xu = 200000; break;
                case 300000: $xu = 300000; break;
                case 500000: $xu = 500000; break;
                case 1000000: $xu = 1000000; break;
            }

            // chô nay la xư lý khi thanh toan thanh cong
            //$dbhost="localhost";
            //$dbuser ="xemtruoc_ngaydep";
            //$dbpass = "BL&v7Wd#hj07";
            //$dbname = "xemtruoc_tuonglai";
            //$db = mysql_connect($dbhost,$dbuser,$dbpass) or die("cant connect db");
            //mysql_select_db($dbname,$db) or die("cant select db");


            //mysql_query("UPDATE hqhpt_users SET tien = tien + $xu WHERE username  ='$user';");

            // Xu ly thong tin tai day
            $file = SYSDIR."nap-the/carddung.log";
            $fh = fopen($file,'a') or die("cant open file");
            fwrite($fh,"Tai khoan: ".$user.", Loai the: ".$ten.", Menh gia: ".$amount.", Thoi gian: ".$time);
            fwrite($fh,"\r\n");
            fclose($fh);
            echo '<script>alert("B?n ?ã thanh toán thành công th? '.$ten.' m?nh giá '.$amount.' ");

             window.location = "http://macintosh.vn"
            </script>';

        }
        else{
            echo 'Status Code:' . $status . '<hr >';
            $error = $result['errorMessage'];
            echo $error;
            $file = FCPATH."nap-the/cardsai.log";
            $fh = fopen($file,'a') or die("cant open file");
            fwrite($fh,"Tai khoan: ".$user.", Ma the: ".$sopin.", Seri: ".$seri.", Noi dung loi: ".$error.", Thoi gian: ".$time);
            fwrite($fh,"\r\n");
            fclose($fh);
            echo '<script>alert("Thông tin th? cào không h?p l?!");

             window.location = "http://macintosh.vn/napthe/"
            </script>';
        }
    }
    public function sendCard()
    {
        $data = array();
        $check_val = false;
        $check = $_POST['value'];
        if($check == 1){
            header('Content-Type: text/html; charset=utf-8');
            define('CORE_API_HTTP_USR', 'merchant_19002');
            define('CORE_API_HTTP_PWD', '19002mQ2L8ifR11axUuCN9PMqJrlAHFS04o');
            $bk = 'https://www.baokim.vn/the-cao/restFul/send';
            $seri = isset($_POST['txtseri']) ? $_POST['txtseri'] : '';
            $sopin = isset($_POST['txtpin']) ? $_POST['txtpin'] : '';
            //Loai the cao (VINA, MOBI, VIETEL, VTC, GATE)
            $mang = isset($_POST['chonmang']) ? $_POST['chonmang'] : '';
            $user = isset($_POST['txtuser']) ? $_POST['txtuser'] : '';
            //var_dump($user);die();
            if($mang=='MOBI'){
                $ten = "Mobifone";
            }
            else if($mang=='VIETEL'){
                $ten = "Viettel";
            }
            else if($mang=='GATE'){
                $ten = "Gate";
            }
            else if($mang=='VTC'){
                $ten = "VTC";
            }
            else $ten ="Vinaphone";

            //Mã MerchantID dang kí trên B?o Kim
            $merchant_id = '21410';
            //$merchant_id = '19002';
            //Api username
            $api_username = 'macintoshvn';
            //Api Pwd d
            $api_password = 'macintoshvn235dgsdg';
            //Mã TransactionId
            $transaction_id = time();
            //mat khau di kem ma website dang kí trên B?o Kim
            $secure_code = '1e6cb0e1c37b25cf';

            $arrayPost = array(
                'merchant_id'=>$merchant_id,
                'api_username'=>$api_username,
                'api_password'=>$api_password,
                'transaction_id'=>$transaction_id,
                'card_id'=>$mang,
                'pin_field'=>$sopin,
                'seri_field'=>$seri,
                'algo_mode'=>'hmac'
            );

            ksort($arrayPost);

            $data_sign = hash_hmac('SHA1',implode('',$arrayPost),$secure_code);

            $arrayPost['data_sign'] = $data_sign;

            $curl = curl_init($bk);

            curl_setopt_array($curl, array(
                CURLOPT_POST=>true,
                CURLOPT_HEADER=>false,
                CURLINFO_HEADER_OUT=>true,
                CURLOPT_TIMEOUT=>30,
                CURLOPT_RETURNTRANSFER=>true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPAUTH=>CURLAUTH_DIGEST|CURLAUTH_BASIC,
                CURLOPT_USERPWD=>CORE_API_HTTP_USR.':'.CORE_API_HTTP_PWD,
                CURLOPT_POSTFIELDS=>$arrayPost
            ));

            $data1 = curl_exec($curl);

            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            $result = json_decode($data1,true);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $time = time();
            //$time = time();
            if($status!=200){
                //$amount = $result['amount'];
                $amount = 20000;
                switch($amount) {
                    case 10000: $xu = 10000; break;
                    case 20000: $xu = 20000; break;
                    case 30000: $xu = 30000; break;
                    case 50000: $xu= 50000; break;
                    case 100000: $xu = 100000; break;
                    case 200000: $xu = 200000; break;
                    case 300000: $xu = 300000; break;
                    case 500000: $xu = 500000; break;
                    case 1000000: $xu = 1000000; break;
                }
                $oldItem = $this->m_payment->getFirstRowWhere('users',array(
                    'id' => $this->session->userdata('userid')
                ));

                $this->m_payment->Update('users',$this->session->userdata('userid'),array(
                    'price' => $xu + $oldItem->price
                ));
                $check_val = true;
                $mss = "Ok";
            }
            else{
                $error = $result['errorMessage'];
                $mss = 'Mã th? cào không ?úng, ho?c ?ã có ng??i n?p';
                $check_val = false;
            }
        }
        $data['err_server'] = $data1;
        $data['mess'] = $mss;
        $data['check'] = $check_val;
        $data['xu'] = $xu + $oldItem->price;
        echo json_encode($data);
    }
    public function quickDownload()
    {
        $check_val = false;
        header('Content-Type: text/html; charset=utf-8');
        define('CORE_API_HTTP_USR', 'merchant_19002');
        define('CORE_API_HTTP_PWD', '19002mQ2L8ifR11axUuCN9PMqJrlAHFS04o');
        $bk = 'https://www.baokim.vn/the-cao/restFul/send';
        $seri = isset($_POST['txtseri']) ? $_POST['txtseri'] : '';
        $sopin = isset($_POST['txtpin']) ? $_POST['txtpin'] : '';
        //Loai the cao (VINA, MOBI, VIETEL, VTC, GATE)
        $mang = isset($_POST['chonmang']) ? $_POST['chonmang'] : '';
        //$user = isset($_POST['txtuser']) ? $_POST['txtuser'] : '';
        //var_dump($user);die();
        if($mang=='MOBI'){
            $ten = "Mobifone";
        }
        else if($mang=='VIETEL'){
            $ten = "Viettel";
        }
        else if($mang=='GATE'){
            $ten = "Gate";
        }
        else if($mang=='VTC'){
            $ten = "VTC";
        }
        else $ten ="Vinaphone";

        //Mã MerchantID dang kí trên B?o Kim
        $merchant_id = '19002';
        //Api username
        $api_username = 'macintoshvn';
        //Api Pwd d
        $api_password = 'macintoshvn235dgsdg';
        //Mã TransactionId
        $transaction_id = time();
        //mat khau di kem ma website dang kí trên B?o Kim
        $secure_code = '1e6cb0e1c37b25cf';

        $arrayPost = array(
            'merchant_id'=>$merchant_id,
            'api_username'=>$api_username,
            'api_password'=>$api_password,
            'transaction_id'=>$transaction_id,
            'card_id'=>$mang,
            'pin_field'=>$sopin,
            'seri_field'=>$seri,
            'algo_mode'=>'hmac'
        );

        ksort($arrayPost);

        $data_sign = hash_hmac('SHA1',implode('',$arrayPost),$secure_code);

        $arrayPost['data_sign'] = $data_sign;

        $curl = curl_init($bk);

        curl_setopt_array($curl, array(
            CURLOPT_POST=>true,
            CURLOPT_HEADER=>false,
            CURLINFO_HEADER_OUT=>true,
            CURLOPT_TIMEOUT=>30,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPAUTH=>CURLAUTH_DIGEST|CURLAUTH_BASIC,
            CURLOPT_USERPWD=>CORE_API_HTTP_USR.':'.CORE_API_HTTP_PWD,
            CURLOPT_POSTFIELDS=>$arrayPost
        ));

        $data1 = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $result = json_decode($data1,true);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time = time();
        //$time = time();
        if($status!=200){
            $check_val = true;
            //$amount = $result['amount'];
            /*switch($amount) {
                case 10000: $xu = 10000; break;
                case 20000: $xu = 20000; break;
                case 30000: $xu = 30000; break;
                case 50000: $xu= 50000; break;
                case 100000: $xu = 100000; break;
                case 200000: $xu = 200000; break;
                case 300000: $xu = 300000; break;
                case 500000: $xu = 500000; break;
                case 1000000: $xu = 1000000; break;
            }*/
            /*$file = FCPATH."nap-the/carddung.log";
            $fh = fopen($file,'a') or die("cant open file");
            fwrite($fh,"Loai the: ".$ten.", Menh gia: ".$amount.", Thoi gian: ".$time);
            fwrite($fh,"\r\n");
            fclose($fh);*/
            /* echo '<script>alert("B?n ?ã thanh toán thành công!");

              window.location = "http://macintosh.vn"
             </script>';*/

        }
        else{
            $check_val = false;
            $error = $result['errorMessage'];
            $file = FCPATH."nap-the/cardsai.log";
            $fh = fopen($file,'a') or die("cant open file");
            fwrite($fh,"Ma the: ".$sopin.", Seri: ".$seri.", Noi dung loi: ".$error.", Thoi gian: ".$time);
            fwrite($fh,"\r\n");
            fclose($fh);
            echo '<script>alert("Thông tin th? cào không h?p l?!");

             window.location = "http://macintosh.vn/napthe/"
            </script>';
        }
        $data['err_server'] = $data1;
        //$data['mess'] = $mss;
        $data['check'] = $check_val;
        echo json_encode($data);
    }
}
