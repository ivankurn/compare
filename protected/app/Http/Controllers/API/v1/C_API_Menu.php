<?php
namespace App\Http\Controllers\API\v1;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Menu;
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


trait C_API_Menu
{   
	function menuList(Request $request){
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
			$query = Menu::leftjoin('Kategori', 'Kategori.id_kategori', '=', 'Menu.id_kategori')
					->leftjoin('Tag', 'Tag.id_menu', '=', 'Menu.id_menu')
					->leftjoin('MenuPrice', 'MenuPrice.id_menu', '=', 'Menu.id_menu')
					->select(
						'Menu.id_Menu',
						'Menu.nama_menu',
						'Menu.available_size',
						'Menu.available_type',
						'Menu.deskripsi',
						'Menu.gambar',
						'Menu.redeem_point',
						'Menu.status',
						'Menu.created_at',
						'Menu.updated_at',
						'Kategori.id_kategori',
						'Kategori.kategori',
						DB::raw('GROUP_CONCAT(Tag.tag) as tags'),
						DB::raw('GROUP_CONCAT(MenuPrice.type) as type'),
						DB::raw('GROUP_CONCAT(MenuPrice.size) as size'),
						DB::raw('GROUP_CONCAT(MenuPrice.harga) as harga')
						)
					->groupBy('Menu.id_Menu')
					->where('Menu.status', '=', 'Aktif')
					->where('MenuPrice.harga', '!=', '0')
					->get()
					->toarray();
					
			$kategori = Menu::leftjoin('Kategori', 'Kategori.id_kategori', '=', 'Menu.id_kategori')
					->leftjoin('MenuPrice', 'MenuPrice.id_menu', '=', 'Menu.id_menu')
					->select(
						'Kategori.kategori'
						)
					->groupBy('Kategori.kategori')
					->where('Menu.status', '=', 'Aktif')
					->where('MenuPrice.harga', '!=', '0')
					->get()
					->toarray();
			if($query){
				$result = array(
						'status'	=> 'success',
						'result'	=> $query,
						'kategori'	=> $kategori
					);
			} else {
				$result = array(
					'status' 	=> 'fail',
					'messages'	=> 'unknown error'
				);
			}
		}
		return json_encode($result);
	}
	
	function menuSelected(Request $request){
		$validator = Validator::make($request->json()->all(), [    
			'token' 	=> 'required',
			'id_menu' 	=> 'required',
        ]);
		
		if ($validator->fails()){
			$result = array(
				'status' 	=> 'fail',
				'messages'	=> $validator->errors()
			);
		}
		else{
			$query = Menu::leftjoin('Kategori', 'Kategori.id_kategori', '=', 'Menu.id_kategori')
					->leftjoin('Tag', 'Tag.id_menu', '=', 'Menu.id_menu')
					->leftjoin('MenuPrice', 'MenuPrice.id_menu', '=', 'Menu.id_menu')
					->select(
						'Menu.id_Menu',
						'Menu.nama_menu',
						'Menu.available_size',
						'Menu.available_type',
						'Menu.deskripsi',
						'Menu.gambar',
						'Menu.redeem_point',
						'Menu.status',
						'Menu.created_at',
						'Menu.updated_at',
						'Kategori.id_kategori',
						'Kategori.kategori',
						DB::raw('GROUP_CONCAT(Tag.tag) as tags'),
						DB::raw('GROUP_CONCAT(MenuPrice.type) as type'),
						DB::raw('GROUP_CONCAT(MenuPrice.size) as size'),
						DB::raw('GROUP_CONCAT(MenuPrice.harga) as harga')
						)
					->groupBy('Menu.id_Menu')
					->where('Menu.id_Menu', '=', $request->json('id_menu'))
					->get()
					->toarray();
			if($query){
				$result = array(
						'status'	=> 'success',
						'result'	=> $query
					);
			} else {
				$result = array(
					'status' 	=> 'fail',
					'messages'	=> 'unknown error'
				);
			}
			
		}
		return json_encode($result);
	}
	
	function menuCreate(Request $request){
    	$validator = Validator::make($request->json()->all(), [
			'token' 			=> 'required',
			'plu_id' 			=> 'required',
			'id_kategori'		=> 'required',
			'nama_menu' 		=> 'required',
			'harga' 			=> 'required',
			'deskripsi' 		=> 'required',
			'gambar'			=> 'required',
			'redeem_point' 		=> 'required',
			'status' 			=> 'required',
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
						'plu_id' 			=> $request->json('plu_id'),
						'id_kategori' 		=> $request->json('id_kategori'),
						'nama_menu' 		=> $request->json('nama_menu'),
						'harga' 			=> $request->json('harga'),
						'deskripsi'			=> $request->json('deskripsi'),
						'gambar' 			=> $request->json('gambar'),
						'redeem_point' 		=> $request->json('redeem_point'),
						'status' 			=> $request->json('redeem_point')
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
}