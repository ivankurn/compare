<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Users;

use Validator;
use DB;
use Illuminate\Routing\UrlGenerator;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;

use Dingo\Api\Routing\Helpers;
use Lang;
use Image;

class C_Users extends Controller
{
	use Helpers;
	
	public $dispatcher;
	public $server;
	
	
	public function __construct()
    {
    	$this->controller = app('App\Http\Controllers\Controller');
     	$this->dispatcher = app('Dingo\Api\Dispatcher');
        $this->server = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/";
    }
	
    public function index()
    {
    
	}
	
	public function login()
	{
		$token = Session::get('token');
		
		if (empty($token))
		{
			return view('auth.simpleAuth',
				[
					'page'			=> 'login'
				]
			);
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function loginPost(Request $request)
	{
		$token = Session::get('token');
		
		if (empty($token))
		{
			$response = $this->dispatcher
				->json([
					'email'		=> $request->input('email'),
					'password'	=> $request->input('password'),
					'remember'	=> $request->input('remember')
				])
				->post('api/login');
			
			$responseArray = json_decode($response, true);
			
			if (!empty($responseArray) && $responseArray['status'] == 'success')
			{
				if ($responseArray['remember'] == '1')
				{
					$lifetime = time() + 60 * 60 * 24 * 365; // one year
				   	Config::set('session.lifetime', $lifetime);
				}
			
				Session::put('token', $responseArray['token']);
				Session::put('lv', $responseArray['level_akses']);
				Session::put('sidebar', $responseArray['level_akses']);
				
				return redirect('home');
			}
			else
			{
				return view('auth.simpleAuth', 
					[
						'page'			=> 'login',
						'messages'		=> $responseArray['messages']
					]
				);
			}
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function register()
	{
		$token = Session::get('token');
		
		if (empty($token))
		{
			return view('auth.simpleAuth', 
				[
					'page'			=> 'register'
				]
			);
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function registerPost(Request $request)
	{
		$token = Session::get('token');
		
		if (empty($token))
		{
			$data = [
				'email'				=> $request->input('email'),
				'password'			=> $request->input('password'),
				'nama_user'			=> $request->input('nama_user'),
				'alamat_user'		=> $request->input('alamat_user'),
				'kota_user'			=> $request->input('kota_user'),
				'country_code_user'	=> $request->input('country_code_user'),
				'mobile_phone_user'	=> $request->input('mobile_phone_user'),
				'gender'			=> $request->input('gender'),
				'occupation'		=> $request->input('occupation'),
				'tanggal_lahir'		=> $request->input('tanggal_lahir')
			];
			$response = $this->dispatcher
				->json($data)
				->post('api/register');
			
			$responseArray = json_decode($response, true);
		
			if (!empty($responseArray) && $responseArray['status'] == 'success')
			{
				return view('auth.simpleAuth', 
					[
						'page'			=> 'login', 
						'messages'		=> trans('auth.please_verify_email')
					]
				);
			}
			else
			{
				return view('auth.simpleAuth', 
					[
						'page'			=> 'register',
						'data'			=> $data, 
						'messages'		=> $responseArray['messages']
					]
				);
			}
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function profile()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$data = array();
				$data['sidebar_active_sub']	= 'profile';
				$data['maintenance']  		= 'This section is under maintenance or under construction.';
				
				return view('content.Customer.Profile', $data);
			}  
			else 
			{
				return redirect('home');
			}
		}
		else
		{
			return redirect('logout');
		}
    }
	
	public function verifyEmail($pin, $verifyEmail)
	{
		$response = $this->dispatcher
			->json([
				'pin'			=> $pin,
				'verify_email'	=> $verifyEmail
			])
			->post('api/verifyemail');
	
		$responseArray = json_decode($response, true);
		
		if (!empty($responseArray) && $responseArray['status'] == 'success')
		{
			// return Redirect::route('login', array('messages' =>  $responseArray['messages']));
			return redirect('login')->with('messages', $responseArray['messages']);
			/*
			return view('auth.simpleAuth',
				[
					'page'			=> 'login',
					'messages'		=> $responseArray['messages']
				]
			);
			*/
		}
		else
		{
			// return Redirect::route('login', array('error' =>  $responseArray['messages']));
			return redirect('login')->with('messages', $responseArray['messages']);
			/* return view('auth.simpleAuth',
				[
					'page'			=> 'login',
					'messages'		=> $responseArray['messages']
				]
			); */
		}
	}
	
	public function editUserProfile()
	{
		$token = Session::get('token');
		
		if (empty($token))
		{
			return response()->view('content.');
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function editUserProfilePost(Request $request)
	{
		$token = Session::get('token');

		if (!empty($token))
		{
			$response = $this->dispatcher
				->json([
					'token'			=> $token,
					'nama_user'		=> $request->input('nama'),
					'alamat_user'	=> $request->input('alamat'),
					'kota_user'		=> $request->input('kota'),
					'gender'		=> $request->input('gender'),
					'tanggal_lahir'	=> $request->input('tanggal_lahir')
				])
				->post('api/edituserprofile');
			
			$responseArray = json_decode($response, true);
			$data = array();
			
			if (!empty($responseArray) && $responseArray['status'] == 'success')
			{
				$response = $this->dispatcher
				->json([
					'token'		=> $token
				])
				->post('api/userprofile');
				$profile = json_decode($response, true);

				$data['profile'] = $profile['user_profile']['0'];
				$data['jumlah_transaksi'] = $profile['transaction']['0'];
				$data['point_resto'] = $profile['point'];
				$data['message'] = "Your Profile has been updated.";
				$data['sidebar_active']  = "profile";
				$data['sidebar_active_sub']  = "profile";
				
				return response()->view('content.Customer.Profile', $data);
			}
			else
			{
				$data['message'] = "Failed to Update.";
				return response()->view('content.Customer.Profile', $data);
			}
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function resetPassword($verify_reset_password)
	{
		$token = Session::get('token');
		
		if (empty($token))
		{
			$response = $this->dispatcher
			->json([
				'verify_reset_password'		=> $verify_reset_password
			])
			->post('api/resetpassword');
		
			$responseArray = json_decode($response, true);
			
			if (!empty($responseArray) && $responseArray['status'] == 'success')
			{
				return view('auth.passwords.reset', [
					'verify_reset_password'	=> $verify_reset_password
				]);
			}
			else
			{
				return redirect('login')->with('error', $responseArray['messages']);
			}
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function resetPasswordPost(Request $request)
	{
		$token = Session::get('token');
		
		if (empty($token))
		{
			$response = $this->dispatcher
				->json([
					'reset_token'	=> $request->input('reset_token'),
					'password'		=> $request->input('password')
				])
				->post('api/resetpasswordnow');
		
			$responseArray = json_decode($response, true);
		
			if (!empty($responseArray) && $responseArray['status'] == 'success')
			{
				return redirect('login')->with('messages', $responseArray['messages']);
			}
			else
			{
				if (is_array($responseArray['messages']))
				{
					return view('auth.passwords.reset', [
						'verify_reset_password'	=> $request->input('reset_token'),
						'messages'				=> $responseArray['messages']]
					);
				}
				else
				{
					return redirect('login')->with('messages', $responseArray['messages']);
				}
			}
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function forgotPassword()
	{
		return view('auth.simpleAuth',
			[
				'page'			=> 'forgotpassword'
			]
		);
	}
	
	public function forgotPasswordPost(Request $request)
	{
		$response = $this->dispatcher
			->json([
				'email'		=> $request->input('email')
			])
			->post('api/forgotpassword');
		
		$responseArray = json_decode($response, true);
		
		if (!empty($responseArray) && $responseArray['status'] == 'success')
		{
			return view('auth.simpleAuth',
				[
					'page'			=> 'login',
					'messages'		=> $responseArray['messages']
				]
			);
		}
		else
		{
			return view('auth.simpleAuth', 
				[
					'page'			=> 'forgotpassword',
					'error'		=> $responseArray['messages']
				]
			);
		}
	}
	
	public function profileUser(Request $request)
	{
		$token = Session::get('token');
		if (!empty($token))
		{
			$data = array();
			
			//if edit password
			if(!empty($request->input('lama_Password'))){
				$response = $this->dispatcher
				->json([
					'token'			=> $token,
					'old_password'	=> $request->input('lama_Password'),
					'new_password'	=> $request->input('new_password')
				])
				->post('api/changepassword');
				$responseArray = json_decode($response, true);
				if (!empty($responseArray) && $responseArray['status'] == 'success')
				{
					$data['message'] = "Your Password has been updated.";
				} else {
					$data['error'] = $responseArray['messages'];
				}
			}
			
			//if edit profile
			if(!empty($request->input('nama'))){
				$response = $this->dispatcher
				->json([
					'token'			=> $token,
					'nama_user'		=> $request->input('nama'),
					'alamat_user'	=> $request->input('alamat'),
					'kota_user'		=> $request->input('kota'),
					'gender'		=> $request->input('gender'),
					'tanggal_lahir'	=> $request->input('tanggal_lahir')
				])
				->post('api/edituserprofile');
			
				$responseArray = json_decode($response, true);
				if (!empty($responseArray) && $responseArray['status'] == 'success')
				{
					$data['message'] = "Your Profile has been updated.";
				} else {
					$data['error'] = $responseArray['messages'];
				}
			}
			
			//if edit foto
			if(!empty($request->file('foto'))){
					$response = $this->dispatcher
						->json([
							'token'		=> $token
						])
						->post('api/userprofile');
					$user = json_decode($response, true);
					$pin = $user['user_profile']['0']['pin'];
		        	//uploadfile
					$logo = $request->file('foto');
					$img = $logo->getClientOriginalName();
					$imgarray = explode(".",$img);
					$max = max(array_keys($imgarray));
					$ext = $imgarray[$max];
					
					
					$imgName = $pin.'.'.$ext;
		 			$path = 'assets/Maxx/pages/img/profile/'.$imgName; 
		 			$img = Image::make($logo)->fit(400, 400);
		 			$img->save($path); // uploading file

					$response = $this->dispatcher
					->json([
						'token'		=> $token,
						'foto'		=> $imgName
					])
					->post('api/edituserprofile');
				
					$responseArray = json_decode($response, true);
					
					if (!empty($responseArray) && $responseArray['status'] == 'success')
					{
						$data['message'] = "Your Profile photo's has been updated.";
					} else {
						$data['error'] = $responseArray['messages'];
					}				
			}
			
			$response = $this->dispatcher
				->json([
					'token'		=> $token
				])
				->post('api/userprofile');
			$profile = json_decode($response, true);
			
			//------AMBIL DATA NOTIFIKASI-------//
			//-----WAJIB DI SEMUA HALAMAN-------//
			$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/hitungnotifikasiunread');
			$unread_count = json_decode($response, true);
			
			$unread_message = array();
			$unread_message['data'] = "empty";
			
			if($unread_count['data']['0']['unread'] != "0"){
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token'),
					'skip'		=> 0,
					'take'		=> $unread_count['data']['0']['unread']
				])
				->post('api/notifikasibyuser');
				$unread_message = json_decode($response, true);
			}
			//------END AMBIL DATA NOTIFIKASI-------//
			//-----END WAJIB DI SEMUA HALAMAN-------//
			
			if (!empty($response) && $profile['status'] == 'success')
			{
				
				$data['profile'] = $profile['user_profile']['0'];
				$data['jumlah_transaksi'] = $profile['transaction']['0'];
				$data['point_resto'] = $profile['point'];
				$data['sidebar_active']  = "profile";
				$data['sidebar_active_sub']  = "profile";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];

				if(Session::get('lv') == "Customer"){
					return response()->view('content.Customer.Profile', $data);	
				}
				elseif(Session::get('lv') == "Admin Sistem"){
					return response()->view('content.Admin.Profile', $data);	
				}
				elseif(Session::get('lv') == "Owner Sistem"){
					return response()->view('content.Owner.Profile', $data);	
				}
				elseif(Session::get('lv') == "Manager Resto"){
					return response()->view('content.Manager.Profile', $data);	
				}
				else{
					return redirect('home');
				}
				
			}
			else
			{
				$data['error'] = "";
				$data['sidebar_active']  = "profile";
				$data['sidebar_active_sub']  = "profile";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				
				if(Session::get('lv') == "Customer"){
					return response()->view('content.Customer.Profile', $data);	
				}
				elseif(Session::get('lv') == "Admin Sistem"){
					return response()->view('content.Admin.Profile', $data);	
				}
				elseif(Session::get('lv') == "Owner Sistem"){
					return response()->view('content.Owner.Profile', $data);	
				}
				elseif(Session::get('lv') == "Manager Resto"){
					return response()->view('content.Manager.Profile', $data);	
				}
				else{
					return redirect('home');
				}
			}
		}
		else
		{
			return redirect('login');
		}
	}
	
	public function notifications(Request $request)
	{
		$token = Session::get('token');
		if (!empty($token))
		{
			//------AMBIL DATA NOTIFIKASI-------//
			//-----WAJIB DI SEMUA HALAMAN-------//
			$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/hitungnotifikasiunread');
			$unread_count = json_decode($response, true);

			$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token'),
					'skip'		=> 0,
					'take'		=> $unread_count['data']['0']['unread']
				])
				->post('api/notifikasibyuser');
			$unread_message = json_decode($response, true);
			
			//------END AMBIL DATA NOTIFIKASI-------//
			//-----END WAJIB DI SEMUA HALAMAN-------//
			$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token'),
					'allstatus'	=> "yes",
					'skip'		=> 0,
					'take'		=> 10
				])
				->post('api/notifikasibyuser');
			$notifications = json_decode($response, true);
			
			if (!empty($response) && $unread_count['status'] == 'success')
			{
				$data = array();
				$data['sidebar_active']  = "profile";
				$data['sidebar_active_sub']  = "notifications";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				if(isset($unread_message['data']))
					$data['unread']  			= $unread_message['data'];
				$data['notif_read']  		= !empty($notifications['read']) ? $notifications['read'] : '';
				$data['notif_unread']  		= !empty($notifications['unread']) ? $notifications['unread'] : '';
				return response()->view('content.Customer.Notification', $data);
			}
			else
			{
				$data = array();
				$data['error'] = "";
				$data['sidebar_active']  = "profile";
				$data['sidebar_active_sub']  = "notifications";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				return response()->view('content.Customer.Notification', $data);
			}
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function notificationsChangeStatus(Request $request)
	{
		$id_notifikasi = $request->input("id_notifikasi");
		$token = $request->input("token");
		if (empty($token))
		{
			return "Token invalid";
		} else {
			$response = $this->dispatcher
			->json([
				'token'			=> $token,
				'id_notifikasi' => $id_notifikasi
			])
			->post('api/setreadnotifikasi');
			$status = json_decode($response, true);
			return $status;
		}
	}
	
	function loadMoreNotifications(Request $request){
		$skip 		= $request->input("skip");
		$token 		= $request->input("token");
		$take 		= $request->input("take");

		if (empty($token))
		{
			return "Token invalid";
		} else {
			
			$response = $this->dispatcher
				->json([
					'token'		=> $token,
					'allstatus'	=> "yes",
					'skip'		=> $skip,
					'take'		=> $take
				])
				->post('api/notifikasibyuser');
			$notifications = json_decode($response, true);
			
			if (!empty($response) && $notifications['status'] == 'success')
			{
				$status = array();
				$status['status'] = "success";
				$status['read'] = $notifications['read'];
				
			}
			else
			{
				$status = "false";
			}
			
			// $status = "dapet datanya";
			/* }
			else{
				$status = "false";
			} */
			
			return $status;
		}
	}
	
	public function topup(Request $request)
	{
		$token = Session::get('token');

		if (!empty($token))
		{
			$response = $this->dispatcher
			->json([
				'token'		=> $token
			])
			->post('api/gettopupnominal');
			
			$responseArray = json_decode($response, true);

			//------AMBIL DATA NOTIFIKASI-------//
			//-----WAJIB DI SEMUA HALAMAN-------//
			$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/hitungnotifikasiunread');
			$unread_count = json_decode($response, true);
			
			$unread_message = array();
			$unread_message['data'] = "empty";
			
			if($unread_count['data']['0']['unread'] != "0"){
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token'),
					'skip'		=> 0,
					'take'		=> $unread_count['data']['0']['unread']
				])
				->post('api/notifikasibyuser');
				$unread_message = json_decode($response, true);
			}
			//------END AMBIL DATA NOTIFIKASI-------//
			//-----END WAJIB DI SEMUA HALAMAN-------//
			
			if (!empty($responseArray) && $responseArray['status'] == 'success')
			{
				$data = array();
				$data['nominal'] 			= $responseArray['data'];
				$data['sidebar_active']  	= "topup";
				$data['sidebar_active_sub'] = "topup";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				return response()->view('content.Customer.Topup', $data);
			}
			else
			{
				$data = array();
				$data['error'] 	= "Unable to load Nominal Topup";
				$data['sidebar_active']  	= "topup";
				$data['sidebar_active_sub'] = "topup";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				return response()->view('content.Customer.Topup', $data);
			}
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function topupPayments(Request $request)
	{
		$token = Session::get('token');
		
		if (!empty($token))
		{
			$nominal = $request->input('nominal');
			Session::put('nominaltopup', $nominal, 60);
			
			$response = $this->dispatcher
			->json([
				'token'		=> $token
			])
			->post('api/gettopuppayments');
		
			$responseArray = json_decode($response, true);
			
			//------AMBIL DATA NOTIFIKASI-------//
			//-----WAJIB DI SEMUA HALAMAN-------//
			$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/hitungnotifikasiunread');
			$unread_count = json_decode($response, true);
			
			$unread_message = array();
			$unread_message['data'] = "empty";
			
			if($unread_count['data']['0']['unread'] != "0"){
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token'),
					'skip'		=> 0,
					'take'		=> $unread_count['data']['0']['unread']
				])
				->post('api/notifikasibyuser');
				$unread_message = json_decode($response, true);
			}
			//------END AMBIL DATA NOTIFIKASI-------//
			//-----END WAJIB DI SEMUA HALAMAN-------//
			
			if (!empty($responseArray) && $responseArray['status'] == 'success')
			{
				$data = array();
				$data['method'] 			= $responseArray['data'];
				$data['sidebar_active']  	= "topup";
				$data['sidebar_active_sub'] = "topup";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				return response()->view('content.Customer.Topup_Methods', $data);
			}
			else
			{
				$data = array();
				$data['sidebar_active']  	= "topup";
				$data['sidebar_active_sub'] = "topup";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				$data['error'] 	= "Unable to load Topup Payments";
				return response()->view('content.Customer.Topup_Methods', $data);
			}
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function topupReview(Request $request)
	{
		$token = Session::get('token');
		
		if (!empty($token))
		{
			$method = $request->input('method');
			Session::put('methodtopup', $method, 60);
			
			$response = $this->dispatcher
			->json([
				'token'		=> $token,
				'method'	=> $method
			])
			->post('api/gettopuppayments');
		
			$responseArray = json_decode($response, true);

			//------AMBIL DATA NOTIFIKASI-------//
			//-----WAJIB DI SEMUA HALAMAN-------//
			$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/hitungnotifikasiunread');
			$unread_count = json_decode($response, true);
			
			$unread_message = array();
			$unread_message['data'] = "empty";
			
			if($unread_count['data']['0']['unread'] != "0"){
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token'),
					'skip'		=> 0,
					'take'		=> $unread_count['data']['0']['unread']
				])
				->post('api/notifikasibyuser');
				$unread_message = json_decode($response, true);
			}
			//------END AMBIL DATA NOTIFIKASI-------//
			//-----END WAJIB DI SEMUA HALAMAN-------//
			
			if (!empty(Session::get('nominaltopup')) && !empty(Session::get('methodtopup')))
			{
				$data = array();
				$data['nominal'] 			= Session::get('nominaltopup');
				$data['method'] 			= $responseArray['datanya'];
				$data['listmethod'] 		= $responseArray['data'];
				$data['sidebar_active']  	= "topup";
				$data['sidebar_active_sub'] = "topup";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				return response()->view('content.Customer.Topup_Reviews', $data);
			}
			else
			{
				$data = array();
				$data['error'] 				= "Unable to load Topup Payment Methods";
				$data['sidebar_active']  	= "topup";
				$data['sidebar_active_sub'] = "topup";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				return response()->view('content.Customer.Topup_Reviews', $data);
			}
		}
		else
		{
			return redirect('home');
		}
	}
	
	public function topupConfirm(Request $request)
	{
		$token = Session::get('token');
		
		if (!empty($token))
		{
			$response = $this->dispatcher
			->json([
				'token'		=> $token,
				'nominal'	=> Session::get('nominaltopup')
			])
			->post('api/addtopup');
		
			$responseArray = json_decode($response, true);
			
			//------AMBIL DATA NOTIFIKASI-------//
			//-----WAJIB DI SEMUA HALAMAN-------//
			$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/hitungnotifikasiunread');
			$unread_count = json_decode($response, true);
			
			$unread_message = array();
			$unread_message['data'] = "empty";
			
			if($unread_count['data']['0']['unread'] != "0"){
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token'),
					'skip'		=> 0,
					'take'		=> $unread_count['data']['0']['unread']
				])
				->post('api/notifikasibyuser');
				$unread_message = json_decode($response, true);
			}
			//------END AMBIL DATA NOTIFIKASI-------//
			//-----END WAJIB DI SEMUA HALAMAN-------//
			
			if (!empty($responseArray) && $responseArray['status'] == 'success')
			{
				$data = array();
				$data['saldobefore'] 		= $responseArray['saldobefore'];
				$data['nominal'] 			= $responseArray['nominal'];
				$data['saldoafter'] 		= $responseArray['saldoafter'];
				$data['sidebar_active']  	= "topup";
				$data['sidebar_active_sub'] = "topup";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				return response()->view('content.Customer.Topup_Finish', $data);
			}
			else
			{
				$data = array();
				$data['error'] 				= "Unable to load Topup Payments";
				$data['sidebar_active']  	= "topup";
				$data['sidebar_active_sub'] = "topup";
				$data['unread_count']		= $unread_count['data']['0']['unread'];
				$data['unread']  			= $unread_message['data'];
				return response()->view('content.Customer.Topup_Finish', $data);
			}
		}
		else
		{
			return redirect('home');
		}
	}
}