<?php

namespace App\Http\Controllers\API\v1;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Requests;


class C_API_All extends Controller
{
	public $controller;
	public $dispatcher;
	
	public function __construct()
 	{
    	$this->controller = "App\Http\Controllers\Controller";
      	$this->dispatcher = app('Dingo\Api\Dispatcher');
    }

    
  use C_API_Event;
  use C_API_Job;
  use C_API_Promo;
  use C_API_MaxxCoffee;
  use C_API_Menu;
  use C_API_Reward;
  use C_API_Stores;
  use C_API_User;

}
