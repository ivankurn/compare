<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) 
{
   $api->group(['middleware' => 'api'], function ($api) 
   {
		$api->any('about', 'App\Http\Controllers\API\v1\C_API_All@aboutMaxxCoffee');
		$api->any('tos', 'App\Http\Controllers\API\v1\C_API_All@tosMaxxCoffee');

		/*
    	*	API User
    	*/
    	/*
			POST: http://maxx.coffee/api/postman
			Parameters: 
				'token'				=> 'required',
				'url'				=> 'required',
				'input'				=> 'required'
		*/
		$api->post('postman', 'App\Http\Controllers\API\v1\C_API_All@curlPOST');

		/*
			POST: http://maxx.coffee/api/getman
			Parameters: 
				'token'				=> 'required',
				'url'				=> 'required',
		*/
		$api->post('getman', 'App\Http\Controllers\API\v1\C_API_All@curlGET');
		
		/*
    	*	API User
    	*/
			
		$api->post('login', 'App\Http\Controllers\API\v1\C_API_All@login');
			/*
			POST: http://maxx.coffee/api/login
			Parameters: 
				'email' 				=> 'required|email|max:255',
				'password'				=> 'required|max:60'
			*/
		$api->post('updatedeviceid', 'App\Http\Controllers\API\v1\C_API_All@updateDeviceId');
			/*
			POST: http://maxx.coffee/api/updatedeviceid
			Parameters: 
				'token' 				=> 'required',
				'device_id'				=> 'required'
			*/
		$api->post('register', 'App\Http\Controllers\API\v1\C_API_All@register');
			/*
			POST: http://maxx.coffee/api/register
			Parameters: 
				'email' 				=> 'required|email|max:255',
				'password'				=> 'required|max:60',
				'nama_user' 			=> 'required|max:255|regex:/[\w ]/',
				'alamat_user' 			=> 'required|max:255',
				'kota_user' 			=> 'required|max:100',
				'country_code_user' 	=> 'required|max:3',
				'mobile_phone_user' 	=> 'required|min:7|max:12|regex:/\d/',
				'gender'				=> 'required|in:Pria,Wanita',
				'tanggal_lahir' 		=> 'required|date|regex:/[0-9]{2}-[0-9]{2}-[0-9]{4}/'
			*/
		$api->post('resendverification', 'App\Http\Controllers\API\v1\C_API_All@resendVerification');
			/*
			POST: http://maxx.coffee/api/resendverification
			Parameters: 
				'email' 				=> 'required|email|max:255'
			*/
		$api->post('forgotpassword', 'App\Http\Controllers\API\v1\C_API_All@forgotPassword');
			/*
			POST: http://maxx.coffee/api/forgotpassword
			Parameters: 
				'email' 				=> 'required|email|max:255'
			*/
		$api->post('resetpassword', 'App\Http\Controllers\API\v1\C_API_All@resetPassword');
			/*
			POST: http://maxx.coffee/api/resetpassword
			Parameters: 
				'verify_reset_password'	=> 'required'
			*/
		$api->post('resetpasswordnow', 'App\Http\Controllers\API\v1\C_API_All@resetPasswordNow');
			/*
			POST: http://maxx.coffee/api/resetpasswordnow
			Parameters: 
				'reset_token'	=> 'required',
				'password'		=> 'required|max:60'
			*/
		$api->post('userprofile', 'App\Http\Controllers\API\v1\C_API_All@userProfile');
			/*
			POST: http://maxx.coffee/api/userprofile
			Parameters: 
				'token' 		=> 'required'
			*/
		$api->post('edituserprofile', 'App\Http\Controllers\API\v1\C_API_All@editUserProfile');
			/*
			POST: http://maxx.coffee/api/edituserprofile
			Parameters: 
				'token' 				=> 'required',
				'nama_user' 			=> 'required|max:255|regex:/[\w ]/',
				'alamat_user' 			=> 'required|max:255',
				'kota_user' 			=> 'required|max:100',
				'gender'				=> 'required|in:Pria,Wanita',
				'tanggal_lahir' 		=> 'required|date|regex:/[0-9]{4}-[0-9]{2}-[0-9]{2}/',
			*/
		$api->post('edituserprofilephone', 'App\Http\Controllers\API\v1\C_API_All@editUserProfileAndroid');
			/*
			POST: http://maxx.coffee/api/edituserprofile
			Parameters: 
				'token' 				=> 'required',
				'nama_user' 			=> 'required|max:255|regex:/[\w ]/',
				'alamat_user' 			=> 'required|max:255',
				'kota_user' 			=> 'required|max:100',
				'country_code_user' 	=> 'required|max:3',
				'mobile_phone_user' 	=> 'required|min:7|max:12|regex:/\d/',
				'gender'				=> 'required|in:Pria,Wanita',
				'tanggal_lahir' 		=> 'required|date|regex:/[0-9]{4}-[0-9]{2}-[0-9]{2}/',
			*/
		$api->post('changepassword', 'App\Http\Controllers\API\v1\C_API_All@changePassword');
			/*
			POST: http://maxx.coffee/api/changepassword
			Parameters: 
				'reset_token' 			=> 'required',
				'password' 				=> 'required|max:60'
			*/

		/*
    	*	API Stores
    	*/
		$api->post('store', 'App\Http\Controllers\API\v1\C_API_All@storeList');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 			=> 'required',
			*/  
		$api->post('storebypulau', 'App\Http\Controllers\API\v1\C_API_All@storeListByPulau');
			/*
			POST: http://maxx.coffee/api/storebypulau
			Parameters: 
				'token' 			=> 'required',
				'pulau' 			=> 'required'
			*/  
		$api->post('storeselected', 'App\Http\Controllers\API\v1\C_API_All@storeSelected');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 			=> 'required',
			*/    	
		$api->post('storecreate', 'App\Http\Controllers\API\v1\C_API_All@storeCreate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token'				=> 'required',
	            'minimal_redeem' 	=> 'required',
	            'id_voucher'		=> 'required',
				'jenis_voucher' 	=> 'required',
				'value' 			=> 'required',
				'alasan' 			=> 'required',
				'tgl_expired' 		=> 'required',
			*/    	
		$api->post('storeupdate', 'App\Http\Controllers\API\v1\C_API_All@storeUpdate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 			=> 'required',
				'id_store' 			=> 'required',
				'nama_store' 		=> 'required',
				'alamat_store' 		=> 'required',
				'kota_store' 		=> 'required',
				'provinsi_store'	=> 'required',
				'kodepos_store' 	=> 'required',
				'latitude' 			=> 'required',
				'longitude'			=> 'required',
				'jam_buka' 			=> 'required',
				'jam_tutup'			=> 'required',
				'phone_store'		=> 'required'
			*/  
		
		/*
    	*	API Contact Us
    	*/
		$api->post('contactadd', 'App\Http\Controllers\API\v1\C_API_All@contactAdd');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'nama'				=> 'required',
	            'email' 			=> 'required',
	            'nohp'				=> 'required',
				'alamat' 			=> 'required',
				'perihal' 			=> 'required',
				'pesan' 			=> 'required'
			*/
			
		/*
    	*	API Menu
    	*/
		$api->post('menu', 'App\Http\Controllers\API\v1\C_API_All@menuList');
			/*
			POST: http://maxx.coffee/api/menu
			Parameters: 
				'token' 			=> 'required',
		*/
		$api->post('menuselected', 'App\Http\Controllers\API\v1\C_API_All@menuSelected');
			/*
			POST: http://maxx.coffee/api/menuselected
			Parameters: 
				'token' 			=> 'required',
				'id_menu' 			=> 'required',
		*/
		$api->post('menucreate', 'App\Http\Controllers\API\v1\C_API_All@menuCreate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 			=> 'required',
				'plu_id' 			=> 'required',
				'id_kategori'		=> 'required',
				'nama_menu' 		=> 'required',
				'harga' 			=> 'required',
				'deskripsi' 		=> 'required',
				'gambar'			=> 'required',
				'redeem_point' 		=> 'required',
				'status' 			=> 'required',
		*/


		/*
    	*	API Reward
    	*/
		$api->post('rewards', 'App\Http\Controllers\API\v1\C_API_All@rewardList');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
			*/ 
		$api->post('rewardselected', 'App\Http\Controllers\API\v1\C_API_All@rewardSelected');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'id_reward' 	=> 'required'
			*/    	
		
		$api->post('rewardcreate', 'App\Http\Controllers\API\v1\C_API_All@rewardCreate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'nama_reward' 	=> 'required',
				'deskripsi' 	=> 'required',
				'reward' 		=> 'required',
				'gambar' 		=> 'required'
			*/    	
				
		$api->post('rewardupdate', 'App\Http\Controllers\API\v1\C_API_All@rewardUpdate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'id_reward'		=> 'required',
				'nama_reward' 	=> 'required',
				'deskripsi' 	=> 'required',
				'reward' 		=> 'required',
				'gambar' 		=> 'required'
			*/    	

		$api->post('rewarddelete', 'App\Http\Controllers\API\v1\C_API_All@rewardDelete');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'id_reward'		=> 'required'
			*/    	
		
		/*
    	*	API Job
    	*/
		$api->post('jobs', 'App\Http\Controllers\API\v1\C_API_All@jobList');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
			*/ 
		$api->post('jobselected', 'App\Http\Controllers\API\v1\C_API_All@jobSelected');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 	=> 'required',
				'id_job'	=> 'required'
			*/    	
		
		$api->post('jobcreate', 'App\Http\Controllers\API\v1\C_API_All@jobCreate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'nama_job' 		=> 'required',
				'requirement' 	=> 'required',
				'gambar' 		=> 'required',
				'date_start' 	=> 'required',
				'date_end' 		=> 'required'
			*/    	
				
		$api->post('jobupdate', 'App\Http\Controllers\API\v1\C_API_All@jobUpdate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'id_job' 		=> 'required',
				'nama_job' 		=> 'required',
				'requirement' 	=> 'required',
				'gambar' 		=> 'required',
				'date_start' 	=> 'required',
				'date_end' 		=> 'required'
			*/    	

		$api->post('jobnonactivestat', 'App\Http\Controllers\API\v1\C_API_All@statusJobNonActive');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 	=> 'required',
				'id_job'	=> 'required'
			*/    	
		$api->post('jobdelete', 'App\Http\Controllers\API\v1\C_API_All@deleteJob');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 	=> 'required',
				'id_job'	=> 'required'
			*/

		/*
    	*	API Event
    	*/
		$api->post('event', 'App\Http\Controllers\API\v1\C_API_All@eventList');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
			*/ 
		$api->post('eventselected', 'App\Http\Controllers\API\v1\C_API_All@eventSelected');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 	=> 'required',
				'id_event'	=> 'required'
			*/    	
		
		$api->post('eventcreate', 'App\Http\Controllers\API\v1\C_API_All@eventCreate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'id_store' 		=> 'required',
				'nama_event' 	=> 'required',
				'waktu_start'	=> 'required',
				'waktu_end' 	=> 'required',
				'deskripsi' 	=> 'required',
				'gambar' 		=> 'required'
			*/    	
				
		$api->post('eventupdate', 'App\Http\Controllers\API\v1\C_API_All@eventUpdate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'id_event' 		=> 'required',
				'id_store' 		=> 'required',
				'nama_event' 	=> 'required',
				'waktu_start'	=> 'required',
				'waktu_end' 	=> 'required',
				'deskripsi' 	=> 'required',
				'gambar' 		=> 'required'
			*/    	

		$api->post('eventdelete', 'App\Http\Controllers\API\v1\C_API_All@deleteEvent');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 	=> 'required',
				'id_event'	=> 'required'
			*/    	

		/*
    	*	API Promo
    	*/
		$api->post('promo', 'App\Http\Controllers\API\v1\C_API_All@promoList');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
			*/ 
		$api->post('promoselected', 'App\Http\Controllers\API\v1\C_API_All@promoSelected');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 	=> 'required',
				'id_promo'	=> 'required'
			*/    	
		
		$api->post('promocreate', 'App\Http\Controllers\API\v1\C_API_All@promoCreate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'id_store' 		=> 'required',
				'id_pembuat' 	=> 'required',
				'nama_promo'	=> 'required',
				'deskripsi' 	=> 'required',
				'gambar' 		=> 'required'
			*/    	
				
		$api->post('promoupdate', 'App\Http\Controllers\API\v1\C_API_All@promoUpdate');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 		=> 'required',
				'id_promo' 		=> 'required',
				'id_store' 		=> 'required',
				'id_pembuat' 	=> 'required',
				'nama_promo'	=> 'required',
				'deskripsi' 	=> 'required',
				'gambar' 		=> 'required'
			*/    	

		$api->post('promodelete', 'App\Http\Controllers\API\v1\C_API_All@deletePromo');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 	=> 'required',
				'id_promo'	=> 'required'
			*/    	
		

		/*
    	*	API MaxxCoffee
    	*/
		$api->post('reportmember', 'App\Http\Controllers\API\v1\C_API_All@reportMember');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 			=> 'required',
			*/    	
				
		$api->post('cekadmin', 'App\Http\Controllers\API\v1\C_API_All@cekAdmin');
			/*
			POST: http://maxx.coffee/api/reportmember
			Parameters: 
				'token' 			=> 'required',
			*/    	
			
   });
});

Route::post('provinsikota', 'C_Stores@getKota');
Route::post('pulaukelapa', 'C_Stores@getPropinsi');

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', 'C_Home@index');
    Route::get('home', 'C_Home@index');
    Route::get('logout', 'C_Home@logout');
    Route::get('login', 'C_Users@login');
	Route::post('register', 'C_Users@registerPost');
	Route::post('login', 'C_Users@loginPost');
	Route::post('forgotpassword', 'C_Users@forgotPasswordPost');
	Route::post('resetpassword', 'C_Users@resetPasswordPost');
	Route::post('resendverification', 'C_Users@resendVerificationPost');
	Route::post('changepassword', 'C_Users@changePasswordPost');
	
	
	/*
	*	API User
	*/
		
	Route::get('menu', 'C_Menu@menu');
	Route::get('stores', 'C_Stores@stores');
	Route::any('stores/island/{pulau}', 'C_Stores@storesByIsland');
	Route::get('promotions', 'C_Promo@promo');
	Route::get('rewards', 'C_Rewards@rewards');
	Route::get('vouchers', 'C_Vouchers@rewards');
	Route::get('cards', 'C_Cards@cards');
	Route::get('cards/add', 'C_Cards@addCard');
	Route::get('cards/topup', 'C_Cards@topup');
	Route::get('cards/transfer', 'C_Cards@transfer');
	Route::get('cards/lost', 'C_Cards@lost');
	Route::get('profile', 'C_Users@profile');
	Route::get('about', 'C_MaxxCoffee@about');
	Route::get('faq', 'C_MaxxCoffee@faq');
	Route::get('tos', 'C_MaxxCoffee@tos');
	Route::get('contact', 'C_MaxxCoffee@contact');
	Route::post('contact/add', 'C_MaxxCoffee@contactAdd');

	Route::group(['prefix' => 'admin'], function() {
		/*
			Menu
		*/
		Route::get('menu/list', 'C_MaxxCoffee@contact');
		Route::get('menu/add', 'C_MaxxCoffee@contact');

		/*
			Store
		*/
		Route::get('store/list', 'C_Stores@stores');
		Route::get('store/add', 'C_Stores@createStore');
		Route::post('store/add/post', 'C_Stores@createStorePost');

		/*
			Promo
		*/
		Route::get('promo/list', 'C_MaxxCoffee@contact');
		Route::get('promo/add', 'C_MaxxCoffee@contact');

		/*
			Reward
		*/
		Route::get('reward/list', 'C_Rewards@rewards');
		Route::get('reward/add', 'C_Rewards@createReward');
		Route::post('reward/add/post', 'C_Rewards@createRewardPost');
		Route::post('reward/edit', 'C_Rewards@editReward');
		Route::post('reward/edit/post', 'C_Rewards@editRewardPost');

		/*
			Member
		*/
		Route::get('member/list', 'C_MaxxCoffee@contact');
		Route::get('member/export', 'C_MaxxCoffee@contact');
		
		/*
			Card
		*/
		Route::get('card/list', 'C_MaxxCoffee@contact');
		
		/*
			Jobs
		*/
		Route::get('job/list', 'C_MaxxCoffee@contact');
		Route::get('job/add', 'C_MaxxCoffee@contact');
		Route::get('job/enquiries', 'C_MaxxCoffee@contact');

		/*
			Report
		*/
		Route::get('report/topspendingmember', 'C_MaxxCoffee@contact');
		Route::get('report/topstore', 'C_MaxxCoffee@contact');
		Route::get('report/members', 'C_MaxxCoffee@contact');
		Route::get('report/topuphistory', 'C_MaxxCoffee@contact');
		Route::get('report/transferhistory', 'C_MaxxCoffee@contact');

		/*
			Send Email
		*/
		Route::get('sendemail/sendblastemail', 'C_MaxxCoffee@contact');
		
		/*
			Config
		*/
		Route::get('config/edit/faq', 'C_MaxxCoffee@contact');
		Route::get('config/edit/tos', 'C_MaxxCoffee@contact');
		
		/*
			Enquiries
		*/
		Route::get('enquiries/lostcard', 'C_MaxxCoffee@contact');
		Route::get('enquiries/contacus', 'C_MaxxCoffee@contact');
		


		


	});
});
Route::get('/hallo/', 'Promo@hi');