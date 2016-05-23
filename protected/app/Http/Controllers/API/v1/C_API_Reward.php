<?php
namespace App\Http\Controllers\API\v1;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Rewards;
use App\Http\Models\Users;
use App\Http\Models\Cards;
use App\Http\Models\Store;
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


trait C_API_Reward{

	function rewardList(Request $request){
		$validator = Validator::make($request->json()->all(), [
			'token' 	=> 'required'
		]);

		if($validator->fails()){
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		else{
			$store = Rewards::all()->toArray();

			if(empty($store)){
				$result = array(
					'status' 	=> 'fail',
					'messages'	=> 'empty'
				);
			}
			else{
				$result = array(
					'status' 	=> 'success',
					'result'	=> $store
				);
			}
		}
		return json_encode($result);
	}
    

    function rewardSelected(Request $request){
    	$validator = Validator::make($request->json()->all(), [
			'token' 	=> 'required',
			'id_reward' 	=> 'required'
		]);

		if($validator->fails()){
			$result = array(
				'status'	=> 'fail',
				'messages' 	=> $validator->errors()
			);
		}
		else{
			$store = Rewards::where('id_reward', $request->json('id_reward'))->get()->toArray();

			if(empty($store)){
				$result = array(
					'status' 	=> 'fail',
					'messages'	=> 'no reward selected'
				);
			}
			else{
				$result = array(
					'status' 	=> 'success',
					'result'	=> $store
				);
			}
		}
		return json_encode($result);
    }

    function rewardCreate(Request $request){
    	$validator = Validator::make($request->json()->all(), [
			'token' 		=> 'required',
			'nama_reward' 	=> 'required',
			'deskripsi' 	=> 'required',
			'reward' 		=> 'required',
			'gambar' 		=> 'required'
		]);

		if($validator->fails()){
			$result = array(
				'status'	=> 'fail',
				'messages' 	=> $validator->errors()
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
						'nama_reward' 	=> $request->json('nama_reward'),
						'deskripsi' 	=> $request->json('deskripsi'),
						'reward' 		=> $request->json('reward'),
						'gambar' 		=> $request->json('gambar')
					);

				$save = Rewards::create($data);

				if($save){
					$result = array(
						'status'	=> 'success'
					);
				}
				else{
					$result = array(
						'status'	=> 'fail'
					);
				}
			}
			else{
				$result = array(
					'status'	=> 'fail',
					'messages' 	=> 'You don\'t have permission'
				);
			}
		}
		return json_encode($result);
    }

    function rewardUpdate(Request $request){
    	$validator = Validator::make($request->json()->all(), [
			'token' 		=> 'required',
			'id_reward'		=> 'required',
			'nama_reward' 	=> 'required',
			'deskripsi' 	=> 'required',
			'reward' 		=> 'required',
			'gambar' 		=> 'required'
		]);

		if($validator->fails()){
			$result = array(
				'status'	=> 'fail',
				'messages' 	=> $validator->errors()
			);
		}
		else{
			//ceking hakakses
			$admin = $this->dispatcher->json([
						'token'		=> $request->json('token')
					])->post('api/cekadmin');
			$admin = json_decode($admin);

			if($admin['status'] == 'admin'){
				$data = array(
						'nama_reward' 	=> $request->json('nama_reward'),
						'deskripsi' 	=> $request->json('deskripsi'),
						'reward' 		=> $request->json('reward'),
						'gambar' 		=> $request->json('gambar')
				);


				if(Rewards::where('id_reward', $request->json('id_reward'))->update($data)){
					$result = array(
						'status'	=> 'success'
					);
				}
				else{
					$result = array(
						'status'	=> 'fail'
					);
				}
			}
			else{
				$result = array(
					'status'	=> 'fail',
					'messages' 	=> 'You don\'t have permission'
				);
			}
		}
		return json_encode($result);
    }

    function rewardDelete(Request $request){
    	$validator = Validator::make($request->json()->all(), [
			'token' 		=> 'required',
			'id_reward'		=> 'required'
		]);

    	if($validator->fails()){
			$result = array(
				'status'	=> 'fail',
				'messages' 	=> $validator->errors()
			);
		}
		else{
			//ceking hakakses
			$admin = $this->dispatcher->json([
						'token'		=> $request->json('token')
					])->post('api/cekadmin');
			$admin = json_decode($admin, true);

			if($admin['status'] == 'admin'){
				if(Rewards::where('id_reward', $request->json('id_reward'))->delete()){
					$result = array(
						'status'	=> 'success'
					);
				}
				else{
					$result = array(
						'status'	=> 'fail'
					);
				}
			}
			else{
				$result = array(
					'status'	=> 'fail',
					'messages' 	=> 'You don\'t have permission'
				);
			}
		}
		return json_encode($result);
    }

   
}