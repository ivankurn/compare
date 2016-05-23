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
use App\Http\Models\Store;
use App\Http\Models\Fitur;
use App\Http\Models\FiturStore;
use App\Http\Models\Pulau;
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


trait C_API_Stores{

	function storeList(Request $request){
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
			$stores = Store::leftjoin('FiturStore', 'FiturStore.id_store', '=', 'Store.id_store')
			->leftjoin('Fitur', 'FiturStore.id_fitur', '=', 'Fitur.id_fitur')
			->select(
					'Store.id_store',
					'Store.slug_store',
					'Store.nama_store',
					'Store.alamat_store',
					'Store.kota_store',
					'Store.provinsi_store',
					'Store.pulau',
					'Store.kodepos_store',
					'Store.latitude',
					'Store.longitude',
					'Store.jam_buka',
					'Store.jam_tutup',
					'Store.phone_store',
					DB::raw('GROUP_CONCAT(Fitur.nama_fitur ORDER BY Fitur.nama_fitur) as nama_fitur'),
					DB::raw('GROUP_CONCAT(Fitur.icon ORDER BY Fitur.nama_fitur) as icon_fitur')
					)
				->groupBy('Store.id_store')
				->orderBy('Store.nama_store', 'asc')
				->get()
				->toarray();
				
			$fiturstores = Store::leftjoin('FiturStore', 'FiturStore.id_store', '=', 'Store.id_store')
								->leftjoin('Fitur', 'FiturStore.id_fitur', '=', 'Fitur.id_fitur')
								->select('Fitur.nama_fitur')
								->groupBy('Fitur.nama_fitur')->get()->toarray();
			$pulau = Store::select('Store.pulau')->groupBy('Store.pulau')->get()->toarray();
			
			if(empty($stores)){
				$result = array(
					'status' 	=> 'fail',
					'messages'	=> 'empty'
				);
			}
			else{
				$result = array(
					'status' 		=> 'success',
					'result'		=> $stores,
					'fiturstores'	=> $fiturstores,
					'pulau'			=> $pulau
				);
			}
		}
		return json_encode($result);
	}
	
	function storeListByPulau(Request $request){
		$validator = Validator::make($request->json()->all(), [
			'token' 	=> 'required',
			'pulau' 	=> 'required',
			
		]);

		if($validator->fails()){
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		else{
			$stores = Store::leftjoin('FiturStore', 'FiturStore.id_store', '=', 'Store.id_store')
			->leftjoin('Fitur', 'FiturStore.id_fitur', '=', 'Fitur.id_fitur')
			->select(
					'Store.id_store',
					'Store.slug_store',
					'Store.nama_store',
					'Store.alamat_store',
					'Store.kota_store',
					'Store.provinsi_store',
					'Store.pulau',
					'Store.kodepos_store',
					'Store.latitude',
					'Store.longitude',
					'Store.jam_buka',
					'Store.jam_tutup',
					'Store.phone_store',
					DB::raw('GROUP_CONCAT(Fitur.nama_fitur ORDER BY Fitur.nama_fitur) as nama_fitur'),
					DB::raw('GROUP_CONCAT(Fitur.icon ORDER BY Fitur.nama_fitur) as icon_fitur')
					)
				->where('Store.pulau', '=', $request->json('pulau'))
				->groupBy('Store.id_store')
				->orderBy('Store.nama_store', 'asc')
				->get()
				->toarray();
				
			$fiturstores = Store::leftjoin('FiturStore', 'FiturStore.id_store', '=', 'Store.id_store')
								->leftjoin('Fitur', 'FiturStore.id_fitur', '=', 'Fitur.id_fitur')
								->select('Fitur.nama_fitur')
								->groupBy('Fitur.nama_fitur')->get()->toarray();
								
			$pulau = Store::select('pulau')->groupBy('pulau')->get()->toarray();
			
			if(empty($stores)){
				$result = array(
					'status' 	=> 'fail',
					'messages'	=> 'empty',
					'fiturstores'	=> $fiturstores,
					'pulau'			=> $pulau
				);
			}
			else{
				$result = array(
					'status' 		=> 'success',
					'result'		=> $stores,
					'fiturstores'	=> $fiturstores,
					'pulau'			=> $pulau
				);
			}
		}
		return json_encode($result);
	}
    

    function storeSelected(Request $request){
    	$validator = Validator::make($request->json()->all(), [
			'token' 	=> 'required',
			'id_store' 	=> 'required'
		]);

		if($validator->fails()){
			$result = array(
				'status'	=> 'fail',
				'messages' 	=> $validator->errors()
			);
		}
		else{
			$store = Store::where('id_store', $request->json('id_store'))->get()->toArray();

			if(empty($store)){
				$result = array(
					'status' 	=> 'fail',
					'messages'	=> 'no store selected'
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

    function storeCreate(Request $request){
    	$validator = Validator::make($request->json()->all(), [
			'token' 			=> 'required',
			'nama_store' 		=> 'required',
			'slug_store' 		=> 'required',
			'alamat_store' 		=> 'required',
			'kota_store' 		=> 'required',
			'provinsi_store'	=> 'required',
			'pulau'				=> 'required',
			'kodepos_store' 	=> 'required',
			'latitude' 			=> 'required',
			'longitude'			=> 'required',
			'jam_buka' 			=> 'required',
			'jam_tutup'			=> 'required',
			'phone_store'		=> 'required'
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
						'nama_store' 		=> $request->json('nama_store'),
						'alamat_store' 		=> $request->json('alamat_store'),
						'pulau' 			=> $request->json('pulau'),
						'kota_store' 		=> $request->json('kota_store'),
						'provinsi_store'	=> $request->json('provinsi_store'),
						'kodepos_store' 	=> $request->json('kodepos_store'),
						'latitude' 			=> $request->json('latitude'),
						'longitude'			=> $request->json('longitude'),
						'jam_buka' 			=> $request->json('jam_buka'),
						'jam_tutup'			=> $request->json('jam_tutup'),
						'phone_store'		=> $request->json('phone_store'),
					);

				$save = Store::create($data);

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

    function storeUpdate(Request $request){
    	$validator = Validator::make($request->json()->all(), [
			'token' 			=> 'required',
			'id_store' 			=> 'required',
			'nama_store' 		=> 'required',
			'alamat_store' 		=> 'required',
			'pulau' 			=> 'required',
			'kota_store' 		=> 'required',
			'provinsi_store'	=> 'required',
			'kodepos_store' 	=> 'required',
			'latitude' 			=> 'required',
			'longitude'			=> 'required',
			'jam_buka' 			=> 'required',
			'jam_tutup'			=> 'required',
			'phone_store'		=> 'required'
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
						'nama_store' 		=> $request->json('nama_store'),
						'alamat_store' 		=> $request->json('alamat_store'),
						'pulau' 			=> $request->json('pulau'),
						'kota_store' 		=> $request->json('kota_store'),
						'provinsi_store'	=> $request->json('provinsi_store'),
						'kodepos_store' 	=> $request->json('kodepos_store'),
						'latitude' 			=> $request->json('latitude'),
						'longitude'			=> $request->json('longitude'),
						'jam_buka' 			=> $request->json('jam_buka'),
						'jam_tutup'			=> $request->json('jam_tutup'),
						'phone_store'		=> $request->json('phone_store'),
					);

				if(Store::where('id_store', $request->json('id_store'))->update($data)){
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