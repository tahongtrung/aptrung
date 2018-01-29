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

            $data1 = curl_exec($curl);

            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            $result = json_decode($data1,true);
            // $result cái nay la kết quả trả về
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $time = time();
            //$time = time();
            if($status==200){
                $amount = $result['amount'];
                $card = $this->f_profiler->getFirstRow('card');
                //$amount = 200000;
                switch($amount) {
                    case 10000: $xu = 10000;$day = $card->card20; break;
                    case 20000: $xu = 20000;$day = $card->card20; break;
                    case 30000: $xu = 30000;$day = $card->card20; break;
                    case 50000: $xu= 50000;$day = $card->card50; break;
                    case 100000: $xu = 100000;$day = $card->card100; break;
                    case 200000: $xu = 200000;$day = $card->card100; break;
                    case 300000: $xu = 300000;$day = $card->card100; break;
                    case 500000: $xu = 500000;$day = $card->card100; break;
                    case 1000000: $xu = 1000000;$day = $card->card100; break;
                }
                $oldItem = $this->m_payment->getFirstRowWhere('users',array(
                    'id' => $this->session->userdata('userid')
                ));
                $timeNow = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $timeUser = '';
                if($oldItem->enddate < $timeNow){
                    $timeUser = $timeNow;
                }else{
                    $timeUser = $oldItem->enddate;
                }
                $time_temp = date('d-m-Y',$timeUser);
                //$timeEnd = date("d-m-Y", strtotime("$time_temp + $day day"));
                $timeEnd = strtotime("$time_temp + $day day");

                $this->m_payment->Update('users',$this->session->userdata('userid'),array(
                    'price' => $xu + $oldItem->price,
                    'enddate' => $timeEnd
                ));
                $this->m_payment->Add('cardrecharge',array(
                    'card_type' => $mang,
                    'user_id' => $this->session->userdata('userid'),
                    'price' => $xu,
                    'day_create' => time(),
                    'card_code'  => $_POST['txtpin'],
                    'card_seri'  => $_POST['txtseri']
                ));
                $check_val = true;
                $mss = "Ok";
                $data['xu'] = $xu + $oldItem->price;
            }
            else{
                $error = $result['errorMessage'];
                $mss = 'Lỗi thẻ cào';
                $check_val = false;
            }
        }
        $data['err_server'] = $data1;
        $data['mess'] = $mss;
        $data['check'] = $check_val;
        echo json_encode($data);
    }
    public function quickDownload()
    {
        $check_val = false;
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

        $data1 = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $result = json_decode($data1,true);
        // $result cái nay la kết quả trả về
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time = time();
        //$time = time();
        if($status==200){
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
            $error = $result['errorMessage'];
            $mss = 'Lỗi thẻ cào';
            $check_val = false;
        }
        $data['err_server'] = $data1;
        //$data['mess'] = $mss;
        $data['check'] = $check_val;
        echo json_encode($data);
    }
    public function paymentOnline()
    {
        $ngaydi = $_POST['ngaydi'];
        $ngayden = $_POST['ngayden'];
        $loaiphong = $_POST['loaiphong'];
        $sophong = $_POST['sophong'];
        $code = $_POST['code'];
        $booknote = $_POST['booknote'];
        $person = $_POST['person'];
        $child = $_POST['child'];
        $check = false;
        $userInfo = $this->m_payment->getFirstRowWhere('users',array(
            'id' => $this->session->userdata('userid')
        ));
        //echo "<pre>";var_dump($userInfo);die();
        $arr=array(
            'fullname' => $userInfo->fullname,
            'address' => $userInfo->address,
            'user_id' => $userInfo->id,
            'code_sale' => $code,
            'phone' => $userInfo->phone,
            'email' => $userInfo->email,
            //'note' => $this->input->post('note_hidden'),
            'time' => time(),
        );

        $id=$this->m_payment->Add('order',$arr);
        if($id)
        {
            $code = 'DH_'.date('d').$id;
            $this->f_shoppingcartmodel->Update_where('order',array('id' => $id ),array('code' => $code));
            $detai_order=array(
                'order_id'=>$id,
                'item_id'=> $_POST['loaiphong'],
                'date_start' => $ngayden,
                'date_end'=> $ngaydi,
                'number'=> $sophong,
                'booknote' => $booknote,
                'person' => $person,
                'child' => $child
            );
            $id_order_item=$this->f_shoppingcartmodel->Add('order_item',$detai_order);
        }

        $info_baokim = array(
            $data['madon_hang'] = $code,
            $payer_name = $userInfo->fullname,
            $payer_phone_no = $userInfo->phone,
            $payer_email = $userInfo->email,
            $address = $userInfo->address,
            $total_amount = '1000000',
            $madon_hang = $code
        );
        if (!array_key_exists($madon_hang,$info_baokim)) {
            $_SESSION['info_baokim'][$madon_hang]=$info_baokim;
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
}
