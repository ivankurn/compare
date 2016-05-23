<?php
namespace App\Http\Controllers\API\v1;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Users;
use App\Http\Models\ReportMember;
use App\Http\Models\ContactUs;
use App\Http\Models\Situs;

use DB;
use Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;
use Validator;
use PushNotification;


trait C_API_MaxxCoffee
{   
	public function curlPOST(Request $request) {  
        $validator = Validator::make($request->json()->all(), [
            'token'     => 'required',
            'input'     => 'required',
            'url'       => 'required',
        ]);

        if($validator->fails()){
            $result = array(
                'status'  => 'fail',
                'messages'  => $validator->errors()
            );
        }
        else{
          /*  $admin = $this->dispatcher->json([
                'token'   => $request->json('token')
                ])->post('api/cekadmin');
            $admin = json_decode($admin, true);

            if($admin['status'] == 'admin'){*/
                $url = html_entity_decode($request->json('url'));                                                                    
                
                $data_string = json_encode($request->json('input'));

                $ch = curl_init($url);                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                    'Content-Type: application/json',                                                                                
                    'Content-Length: ' . strlen($data_string))                                                                       
                ); 

                $result = curl_exec($ch);
                $result = json_decode($result, true);

            /*}
            else{
                $result = array(
                    'status'  => 'fail',
                    'messages'  => 'you don\'t have permission'
                );
            }*/
        }
        return json_encode($result);
    }

    function curlGET(Request $request){
    	$validator = Validator::make($request->json()->all(), [
            'token'     => 'required',
            'url'       => 'required',
        ]);

        if($validator->fails()){
            $result = array(
                'status'  => 'fail',
                'messages'  => $validator->errors()
            );
        }
        else{
           	$url = html_entity_decode($request->json('url'));

           	$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,$url);
	
			$result = curl_exec($ch);
			$result = json_decode($result, true);
        }
        return json_encode($result);
    }

	function pushNotification(Request $request) {
		$device_id = $request->json('device_id');
		$messages = $request->json('messages');
		$subject = $request->json('subject');
		
		$validator = Validator::make($request->json()->all(), [
    		'device_id'			=> 'required',
    		'messages'			=> 'required'
        ]);
		
		if (!$validator->fails()) 
		{
			 $notification_message = PushNotification::Message($messages, array(
					'badge' => 1,
					'actionLocKey' => 'Read new message: '. $subject,
					'locKey' => $subject,
					'message'   => $messages,
					'title'     => $subject,
					'subtitle'  => $messages,
					'tickerText'    => 'Read new message: '. $subject,
					'largeIcon' => 'ionic',
					'smallIcon' => 'ionic',
					'launchImage' => 'ionic'
			));
		
			$collection = PushNotification::app('appNameAndroid')
						 ->to($device_id);
			//it was need to set 'sslverifypeer' parameter to false
			$collection->adapter->setAdapterParameters(['sslverifypeer' => false]);
			$collection->send($notification_message);
	
			$result = array(
					'status' 		=> 'success',
					'subject'	=> $subject,
					'messages'	=> $messages,
					'collection'	=> $collection
				);
		} else {
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> 'Need device_id and messages.'
			);
		}
		return json_encode($result);
	}
	
	
	function aboutMaxxCoffee(Request $request) {
		$query = Situs::select(
						'Situs.about'
						)
					->get()
					->toarray();
					
		$result = array(
					'status' 	=> 'success',
					'about'		=> $query['0']['about']
				);
		return json_encode($result);
	}
	 
	function tosMaxxCoffee(Request $request) {
		$query = Situs::select(
						'Situs.tos'
						)
					->get()
					->toarray();
		$result = array(
					'status' 	=> 'success',
					'tos'		=> $query['0']['tos']
				);
		return json_encode($result);
	}

	function cekAdmin(Request $request){
		$validator = Validator::make($request->json()->all(), [    
			'token' 	=> 'required',
        ]);

		if ($validator->fails()){
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		else{
			$token 		= $request->json('token');
			$decrypt 	= app($this->controller)->decryptkhusus($token);
			$explode 	= explode('|', $decrypt);
			$is_admin	= $explode[2];

			if($is_admin == '1'){
				$result = array(
						'status' => 'admin'
				);
			}
			else{
				$result = array(
						'status' => 'customer'
				);
			}
		}

		return json_encode($result);
	}

	function reportMember(Request $request){
		$validator = Validator::make($request->json()->all(), [    
			'token' 	=> 'required',
        ]);
		
		if ($validator->fails()){
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		else{
			$admin = $this->dispatcher->json([
						'token'		=> Session::get('token')
					])->post('api/cekadmin');
			$admin = json_decode($admin);

			if($admin['status'] == 'admin'){
				$report = ReportMember::get()->toArray();
				$result = array(
						'result' => $report
					);
			}
			else{
				$result = array(
					'status' 	=> 'you don\'t have permission'
				);
			}
		}

		return json_encode($result);
	}
	
	function contactAdd(Request $request){
		$validator = Validator::make($request->json()->all(), [    
			'nama'		=> 'required',
			'email' 	=> 'required',
			'nohp'		=> 'required',
			'alamat' 	=> 'required',
			'perihal' 	=> 'required',
			'pesan' 	=> 'required'
        ]);
		
		if ($validator->fails()){
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		else{
			date_default_timezone_set('Asia/Jakarta');
			$data = array(
				'nama' 			=> $request->json('nama'),
				'email' 		=> $request->json('email'),
				'no_hp' 		=> $request->json('nohp'),
				'alamat'		=> $request->json('alamat'),
				'perihal' 		=> $request->json('perihal'),
				'pesan' 		=> $request->json('pesan'),
				'created_at' 	=> date("Y-m-d H:i:s"),
				'updated_at' 	=> date("Y-m-d H:i:s")
			);
			$save = ContactUs::create($data);
			
			if($save){
				$result = array(
					'status'	=> 'success'
				);
			}
			else{
				$result = array(
					'status'	=> 'fail',
					'messages'	=> 'unknown error'
				);
			}
		}
		return json_encode($result);
	}
}