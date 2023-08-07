<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

 function sendemail_1($jenis,$email, $user, $pass){ 
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'pjj.aplikasi@gmail.com', // change it to yours
        'smtp_pass' => 'J@karta123', // change it to yours
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE
    );
 
    
    $CI = &get_instance();
    $CI->load->library('email',$config); 
    $CI->email->set_newline("\r\n");
    $CI->email->from('pjj.aplikasi@gmail.com'); // change it to yours
    $CI->email->to($email);// change it to yours
    if($jenis==1){
        $message = daftarkanemail();
        $CI->email->subject('[Notifikasi] Selamat datang di aplikasi PJJ');
        $CI->email->message($message);
    }else{
        $message = lupapassword($user, $pass);
        $CI->email->subject('[Notifikasi] Perubahan Kata Sandi');
        $CI->email->message($message); 
    }
    
    $CI->email->send();
 }

 function daftarkanemail(){
    $email = '<p>Hi,</p> 

    <p>Terimakasih sudah mendaftarkan email anda ke aplikasi PJJ, Email yg didaftarkan dapat difungsikan sebagai pemberi informasi &amp; untuk konfirmasi perubahan data.</p> 
    <p>Terimakasih</p>
    <br>
    <p>--SYSTEM--</p>';
    return $email;

 }

 function lupapassword($user, $pass){
    $email = '<p>Hi,</p>

    <p>Terimakasih sudah menghubungi kami</p> 
    <p>Berikut adalah rincian akun anda</p> 
    <p>Username : '.$user.'</p> 
    <p>Password : '.$pass.'</p> 
    <p>Terimakasih</p>
    <br>
    <p>--SYSTEM--</p>';
    return $email;

 }


 ?>