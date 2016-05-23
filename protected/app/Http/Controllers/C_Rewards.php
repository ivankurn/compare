<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Rewards;

use Image;
use Validator;
use DB;
use Illuminate\Routing\UrlGenerator;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;

use Dingo\Api\Routing\Helpers;

class C_Rewards extends Controller
{
    use Helpers;
	
	public $dispatcher;
	
    public function __construct()
    {
    	$this->controller = app('App\Http\Controllers\Controller');
        $this->dispatcher = app('Dingo\Api\Dispatcher');
    }

    public function rewards()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Admin Sistem")
			{
				$data = array();
				$data['sidebar_active'] 	= 'reward';
				$data['sidebar_active_sub'] = 'reward list';

				$reward = $this->dispatcher->json([
						'token'		=> Session::get('token')
					])->post('api/rewards');
				$reward = json_decode($reward, true);

				if($reward['status'] == 'success'){
					$data['reward'] = $reward['result'];
				}
				else{
					$data['reward'] = '';
				}

				return view('content.Admin.Reward', $data);
			}  
			else 
			{
				$data = array();
				$data['sidebar_active_sub']	= 'rewards';
				$data['maintenance']  		= 'This section is under maintenance or under construction.';
				
				return view('content.Customer.Rewards', $data);
			}
		}
		else
		{
			return redirect('logout');
		}
    }

    public function createReward(Request $request){
    	if(!empty(Session::get('token'))){
			if(Session::get('lv') == "Admin Sistem"){
				$data = array();
				$data['sidebar_active'] 	= 'reward';
				$data['sidebar_active_sub'] = 'reward add';

				return view('content.Admin.Reward_create');
			}
			else{
				return redirect('home');
			}
		}
		else{
			return redirect('logout');
		}
    }

    public function createRewardPost(Request $request){
    	if(!empty(Session::get('token'))){
			if(Session::get('lv') == "Admin Sistem"){
				$post = $request->all();
				
				$gambar = $request->file('gambar');

				if(empty($gambar)){
					$gambar = "none";
				}
				else{
					$ext 		= $gambar->getClientOriginalExtension();
					$imgName 	= $request->input('nama_reward').'_'.time().'.'.$ext;
					$path 		= 'assets/Maxx/pages/img/rewards/'.$imgName; 
		 			$img 		= Image::make($gambar)->fit(400, 400);
		 			$img->save($path);

		 			$gambar = $imgName;
				}

				$reward = $this->dispatcher->json([
						'token'			=> Session::get('token'),
						'nama_reward'	=> $request->input('nama_reward'),
						'deskripsi'		=> $request->input('deskripsi'),
						'reward'		=> $request->input('reward'),
						'gambar'		=> $gambar,

					])->post('api/rewardcreate');
				$reward = json_decode($reward, true);

				if($reward['status'] == 'success'){
					return redirect('admin/reward/list')->with('success', 'Reward successfully added!');
				}
				else{
					return redirect('admin/reward/list')->with('error', 'Reward unsuccessfully added!');
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

    public function editReward(Request $request){
    	if(!empty(Session::get('token'))){
			if(Session::get('lv') == "Admin Sistem"){
				$reward = $this->dispatcher->json([
						'token'			=> Session::get('token'),
						'id_reward'		=> $request->input('id_reward')

					])->post('api/rewardselected');	

				$reward = json_decode($reward, true);

				if($reward['status'] == 'success'){
					$data['reward'] = $reward['result'];
				}
				else{
					$data['reward'] = '';
				}

				return view('content.Admin.Reward_edit', $data);
			}
			else{
				return redirect('home');
			}
		}
		else{
			return redirect('logout');
		}
    }

    public function editRewardPost(Request $request){
    	if(!empty(Session::get('token'))){
			if(Session::get('lv') == "Admin Sistem"){
				$post = $request->all();
				
				$gambarNya = Rewards::select('gambar')->where('id_reward', $request->input('id_reward'))->get()->toArray();
				$gambarNya = $gambarNya[0]['gambar'];

				$picture = $request->file('gambar');

				if(empty($gambarNya)){
					$ext 		= $picture->getClientOriginalExtension();
					$imgName 	= $request->input('nama_reward').'_'.time().'.'.$ext;
					$path 		= 'assets/Maxx/pages/img/rewards/'.$imgName; 
		 			$img 		= Image::make($picture)->fit(400, 400);
		 			$img->save($path);

		 			$gambar = $imgName;
				}
				else{
					if(file_exists('assets/Maxx/pages/img/rewards/'.$gambarNya.'')){
						if(unlink('assets/Maxx/pages/img/rewards/'.$gambarNya.'')){
							$ext 		= $picture->getClientOriginalExtension();
							$imgName 	= $request->input('nama_reward').'_'.time().'.'.$ext;
							$path 		= 'assets/Maxx/pages/img/rewards/'.$imgName; 
				 			$img 		= Image::make($picture)->fit(400, 400);
				 			$img->save($path);

				 			$gambar = $imgName;
						}
						else{
							$ext 		= $picture->getClientOriginalExtension();
							$imgName 	= $request->input('nama_reward').'_'.time().'.'.$ext;
							$path 		= 'assets/Maxx/pages/img/rewards/'.$imgName; 
				 			$img 		= Image::make($picture)->fit(400, 400);
				 			$img->save($path);

				 			$gambar = $imgName;
						}
					}
					else{
						$ext 		= $picture->getClientOriginalExtension();
						$imgName 	= $request->input('nama_reward').'_'.time().'.'.$ext;
						$path 		= 'assets/Maxx/pages/img/rewards/'.$imgName; 
			 			$img 		= Image::make($picture)->fit(400, 400);
			 			$img->save($path);

			 			$gambar = $imgName;
					}
				}

				$reward = $this->dispatcher->json([
						'token'			=> Session::get('token'),
						'id_reward'		=> $request->input('id_reward'),
						'nama_reward'	=> $request->input('nama_reward'),
						'deskripsi'		=> $request->input('deskripsi'),
						'reward'		=> $request->input('reward'),
						'gambar'		=> $gambar,

					])->post('api/rewardupdate');	

				$reward = json_decode($reward, true);


				print_r($reward);
				exit();
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
