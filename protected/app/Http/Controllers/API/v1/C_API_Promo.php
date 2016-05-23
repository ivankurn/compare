<?php
namespace App\Http\Controllers\API\v1;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Promo;
use App\Http\Models\Users;

use DB;
use Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;
use Validator;
use PushNotification;


trait C_API_Promo
{   
	function promoList(Request $request){
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
			$promo 			= Promo::join('Users', 'Promo.id_user', '=', 'Users.id_user')
							->select(
								'Users.nama_user',
								'Users.id_user',
								'Promo.id_promo',
								'Promo.id_store',
								'Promo.nama_promo',
								'Promo.deskripsi',
								'Promo.gambar'
								)
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
						'status'	=> 'success',
						'result'	=> $promo
					);
			}
		}

		return json_encode($result);
	}

	function promoSelected(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 	=> 'required',
				'id_promo'	=> 'required'
			]);

		if($validator->fails()){
			$result = array(
					'status' 	=> 'fail',
					'messages'	=> $validator->errors()
				);
		}
		else{
			$promo 			= Promo::join('Users', 'Promo.id_user', '=', 'Users.id_user')
							->select(
								'Users.nama_user',
								'Users.id_user',
								'Promo.id_store',
								'Promo.nama_promo',
								'Promo.deskripsi',
								'Promo.gambar'
								)
							->where('Promo.id_promo', $request->json('id_promo'))
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

	function promoCreate(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 		=> 'required',
				'id_store' 		=> 'required',
				'id_pembuat' 	=> 'required',
				'nama_promo'	=> 'required',
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
						'id_pembuat' 	=>  $request->json('id_pembuat'),
						'nama_promo' 	=>  $request->json('nama_promo'),
						'deskripsi' 	=>  $request->json('deskripsi'),
						'gambar' 		=>  $request->json('gambar')
					);

				$add = Promo::create($data);

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

	function promoUpdate(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 		=> 'required',
				'id_promo' 		=> 'required',
				'id_store' 		=> 'required',
				'id_pembuat' 	=> 'required',
				'nama_promo'	=> 'required',
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
						'id_pembuat' 	=>  $request->json('id_pembuat'),
						'nama_promo' 	=>  $request->json('nama_promo'),
						'deskripsi' 	=>  $request->json('deskripsi'),
						'gambar' 		=>  $request->json('gambar')
					);

				if(Promo::where('id_promo', $request->json('id_promo'))->update($data)){
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
	
	function deletePromo(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 	=> 'required',
				'id_promo'	=> 'required'
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
				if(Promo::where('id_promo', $request->json('id_promo'))->delete()){
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