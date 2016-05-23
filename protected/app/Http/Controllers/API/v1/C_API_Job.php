<?php
namespace App\Http\Controllers\API\v1;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Job;
use App\Http\Models\MenuPrice;
use App\Http\Models\Kategori;
use App\Http\Models\Tag;

use DB;
use Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;
use Validator;
use PushNotification;


trait C_API_Job
{   
	function jobList(Request $request){
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
			$job 			= Job::all()->toArray();
			$jobActive 		= Job::where('status', '=', '1')->get()->toArray();
			$jobNonActive	= Job::where('status', '=', '0')->get()->toArray();

			if(empty($job)){
				$result = array(
						'status' 	=> 'fail',
						'messages' 	=> 'empty'
					);
			}
			else{
				$result = array(
						'status'	=> 'success',
						'result_1'	=> $job,
						'result_2'	=> $jobActive,
						'result_3'	=> $jobNonActive
					);
			}
		}

		return json_encode($result);
	}

	function jobSelected(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 	=> 'required',
				'id_job'	=> 'required'
			]);

		if($validator->fails()){
			$result = array(
					'status' 	=> 'fail',
					'messages'	=> $validator->errors()
				);
		}
		else{
			$job = Job::where('id_job', $request->json('id_job'))->get()->toArray();

			if(empty($job)){
				$result = array(
						'status' 	=> 'fail',
						'messages' 	=> 'empty'
					);	
			}
			else{
				$result = array(
						'status' 	=> 'success',
						'result' 	=> $job
					);
			}
		}
		return json_encode($result);
	}

	function jobCreate(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 		=> 'required',
				'nama_job' 		=> 'required',
				'requirement' 	=> 'required',
				'gambar' 		=> 'required',
				'date_start' 	=> 'required',
				'date_end' 		=> 'required'
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
						'nama_job' 		=>  $request->json('nama_job'),
						'requirement' 	=>  $request->json('requirement'),
						'gambar' 		=>  $request->json('gambar'),
						'date_start' 	=>  $request->json('date_start'),
						'date_end' 		=>  $request->json('date_end'),
						'status' 		=>  '1'
					);

				$add = Job::create($data);

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

	function jobUpdate(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 		=> 'required',
				'id_job' 		=> 'required',
				'nama_job' 		=> 'required',
				'requirement' 	=> 'required',
				'gambar' 		=> 'required',
				'date_start' 	=> 'required',
				'date_end' 		=> 'required'
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
						'nama_job' 		=>  $request->json('nama_job'),
						'requirement' 	=>  $request->json('requirement'),
						'gambar' 		=>  $request->json('gambar'),
						'date_start' 	=>  $request->json('date_start'),
						'date_end' 		=>  $request->json('date_end'),
						'status' 		=>  $request->json('status')
					);

				if(Job::where('id_job', $request->json('id_job'))->update($data)){
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
	
	public function statusJobNonActive(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 	=> 'required',
				'id_job'	=> 'required'
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
					'status' => '0'
				);

				if(Job::where('id_job', $request->json('id_job'))->update($data)){
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

	function deleteJob(Request $request){
		$validator 	= Validator::make($request->json()->all(), [
				'token' 	=> 'required',
				'id_job'	=> 'required'
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
				if(Job::where('id_job', $request->json('id_job'))->delete()){
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