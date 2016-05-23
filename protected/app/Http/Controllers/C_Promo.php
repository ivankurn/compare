<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Menu;

use Validator;
use DB;
use Illuminate\Routing\UrlGenerator;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;

use Dingo\Api\Routing\Helpers;

class C_Promo extends Controller
{
    use Helpers;
	
	public $dispatcher;
	
    public function __construct()
    {
    	$this->controller = app('App\Http\Controllers\Controller');
        $this->dispatcher = app('Dingo\Api\Dispatcher');
    }

    public function promo()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$data = array();
				$data['sidebar_active_sub']	= 'promo';
				$data['maintenance']  		= 'This section is under maintenance or under construction.';
				
				return view('content.Customer.Promo', $data);
			}  
			else 
			{
				return redirect('home');
			}
		}
		else
		{
			return redirect('logout');
		}
    }
}
