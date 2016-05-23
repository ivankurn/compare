<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Store;
use App\Http\Models\Pulau;
use App\Http\Models\Provinsi;
use App\Http\Models\Kota;

use Validator;
use DB;
use Illuminate\Routing\UrlGenerator;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;

use Dingo\Api\Routing\Helpers;

class C_Stores extends Controller
{
    use Helpers;
	
	public $dispatcher;
	
    public function __construct()
    {
    	$this->controller = app('App\Http\Controllers\Controller');
        $this->dispatcher = app('Dingo\Api\Dispatcher');
    }

    public function stores()
    {
    	if(!empty(Session::get('token'))){
			if(Session::get('lv') == "Admin Sistem"){
				$data = array();
				$data['sidebar_active']		= 'store';
				$data['sidebar_active_sub']	= 'store list';
				$data['maintenance']  		= '';
				$store = $this->dispatcher->json([
						'token'		=> Session::get('token')
					])->post('api/store');
				$store = json_decode($store, true);

				if($store['status'] == "success"){
					$data['store'] = $store['result'];
				}
				else{
					$data['store'] = "";
				}

				return view('content.Admin.Stores', $data);
			}  
			else{
				
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token'),
					'pulau'		=> 'Jawa'
				])
				->post('api/storebypulau');
				$responseArray = json_decode($response, true);
				
				if(!empty($responseArray['result'])){
					$data = array();
					$data['stores']				= $responseArray['result'];
					$data['pulau']				= $responseArray['pulau'];
					$data['fiturstores']		= $responseArray['fiturstores'];
					$data['current_pulau']		= 'Jawa';
					$data['sidebar_active_sub']	= 'stores';
					$data['maintenance']  		= '';
					$data['error']				= '';
				} else {
					$data['error']				= 'No Stores found in this island';
					$data['pulau']				= $responseArray['pulau'];
					$data['current_pulau']		= 'Please Choose another island';
					$data['maintenance']  		= '';
				}

				return view('content.Customer.Stores', $data);
			}
		}
		else{
			return redirect('logout');
		}
    }
	
	public function storesByIsland(Request $request, $pulau)
    {
    	if(!empty(Session::get('token'))){
			$response = $this->dispatcher
			->json([
				'token'		=> Session::get('token'),
				'pulau'		=> ucfirst($pulau)
			])
			->post('api/storebypulau');
			$responseArray = json_decode($response, true);

			if(!empty($responseArray['result'])){
				$data = array();
				$data['stores']				= $responseArray['result'];
				$data['pulau']				= $responseArray['pulau'];
				$data['fiturstores']		= $responseArray['fiturstores'];
				$data['current_pulau']		= $pulau;
				$data['sidebar_active_sub']	= 'stores';
				$data['maintenance']  		= '';
				$data['error']				= '';
			} else {
				$data['error']				= 'No Stores found in this island';
				$data['pulau']				= $responseArray['pulau'];
				$data['current_pulau']		= 'Please Choose another island';
				$data['maintenance']  		= '';
			}
			
			return view('content.Customer.Stores', $data);
			
		}
		else{
			return redirect('logout');
		}
    }

    public function selectedStore(Request $request, $slug){
    	if(empty(Session::get('token'))){
    		return redirect('logout');
    	}
    	else{
    		$checking = Store::where('slug_store', $slug)->get()->toArray();

    		if(empty($checking)){
    			return redirect('admin/store/list')->with('error', 'Store Not Found!');
    		}
    		else{
    			$data = array();
				$data['sidebar_active']		= 'store';
				$data['sidebar_active_sub']	= 'store list';

				//api
    			$store = $this->dispatcher
				->json([
					'token'		=> Session::get('token'),
					'id_store' 	=> $checking[0]['id_store']
				])
				->post('api/store');
				$store = json_decode($store, true);

				if($store['status'] == "success"){
					$data['store'] = $store['result'];
				}
				else{
					$data['store'] = "";
				}

				return view('content.Admin.Stores_edit', $data);
    		}
    	}
    }

    public function getKota(Request $request){
    	$var = $request->input('id_provinsi');
    	
	
		$kota = Kota::select('nama_kota')->where('id_provinsi', $var)->get()->toArray();

		if(empty($kota)){
			$city = '<input type="text" class="form-control input-sm" value="-- Menu is empty --" readonly>';
		}
		else{
			$city = '<select class="form-control select2" name="kota" >';
                     
    		foreach($kota as $su){
    			$city .= "<option value='".$su['nama_kota'] ."'> ". $su['nama_kota']." </option>";
    		} 	

    		$city .= "</select>";
		}
    	
    	echo $city;
    }

    public function getPropinsi(Request $request){
    	$var = $request->input('id_pulau');
    	
	
		$kota = Provinsi::select('id_provinsi','nama_provinsi')->where('id_pulau', $var)->get()->toArray();

		/*if(empty($kota)){
			$city = '<input type="text" class="form-control input-sm" value="-- Menu is empty --" readonly>';
		}
		else{
			$city = '<select class="form-control select2" name="provinsi" id="mySelect" onchange="myFunction(this)">';
                     
    		foreach($kota as $su){
    			$city .= "<option value='".$su['id_provinsi'] ."|" .$su['nama_provinsi']. "'> ". $su['nama_provinsi']." </option>";
    		} 	

    		$city .= "</select>";
		}*/
    	
    	return json_encode($kota);
    }

    public function createStore(Request $request){
    	if(!empty(Session::get('token'))){
			if(Session::get('lv') == "Admin Sistem"){
				$data = array();
				$data['sidebar_active']		= 'store';
				$data['sidebar_active_sub']	= 'store add';
				
				$pulau 			= Pulau::all()->toArray();
				$data['pulau'] 	= $pulau;

				return view('content.Admin.Stores_create', $data);
			}  
			else{
				return redirect('home');
			}
		}
		else{
			return redirect('logout');
		}
    }

    public function createStorePost(Request $request){
    	if(!empty(Session::get('token'))){
			if(Session::get('lv') == "Admin Sistem"){
				$post = $request->all();
				
				$provinsi 	= $post['provinsi_store'];
				$prov 		= explode("|", $provinsi);
				$province 	= $prov[1];

				$store = $this->dispatcher
				->json([
					'token'				=> Session::get('token'),
					'nama_store'		=> $post['name_store'],
					'slug_store'		=> $post['slug_store'],
					'alamat_store'		=> $post['alamat'],
					'kota_store'		=> $post['kota'],
					'pulau'				=> $post['pulau'],
					'provinsi_store'	=> $province,
					'kodepos_store'		=> $post['kodepos_store'],
					'latitude'			=> $post['latitude'],
					'longitude' 		=> $post['longitude'],
					'jam_buka' 			=> $post['jam_buka'],
					'jam_tutup' 		=> $post['jam_tutup'],
					'phone_store' 		=> $post['phone_store']
				])
				->post('api/storecreate');
				$store = json_decode($store, true);

				if($store['status'] == "success"){
					return redirect('admin/store/list')->with('success', 'New store successfully added!');
				}
				else{
					return redirect('admin/store/list')->with('error', 'New store unsuccessfully added!');
				}
			}  
			else{
				return redirect('home');
			}
		}
		else{
			return redirect('logout');
		}
    }

}
