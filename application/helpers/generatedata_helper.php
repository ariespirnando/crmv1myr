<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 function generate_guid(){  
     $guid = strtoupper(substr(MD5(uniqid()),-6)).strtoupper(substr(uniqid(),-3)).substr(str_replace('-','',date('H-i-s')),-3);   
     return $guid;
 }

 function generate_pw($pass){ 
    $salt  	  =md5("IUh6CfdypBwJptOq30ri67M8rViLtb");
    $enkrip	  =md5($pass.$salt); 
    $password =md5($enkrip.$salt).substr($pass,-3).$enkrip;   
    return $password;
 }
 
 function generate_kode($pref){ 
    $guid = strtoupper(substr(uniqid(),-3));
    $kode = $pref.'-'.$guid.substr(str_replace('-','',date('H-i-s')),-3);
    return $kode;
 }

 function generate_kode_tg($pref,$ko){ 
    $guid = strtoupper(substr(uniqid(),-3));
    $kode = $pref.'/'.$ko.substr(str_replace('-','',date('Y-m-d')),-6).substr(str_replace('-','',date('H-i-s')),-3);
    return $kode;
 }

 function generate_inv($pref){  
    $kode = $pref.'/'.substr(str_replace('-','/',date('Y-m-d')),-8).'/'.substr(str_replace('-','',date('H-i-s')),-5);
    return $kode;
 }

 
 function generate_username($name){
   $clearspace  = str_replace(" ","",$name);
   $replace     = preg_replace('/[^A-Za-z0-9\  ]/','_',$clearspace);
   return strtoupper(trim(substr($replace, 0,5))).str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
 }

 // Function to get the client IP address
function get_client_ip() {
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
  else if(getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  else if(getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
  else if(getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
  else if(getenv('HTTP_FORWARDED'))
     $ipaddress = getenv('HTTP_FORWARDED');
  else if(getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
  else
      $ipaddress = 'UNKNOWN';
  return $ipaddress;
}


//untuk mengetahui bulan bulan
if ( ! function_exists('bulan'))
{
    function bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}
 
//format tanggal yyyy-mm-dd
if ( ! function_exists('tgl_indo'))
{
    function tgl_indo($tgl)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);  //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan.' '.$tahun; //hasil akhir
    }
}
 
//format tanggal timestamp
if( ! function_exists('tgl_indo_timestamp')){
 
function tgl_indo_timestamp($tgl)
{
    $inttime=date('Y-m-d H:i:s', strtotime($tgl)); //mengubah format menjadi tanggal biasa
    $tglBaru=explode(" ",$inttime); //memecah berdasarkan spaasi
     
    $tglBaru1=$tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
    $tglBaru2=$tglBaru[1]; //mendapatkan fotmat hh:ii:ss
    $tglBarua=explode("-",$tglBaru1); //lalu memecah variabel berdasarkan -
 
    $tgl=$tglBarua[2];
    $bln=$tglBarua[1];
    $thn=$tglBarua[0];
 
    $bln=bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
    $ubahTanggal="$tgl $bln $thn | $tglBaru2 "; //hasil akhir tanggal
 
    return $ubahTanggal;
}
function ubhSQL($tgl){
    $inttime=date('Y-m-d H:i:s', strtotime($tgl)); //mengubah format menjadi tanggal biasa
    $tglBaru=explode(" ",$inttime); //memecah berdasarkan spaasi
     
    $tglBaru1=$tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
    return $tglBaru1;
}
}


?>