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

class C_MaxxCoffee extends Controller
{
    use Helpers;
	
	public $dispatcher;
	
    public function __construct()
    {
    	$this->controller = app('App\Http\Controllers\Controller');
        $this->dispatcher = app('Dingo\Api\Dispatcher');
    }

    public function about()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/about');
				$responseArray = json_decode($response, true);
				
				$data = array();
				$data['about']				= $responseArray['about'];
				$data['sidebar_active_sub']	= 'about';
				$data['maintenance']  		= '';
				
				return view('content.Customer.About', $data);
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
	
	public function Faq()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$data = array();
				$data['sidebar_active_sub']	= 'Faq';
				$data['maintenance']  		= 'This section is under maintenance or under construction.';
				
				return view('content.Customer.Faq', $data);
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
	
	public function tos()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$response = $this->dispatcher
				->json([
					'token'		=> Session::get('token')
				])
				->post('api/tos');
				$responseArray = json_decode($response, true);
				
				$data = array();
				$data['tos']				= $responseArray['tos'];
				$data['sidebar_active_sub']	= 'tos';
				$data['maintenance']  		= '';
				
				return view('content.Customer.Tos', $data);
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
	
	public function contact()
    {
    	if(!empty(Session::get('token')))
    	{
			if(Session::get('lv') == "Customer")
			{
				$data = array();
				$data['sidebar_active_sub']	= 'contact';
				$data['maintenance']  		= '';

				return view('content.Customer.Contact', $data);
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
	
	public function contactAdd(Request $request)
    {
		$respond = $this->dispatcher->json([
				'nama'		=> $request->input('nama'),
				'email'		=> $request->input('email'),
				'nohp'		=> $request->input('nohp'),
				'alamat'	=> $request->input('alamat'),
				'perihal'	=> $request->input('perihal'),
				'pesan'		=> $request->input('pesan')
			])->post('api/contactadd');
		
		$respondArray = json_decode($respond, true);

		if($respondArray['status'] == "success"){
			return redirect('contact')->with('success', 'We\'ve received Your Enquiry. Thank You.');
		} else {
			return redirect('contact')->with('Error', $respondArray['messages']);
		}
    }
}
