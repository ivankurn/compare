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

class C_Home extends Controller
{
    use Helpers;
	
	public $dispatcher;
	
    public function __construct()
    {
    	$this->controller = app('App\Http\Controllers\Controller');
        $this->dispatcher = app('Dingo\Api\Dispatcher');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Admin Sistem"){
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/userprofile');
				$profile = json_decode($response, true);

				$data = array();
				$data['sidebar_active']		= 'home';
				$data['profile']  			= $profile['user_profile']['0'];
				
				return view('content.Admin.Home', $data);
			} 
			else{
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/userprofile');
				$profile = json_decode($response, true);
				
				$data = array();
				$data['sidebar_active']		= 'home';
				$data['profile']  			= $profile['user_profile']['0'];
				$data['cards']  			= $profile['cards'];
				
				return view('content.Customer.Home', $data);

			}
		}
		else
		{
			return redirect('logout');
		}
    }
    
	public function logout()
    {
		Session::flush();
		
		return redirect('login');
	}
}
