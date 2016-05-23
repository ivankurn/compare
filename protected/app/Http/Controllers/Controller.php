<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $api;
	
	public function __construct()
   	{
      	$this->middleware('auth');
      	$this->api = "App\Http\Controllers\API\C_API_All";
    }
    
    function safe_b64encode($string) {
		$data = base64_encode($string);
		$data = str_replace(array('+','/','='),array('-','_',''),$data);
		return $data;
	}

	function safe_b64decode($string) 
	{
		$data = str_replace(array('-','_'),array('+','/'),$string);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
			$data .= substr('====', $mod4);
		}
		return base64_decode($data);
	}

	function encryptkhusus($value) 
	{
		$skey = "H8nljs9ds83D4fd2";
		if(!$value){return false;}
		$text = serialize($value);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
		return trim($this->safe_b64encode($crypttext)); 
	}

	function decryptkhusus($value) 
	{
		$skey = "H8nljs9ds83D4fd2";
		if(!$value){return false;}
		$crypttext = $this->safe_b64decode($value); 
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
		return unserialize(trim($decrypttext));
	}
	
	function createRandomPIN($digit, $mode = null) 
	{
		if($mode != null)
		{
			if($mode == "angka")
			{
				$chars = "1234567890";
			} 
			elseif($mode == "huruf")
			{
				$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			}
		} else {
			$chars = "346789ABCDEFGHJKMNPQRSTUVWXY";
		}
		
		srand((double)microtime()*1000000);
		$i = 0;
		$pin = '';

		while ($i < $digit) {
			$num = rand() % strlen($chars);
			$tmp = substr($chars, $num, 1);
			$pin = $pin . $tmp;
			$i++;
		}
		return $pin;
	}
	
	function getIPAddress()
	{
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
			$ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
		}
		
		return $ipAddress;
	}
	
	function getUserAgent()
	{
		return $_SERVER['HTTP_USER_AGENT'];
	}
}