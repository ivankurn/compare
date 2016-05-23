<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Cards;

use Validator;
use DB;
use Illuminate\Routing\UrlGenerator;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector;

use Dingo\Api\Routing\Helpers;

class C_Cards extends Controller
{
    use Helpers;
	
	public $dispatcher;
	
    public function __construct()
    {
    	$this->controller = app('App\Http\Controllers\Controller');
        $this->dispatcher = app('Dingo\Api\Dispatcher');
    }

    public function cards()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$data = array();
				$data['sidebar_active_sub']	= 'my cards';
				$data['maintenance']  		= 'This section is under maintenance or under construction.';
				
				return view('content.Customer.Cards', $data);
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
	
	public function addCard()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$data = array();
				$data['sidebar_active_sub']	= 'add card';
				$data['maintenance']  		= 'This section is under maintenance or under construction.';
				
				return view('content.Customer.Cards_Add', $data);
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
	
	public function topup()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$data = array();
				$data['sidebar_active_sub']	= 'topup';
				$data['maintenance']  		= 'This section is under maintenance or under construction.';
				
				return view('content.Customer.Cards_Topup', $data);
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
	
	public function transfer()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$data = array();
				$data['sidebar_active_sub']	= 'transfer';
				$data['maintenance']  		= 'This section is under maintenance or under construction.';
				
				return view('content.Customer.Cards_Transfer', $data);
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
	
	public function lost()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$data = array();
				$data['sidebar_active_sub']	= 'lost card';
				$data['maintenance']  		= 'This section is under maintenance or under construction.';
				
				return view('content.Customer.Cards_Lost', $data);
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
