<?php
namespace App\Http\Controllers\API\v1;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use App\Http\Models\Cards;
use DB;
use Hash;
use Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
use Lang;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Image;


trait C_API_User
{
	/*
	*	To register new user
	*	
	*	params
	*		> nama_user
	*		> email
	*		> alama_user
	*		> kota_user
	*		> country_code_user
	*		> mobile_phone_user
	*		> gender
	*		> tanggal_lahir
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
	*/
	function register(Request $request) {
		$validator = Validator::make($request->json()->all(), [    
			'email' 				=> 'required|email|max:255',
			'password'				=> 'required|max:60',
			'nama_user' 			=> 'required|max:255|regex:/[\w ]/',
            'alamat_user' 			=> 'required|max:255',
			'kota_user' 			=> 'required|max:100',
			'country_code_user' 	=> 'required|max:3',
			'mobile_phone_user' 	=> 'required|min:7|max:12|regex:/\d/',
			'gender'				=> 'required|in:Male,Female',
			'occupation'			=> 'required',
			'tanggal_lahir' 		=> 'required|date|regex:/[0-9]{2}-[0-9]{2}-[0-9]{4}/'
        ]);
		
		if (!$validator->fails())
		{
			$email = $request->json('email');
			
			$isUserExist = Users::where('email', '=', $email)
				->get()
				->toarray();
 				
 			if (empty($isUserExist))
 			{
				$tanggal = explode("-",$request->json('tanggal_lahir'));
				$tgl_lahir = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];

				$mobilePhone = $request->json('mobile_phone_user');
				
				$nol = substr($mobilePhone, 0, 1);

				if($nol == 0){
					$len = strlen($mobilePhone);
					$len = $len - 1;
					$mobilePhone = substr($mobilePhone, -$len);
				}
				else{
					$mobilePhone = $request->json('mobile_phone_user');
				}
				date_default_timezone_set('Asia/Jakarta');
 				$data = array(
					'nama_user' 			=> $request->json('nama_user'),
					'email' 				=> $email,
					'password' 				=> bcrypt($request->json('password')),
					'alamat_user' 			=> $request->json('alamat_user'),
					'kota_user' 			=> $request->json('kota_user'),
					'country_code_user' 	=> $request->json('country_code_user'),
					'mobile_phone_user' 	=> $mobilePhone,
					'tanggal_lahir' 		=> $tgl_lahir,
					'occupation' 			=> $request->json('occupation'),
					'gender' 				=> $request->json('gender'),
					'foto'					=> 'avatar.png',
					'verifikasi_email'		=> app($this->controller)->createRandomPIN(4, 'huruf'),
					'is_admin'				=> 0,
					'created_at' 			=> date("Y-m-d H:i:s"),
					'updated_at' 			=> date("Y-m-d H:i:s")
				);
			
				$query = Users::insert($data);
				
				if ($query)
				{
					Mail::send('auth.emails.verifyemail', 
						array(
							'namaUser' 		=> $data['nama_user'],
							'pin'		 	=> $data['occupation'],
							'verifyEmail'	=> $data['verifikasi_email']
						), 
						function($message) use($data)
					{
						$message->from('noreply@maxx.coffee', 'Maxx Coffee');
						$message->to($data['email'], $data['nama_user'])
							->subject('Aktifkan akun Maxx Coffee Anda');
					});
		
					if (!Mail::failures())
					{
						/*
						$sms = $this->dispatcher
							->json([
								'to'		=> '0'.$data['mobile_phone_user'],
								'text'		=> 'Your Maxx Coffee confirmation code is '.$data['verify_sms']
							])
							->post('api/sendsms');
						
						$sms = json_decode($sms, true);

						if($sms['status'] == "success" && $sms['hasil'] == "OK"){
							$messages = 'Please verify your email address and phone number';
						}
						else{
							$messages = 'Please verify your email address';
						}
						*/
						$messages = 'Please verify your email address';
						$result = array(
							'status' 	=> 'success',
							'messages'	=> $messages
						);
					}
					else
					{
						$result = array(
							'status' 	=> 'fail'
						);
					}
				}
				else
				{
					$result = array('status' => 'fail');
				}
 			}
 			else
 			{
 				$result = array(
 					'status' 	=> 'fail',
 					'messages'	=> trans('auth.email_already_exist')
 				);
 			}
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }


    function resendEmailSms(Request $request){
    	$validator = Validator::make($request->json()->all(), [
			'email' 				=> 'required|email|max:255',
		]);

		if($validator->fails()){
			$result = array(
					'status'	=> 'fails',
					'messages'	=> $validator->errors()
				);
		}
		else{
			$email = $request->json('email');

			$identity = Users::where('email', '=', $email)
						->get()
						->toArray();
			if(empty($identity)){
				$result = array(
						'status' 	=> 'fails',
						'messages'	=>	'can not find users'
					);
			}
			else{

				$verifyEmail = $identity[0]['verify_email'];
				$verifySms = $identity[0]['verify_sms'];

				if($verifyEmail != "yes" && $verifySms != "yes"){
					Mail::send('auth.emails.verifyemail', 
					array(
						'namaUser' 		=> $identity[0]['nama_user'],
						'pin'		 	=> $identity[0]['pin'],
						'verifyEmail'	=> $verifyEmail
					), 
					function($message) use($identity)
					{
						$message->from('noreply@vourest.com', 'Vourest');
						$message->to($identity[0]['email'], $identity[0]['nama_user'])
							->subject('Aktifkan akun Vourest Anda');
					});

					if (!Mail::failures())
					{
						$sms = $this->dispatcher
							->json([
								'to'		=> '0'.$identity[0]['mobile_phone_user'],
								'text'		=> 'Your Vourest confirmation code is '.$verifySms
							])
							->post('api/sendsms');
						
						$sms = json_decode($sms, true);

						if($sms['status'] == "success" && $sms['hasil'] == "OK"){
							$messages = 'Please verify your email address and phone number';
						}
						else{
							$messages = 'Please verify your email address';
						}

						$result = array(
							'status' 	=> 'success',
							'messages'	=> $messages
						);
					}
					else
					{
						$result = array(
							'status' 	=> 'fail',
							'messages'	=> 'fail to send email'
						);
					}
				}
				elseif($verifyEmail == "yes" && $verifySms != "yes"){
					$sms = $this->dispatcher
						->json([
							'to'		=> '0'.$identity[0]['mobile_phone_user'],
							'text'		=> 'Your Vourest confirmation code is '.$verifySms
						])
						->post('api/sendsms');
					
					$sms = json_decode($sms, true);

					if($sms['status'] == "success" && $sms['hasil'] == "OK"){
						$result = array(
							'status' 	=> 'success',
							'messages'	=> 'Please verify your phone number'
						);
					}
					else{
						$result = array(
							'status' 	=> 'fail',
							'messages'	=> 'fail to send sms'
						);
					}

					
				}
				elseif($verifyEmail != "yes" && $verifySms == "yes"){
					
					Mail::send('auth.emails.verifyemail', 
					array(
						'namaUser' 		=> $identity[0]['nama_user'],
						'pin'		 	=> $identity[0]['pin'],
						'verifyEmail'	=> $verifyEmail
					), 
					function($message) use($identity)
					{
						$message->from('noreply@vourest.com', 'Vourest');
						$message->to($identity[0]['email'], $identity[0]['nama_user'])
							->subject('Aktifkan akun Vourest Anda');
					});

					if (!Mail::failures())
					{
						$result = array(
							'status' 	=> 'success',
							'messages'	=> 'please check email'
						);
					}
					else
					{
						$result = array(
							'status' 	=> 'fail',
							'messages'	=> 'send email failed'
						);
					}
				}
				elseif($verifyEmail == "yes" && $verifySms == "yes"){
					$result = array(
							'status' 	=> 'fail',
							'messages'	=> 'email and sms has activated'
						);
				}
			}
		}
		return json_encode($result);
    }
    
	function updateDeviceId(Request $request) 
	{
		$validator = Validator::make($request->json()->all(), [    
			'token' 				=> 'required',
			'device_id'				=> 'required'
        ]);
		
		if (!$validator->fails())
		{
			$token = $request->json('token');
			$decrypt = app($this->controller)->decryptkhusus($token);
			$explode = explode('|', $decrypt);
			$email = $explode[0];

			$query = Users::where('email', '=', $email)
				->get()
				->toarray();
			
			$email = $query[0]['email'];
				
			$data = array('device_id' => $request->json('device_id'));
					
			$query = Users::where('email', $email)
					->update($data);
					
			$result = array(
					'status'		=> 'success',
					'device_id'		=> $request->json('device_id'),
					'user_email'			=> $email
				);
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
	}
    /*
	*	To login
	*	
	*	params
	*		> email
	*		> password
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
	*/
	function login(Request $request) 
	{
		$validator = Validator::make($request->json()->all(), [    
			'email' 				=> 'required|email|max:255',
			'password'				=> 'required|max:60',
			'remember'				=> 'max:1|in:1, '
        ]);
		
		if (!$validator->fails())
		{
			$email = $request->json('email');
			$password = $request->json('password');
			$remember = $request->json('remember');
			
			
			$isLogin = Auth::attempt([
				'email'		=> $email,
				'password'	=> $password
			]);
			
			if ($isLogin)
			{
				$user = Users::where('email', $email)
					->get()
					->toarray();
				
				$token = $user[0]['email'] . '|' . $user[0]['mobile_phone_user'] . '|' . $user[0]['is_admin'];
        		$token = app($this->controller)->encryptkhusus($token);
        		$level_akses = 'Customer';
				if($user[0]['is_admin'] == 1) $level_akses = 'Admin Sistem';
			
				$device_id = $request->json('device_id');
				if(!empty($device_id)){
					$data = array('device_id' => $request->json('device_id'));
					
					$query = Users::where('email', $email)
							->update($data);
				}
				
				
				$result = array(
					'status'		=> 'success',
					'remember'		=> $remember,
					'token'			=> $token,
					'level_akses'	=> $level_akses
				);
			}
			else
			{
				$result = array(
					'status'	=> 'fail',
					'messages'	=> 'The email and password you entered don\'t match.'
				);
			}
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }
    
    /*
	*	To resend email verification
	*	
	*	params
	*		> email
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
	*/
    function resendverification(Request $request)
    {
    	$validator = Validator::make($request->json()->all(), [    
			'email' 				=> 'required|email|max:255'
        ]);
		
		if (!$validator->fails())
		{
			$email = $request->json('email');
			
			$isUserExist = Users::where('email', $email)
				->get()
				->toarray();
			
			if (!empty($isUserExist))
			{
				if ($isUserExist[0]['verify_email'] != 'yes')
				{
					$data = [
						'email'			=> $isUserExist[0]['email'],
						'namaUser' 		=> $isUserExist[0]['nama_user'],
						'pin'		 	=> $isUserExist[0]['pin'],
						'verifyEmail'	=> $isUserExist[0]['verify_email']
					];
					
					Mail::send('auth.emails.verifyemail', $data, function($message) use($data)
					{
						$message->from('noreply@vourest.com', 'Vourest');
						$message->to($data['email'], $data['namaUser']);
						$message->subject('Aktifkan akun Vourest Anda');
					});
	
					if (!Mail::failures())
					{
						$result = array(
							'status' 	=> 'success',
							'messages'	=> 'Please verify your email address'
						);
					}
					else
					{
						$result = array(
							'status' 	=> 'fail'
						);
					}
				}
				else
				{
					$result = array(
						'status' 	=> 'faile',
						'messages'	=> 'The email address is already registered'
					);
				}
			}
			else
			{
				$result = array(
					'status' 	=> 'fail',
					'messages'	=> 'The email address isn\'t registered'
				);
			}
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }
    
    /*
	*	To resend email verification
	*	
	*	params
	*		> email
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
	*/
    function forgotPassword(Request $request)
    {
    	$validator = Validator::make($request->json()->all(), [    
			'email' 				=> 'required|email|max:255'
        ]);
		
		if (!$validator->fails())
		{
			$email = $request->json('email');
			
			$isUserExist = Users::where('email', $email)
				->get()
				->toarray();
			
			if (!empty($isUserExist))
			{
				$verifyPasswordReset = $isUserExist[0]['pin'] . '|' . Carbon::today()->toDateString();
        		$verifyPasswordReset = app($this->controller)->encryptkhusus($verifyPasswordReset);
        		
				$data = [
					'email'					=> $isUserExist[0]['email'],
					'namaUser' 				=> $isUserExist[0]['nama_user'],
					'verifyPasswordReset'	=> $verifyPasswordReset
				];
				
				Mail::send('auth.emails.verifyforgotpassword', $data, function($message) use($data)
				{
					$message->from('noreply@vourest.com', 'Vourest');
					$message->to($data['email'], $data['namaUser']);
					$message->subject('Reset password akun Vourest Anda');
				});
				if (!Mail::failures())
				{
					$result = array(
						'status' 	=> 'success',
						'messages'	=> 'Verification link has been sent to Your email. Please verify your email address.'
					);
				}
				else
				{
					$result = array(
						'status' 	=> 'fail'
					);
				}
			}
			else
			{
				$result = array(
					'status' 	=> 'fail',
					'messages'	=> 'The email address isn\'t registered'
				);
			}
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }
    
    /*
	*	To return user profile
	*	
	*	params
	*		> token
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
 	*		> pin
 	*		> email
 	*		> nama_user
 	*		> alamat_user
 	*		> kota_user
 	*		> country_code_user
 	*		> mobile_phone_user
 	*		> tanggal_lahir
 	*		> gender
 	*		> total_poin_resto
 	*		> saldo
	*/
	function userProfile(Request $request) {
		$validator = Validator::make($request->json()->all(), [    
			'token' 		=> 'required'
        ]);
		
		if (!$validator->fails())
		{
			$token = $request->json('token');
			$decrypt = app($this->controller)->decryptkhusus($token);
			$explode = explode('|', $decrypt);
			$email = $explode[0];
			
			$user = Users::where('email', '=', $email)
				->get()
				->toarray();
			
			$id_user = $user[0]['id_user'];
			
			$query = Users::select(
				'email',
				'nama_user',
				'alamat_user',
				'kota_user',
				'country_code_user',
				'mobile_phone_user',
				'tanggal_lahir',
				'gender',
				'occupation',
				'foto',
				'id_user'
				)
				->where('email', '=', $email)
				->get()
				->toarray();
				
			$cards = Cards::where('id_user', '=', $query['0']['id_user'])
				->get()
				->toarray();
				
			$result = array(
				'status'		=> 'success',
				'user_profile'	=> $query,
				'cards'			=> $cards
			);
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }
	
    
    /*
	*	To edit user profile
	*	
	*	params
	*		> token
	*		> nama_user
	*		> alamat_user
	*		> kota_user
	*		> country_code_user
	*		> mobile_phone_user
	*		> tanggal_lahir
	*		> gender
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
	*/
	function editUserProfile(Request $request) {
		if(empty($request->json('foto'))){
			$validator = Validator::make($request->json()->all(), [    
				'token' 				=> 'required',
				'nama_user' 			=> 'required|max:255|regex:/[\w ]/',
				'alamat_user' 			=> 'required|max:255',
				'kota_user' 			=> 'required|max:100',
				// 'country_code_user' 	=> 'required|max:4',
				// 'mobile_phone_user' 	=> 'required|max:20',
				// 'gender'				=> 'required|in:Pria,Wanita',
				// 'tanggal_lahir' 		=> 'required|date|regex:/[0-9]{4}-[0-9]{2}-[0-9]{2}/',
			]);
		} else {
			$validator = Validator::make($request->json()->all(), [    
				'token' 				=> 'required',
				'foto' 					=> 'required',
			]);
		}
		
		if (!$validator->fails())
		{
			$picture = $request->file('avatar');
				
			if ($picture)
			{
				$fileName = $picture->getClientOriginalName(); // renameing image
				$avatar = time() . '_' . rand(1,100) . '_' . $fileName;
				
				//path image location 
				$path = '/opt/lampp/htdocs/vourest/assets/images/profile/'.$avatar; 
			
				// Determine if the given path is writable
				$img = Image::make($picture)->fit(200, 200);
				$img->save($path); // uploading file
			}
			else
			{
				$avatar = "";
			}
			if(!empty($request->json('foto'))){
				$data = array(
					'foto' 			=> $request->json('foto')
				);
			}
			else {
				if(!empty($request->json('country_code_user'))){
					$data = array(
						'nama_user' 			=> $request->json('nama_user'),
						'alamat_user' 			=> $request->json('alamat_user'),
						'kota_user' 			=> $request->json('kota_user'),
						'country_code_user' 	=> $request->json('country_code_user'),
						'mobile_phone_user' 	=> $request->json('mobile_phone_user')
					);
				} else {
					$data = array(
						'nama_user' 			=> $request->json('nama_user'),
						'alamat_user' 			=> $request->json('alamat_user'),
						'kota_user' 			=> $request->json('kota_user')
					);
				}
				
			}
			
			
			$token = $request->json('token');
			$decrypt = app($this->controller)->decryptkhusus($token);
			$explode = explode('|', $decrypt);
			$email = $explode[0];
			$query = Users::where('email', '=', $email)
 				->update($data);
				
			if ($query)
			{
				$result = array(
					'status'	=> 'success'
				);
			}
			else
			{
				$result = array(
					'status'	=> 'fail',
					'messages'	=> ''
				);
			}
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }
    /*
	*	To edit user profile
	*	
	*	params
	*		> token
	*		> nama_user
	*		> alamat_user
	*		> kota_user
	*		> country_code_user
	*		> mobile_phone_user
	*		> tanggal_lahir
	*		> gender
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
	*/
	function editUserProfileAndroid(Request $request) {
		$validator = Validator::make($request->json()->all(), [    
			'token' 				=> 'required',
			/*'nama_user' 			=> 'required|max:255|regex:/[\w ]/',
            'alamat_user' 			=> 'required|max:255',
			'kota_user' 			=> 'required|max:100',
			'country_code_user' 	=> 'required|max:3',
			'mobile_phone_user' 	=> 'required|min:7|max:12|regex:/\d/',
			'gender'				=> 'required|in:Pria,Wanita',
			'tanggal_lahir' 		=> 'required|date|regex:/[0-9]{4}-[0-9]{2}-[0-9]{2}/'*/
			
        ]);
		
		if (!$validator->fails())
		{
			$picture = $request->json('avatar');
			
			/*if ($picture)
			{
				$fileName = $picture->getClientOriginalName(); // renameing image
				$avatar = time() . '_' . rand(1,100) . '_' . $fileName;
				
				//path image location 
				$path = '/opt/lampp/htdocs/vourest/assets/images/profile/'.$avatar; 
			
				// Determine if the given path is writable
				$img = Image::make($picture)->fit(200, 200);
				$img->save($path); // uploading file
			}
			else
			{
				$avatar = "";
			}*/
			$token = $request->json('token');
			$decrypt = app($this->controller)->decryptkhusus($token);
			$explode = explode('|', $decrypt);
			$email = $explode[0];
			$pin = Users::select('pin')->where('email', $email)->get()->toArray();
			if($picture){
						
				$decoded = base64_decode($picture);
				$avatar = $pin[0]['pin'].'.jpg';
				$path = 'assets/Maxx/pages/img/profile/'.$avatar; 
			 	$img = Image::make($decoded)->fit(200, 200);
			 	$img->save($path); // uploading file	
			}else{
				$avatar = "";
			}
			$data = array(
			/*	'nama_user' 			=> $request->json('nama_user'),
				'alamat_user' 			=> $request->json('alamat_user'),
				'kota_user' 			=> $request->json('kota_user'),
				'country_code_user' 	=> $request->json('country_code_user'),
				'mobile_phone_user' 	=> $request->json('mobile_phone_user'),
				'gender' 				=> $request->json('gender'),
				'tanggal_lahir' 		=> $request->json('tanggal_lahir'),*/
				'foto' 					=> $avatar
			);
			
			$query = Users::where('email', '=', $email)
 				->update($data);
				
			if ($query)
			{
				$result = array(
					'status'	=> 'success'
				);
			}
			else
			{
				$result = array(
					'status'	=> 'fail',
					'messages'	=> ''
				);
			}
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }
    
    /*
	*	To check URL reset password
	*	
	*	params
	*		> verify_reset_password
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
	*/
	function resetPassword(Request $request) {
		$validator = Validator::make($request->json()->all(), [    
			'verify_reset_password' 	=> 'required'
        ]);
		
		if (!$validator->fails())
		{
			$verifyResetPassword = $request->json('verify_reset_password');
			
			$decrypt = app($this->controller)->decryptkhusus($verifyResetPassword);
			$explode = explode('|', $decrypt);
			$pin = $explode[0];
			$date = $explode[1];
			
			if ($date == Carbon::today()->toDateString())
			{
				$isUserExist = Users::where('pin', '=', $pin)
					->get()
					->toarray();
				
				if (!empty($isUserExist))
				{
					$result = array(
						'status'	=> 'success'
					);
				}
				else
				{
					$result = array(
						'status'	=> 'fail',
						'messages'	=> 'Unknown URL reset password link'
					);
				}
			}
			else
			{
				$result = array(
					'status'	=> 'fail',
					'messages'	=> 'The reset token already expired'
				);
			}
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }
    
    /*
	*	To check URL reset password
	*	
	*	params
	*		> verify_reset_password
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
	*/
    function resetPasswordNow(Request $request)
    {
    	$validator = Validator::make($request->json()->all(), [    
			'reset_token' 	=> 'required',
			'password'		=> 'required|max:60'
        ]);
		
		if (!$validator->fails())
		{
			$resetToken = $request->json('reset_token');
			
			$decrypt = app($this->controller)->decryptkhusus($resetToken);
			$explode = explode('|', $decrypt);
			$pin = $explode[0];
			$date = $explode[1];
			
			if ($date == Carbon::today()->toDateString())
			{
				$password = $request->json('password');
				
				$isUserExist = Users::where('pin', '=', $pin)
					->get()
					->toarray();
				
				if (!empty($isUserExist))
				{
					$query = Users::where('pin', '=', $pin)
						->update([
							'password' => bcrypt($password)
						]);
				
					if ($query)
					{
						$result = array(
							'status'	=> 'success',
							'messages'	=> 'Reset password is successfull'
						);
					}
					else
					{
						$result = array(
							'status'	=> 'fail',
							'messages'	=> ''
						);
					}
				}
				else
				{
					$result = array(
						'status'	=> 'fail',
						'messages'	=> 'Unknown URL reset password link'
					);
				}
			}
			else
			{
				$result = array(
					'status'	=> 'fail',
					'messages'	=> 'The reset token already expired'
				);
			}
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }
    
    /*
	*	To change password
	*	
	*	params
	*		> token
	*		> old_password
	*		> new_password
	*
	*	return
 	*		> status
 	*			- success
 	*			- fail
	*/
	function changePassword(Request $request) {
		$validator = Validator::make($request->json()->all(), [    
			'token' 				=> 'required',
			'old_password' 			=> 'required|max:60',
            'new_password' 			=> 'required|max:60'
        ]);
		
		if (!$validator->fails())
		{
			$oldPassword = $request->json('old_password');
			$newPassword = bcrypt($request->json('new_password'));
			
			$token = $request->json('token');
			$decrypt = app($this->controller)->decryptkhusus($token);
			$explode = explode('|', $decrypt);
			$email = $explode[0];
			
			$isValid = Auth::attempt([
				'email'		=> $email,
				'password'	=> $oldPassword
			]);
			
			if ($isValid)
			{
 				$query = Users::where('email', '=', $email)
					->update(array('password' => $newPassword));
				
				if ($query)
				{
					$result = array(
						'status'	=> 'success'
					);
				}
				else
				{
					$result = array(
						'status'	=> 'fail',
						'messages'	=> ''
					);
				}
 			}
 			else
 			{
 				$result = array(
 					'status' 	=> 'fail',
 					'messages'	=> 'The old password you entered don\'t match.');
 			}
		}
		else
		{
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		
		return json_encode($result);
    }
}