<?php
namespace App\Http\Controllers\API\v1;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Store;
use App\Http\Models\Events;

use DB;
use Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;
use Validator;
use PushNotification;


trait C_API_Event
{   
	function eventList(Request $request){
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
			$event 			= Events::join('Store', 'Store.id_store', '=', 'Event.id_store')
							->select(
								'Events.id_event',
								'Store.id_store',
								'Store.nama_store',
								'Events.nama_event',
								'Events.waktu_start',
								'Events.waktu_end',
								'Events.deskripsi',
								'Events.gambar'
								)
							->get()
							->toArray();

			if(empty($event)){
				$result = array(
						'status' 	=> 'fail',
						'messages' 	=> 'empty'
					);
			}
			else{
				$result = array(
						'status'	=> 'success',
						'result'	=> $event
					);
			}
		}

		return json_encode($result);
	}

	function eventSelected(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 	=> 'required',
				'id_event'	=> 'required'
			]);

		if($validator->fails()){
			$result = array(
					'status' 	=> 'fail',
					'messages'	=> $validator->errors()
				);
		}
		else{
			$event 			= Events::join('Store', 'Store.id_store', '=', 'Event.id_store')
							->select(
								'Events.id_event',
								'Store.id_store',
								'Store.nama_store',
								'Events.nama_event',
								'Events.waktu_start',
								'Events.waktu_end',
								'Events.deskripsi',
								'Events.gambar'
								)
							->where('Events.id_event', $request->json('id_event'))
							->get()
							->toArray();

			if(empty($promo)){
				$result = array(
						'status' 	=> 'fail',
						'messages' 	=> 'empty'
					);	
			}
			else{
				$result = array(
						'status' 	=> 'success',
						'result' 	=> $promo
					);
			}
		}
		return json_encode($result);
	}

	function eventCreate(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 		=> 'required',
				'id_store' 		=> 'required',
				'nama_event' 	=> 'required',
				'waktu_start'	=> 'required',
				'waktu_end' 	=> 'required',
				'deskripsi' 	=> 'required',
				'gambar' 		=> 'required'
			]);
		
		if($validator->fails()){
			$result = array(
					'status' 	=> 'fail',
					'messages'	=> $validator->errors()
				);
		}
		else{
			//ceking hakakses
			$admin = $this->dispatcher->json([
						'token'		=> $request->json('token')
					])->post('api/cekadmin');
			$admin = json_decode($admin, true);

			if($admin['status'] == 'admin'){
				$data = array(
						'id_store' 		=>  $request->json('id_store'),
						'nama_event' 	=>  $request->json('nama_event'),
						'waktu_start' 	=>  $request->json('waktu_start'),
						'waktu_end' 	=>  $request->json('waktu_end'),
						'deskripsi' 	=>  $request->json('deskripsi'),
						'gambar' 		=>  $request->json('gambar')
					);

				$add = Events::create($data);

				if($add){
					$result = array(
							'status' => 'success'
						);
				}
				else{
					$result = array(
							'status' => 'fail'
						);
				}
			}
			else{
				$result = array(
						'status' 	=> 'fail',
						'messages' 	=> 'you don\'t have permission'
					);
			}
		}
		return json_encode($result);
	}

	function eventUpdate(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 		=> 'required',
				'id_event' 		=> 'required',
				'id_store' 		=> 'required',
				'nama_event' 	=> 'required',
				'waktu_start'	=> 'required',
				'waktu_end' 	=> 'required',
				'deskripsi' 	=> 'required',
				'gambar' 		=> 'required'
			]);
		
		if($validator->fails()){
			$result = array(
					'status' 	=> 'fail',
					'messages'	=> $validator->errors()
				);
		}
		else{
			//ceking hakakses
			$admin = $this->dispatcher->json([
						'token'		=> $request->json('token')
					])->post('api/cekadmin');
			$admin = json_decode($admin, true);

			if($admin['status'] == 'admin'){
				$data = array(
						'id_store' 		=>  $request->json('id_store'),
						'nama_event' 	=>  $request->json('nama_event'),
						'waktu_start' 	=>  $request->json('waktu_start'),
						'waktu_end' 	=>  $request->json('waktu_end'),
						'deskripsi' 	=>  $request->json('deskripsi'),
						'gambar' 		=>  $request->json('gambar')
					);

				if(Events::where('id_event', $request->json('id_event'))->update($data)){
					$result = array(
							'status' => 'success'
						);
				}
				else{
					$result = array(
							'status' => 'fail'
						);
				}
			}
			else{
				$result = array(
						'status' 	=> 'fail',
						'messages' 	=> 'you don\'t have permission'
					);
			}
		}
		return json_encode($result);
	}
	
	function deleteEvent(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 	=> 'required',
				'id_event'	=> 'required'
			]);

		if($validator->fails()){
			$result = array(
					'status' 	=> 'fail',
					'messages'	=> $validator->errors()
				);
		}
		else{
			//ceking hakakses
			$admin = $this->dispatcher->json([
						'token'		=> $request->json('token')
					])->post('api/cekadmin');
			$admin = json_decode($admin, true);

			if($admin['status'] == 'admin'){
				if(Events::where('id_event', $request->json('id_event'))->delete()){
					$result = array(
							'status' => 'success'
						);
				}
				else{
					$result = array(
							'status' => 'fail'
						);
				}
			}
			else{
				$result = array(
						'status' 	=> 'fail',
						'messages' 	=> 'you don\'t have permission'
					);
			}
		}
		return json_encode($result);
	}
	
}