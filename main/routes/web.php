<?php
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');      

/*End of Auth URL Routes*/

//this is check user if it is login or not checkuser
Route::group(['middleware' => 'checkuser'], function() {
	Route::get('/dashboard', 'HomeController@index')->name('home');
	Route::get('/home', function(){
		return redirect('dashboard');
	});
	Route::get('/error',function(){
		return view('error_page.access_restricted');
	});
});
//start of Admin Route Middleware
Route::group(['middleware' => ['checkuser','CheckAdmin']], function() {
	Route::get('/registeruser',function(){
		return view('menu_pages.register_user');
	});  
	
	//Here is add project related route
	Route::get('/add_project',"Admin\ProjectController@prepare_project_add");
	Route::get('/edit_project/{id}', "Admin\ProjectController@edit_project");
	Route::get('/delete_project/{id}', "Admin\ProjectController@delete_project");
	Route::post('edit_project/submit_project','Admin\ProjectController@add_project');
	//here is view all project route
	Route::get('/view_project','Admin\ProjectController@view_project');
	Route::post('/submit_project','Admin\ProjectController@add_project');

	Route::get('/add_role/{id?}', 'Admin\RoleController@add_role')->name('add_role');
	Route::post('/add_role_post', 'Admin\RoleController@add_role_post')->name('add_role_post');
	Route::post('/add_role/add_role_post', 'Admin\RoleController@add_role_post')->name('add_role_post');

	Route::get('/add_user/{id?}', 'Admin\UserController@add_user')->name('add_user');
	
	
	Route::post('/add_user', 'Admin\UserController@add_user_post')->name('add_user_post');
	Route::post('add_user/add_user', 'Admin\UserController@add_user_post')->name('add_user_post');

	Route::get('/view_user', 'Admin\UserController@view_user')->name('view_user');
	Route::get('/view_role', 'Admin\RoleController@view_role')->name('view_role');
	Route::get('delete_record1/{id}','Admin\UserController@delete_record');
	Route::get('delete_record2/{id}','Admin\RoleController@delete_record'); 
  
	Route::get('/home', function(){
		return redirect('dashboard');
	});	
	
	//EvaluationPointController Section
	Route::get('/add_evaluation_point', 'Admin\EvaluationPointController@prepare_que_add');
	Route::get('/view_evaluation_point', 'Admin\EvaluationPointController@view_evaluation_points');
	Route::post('/add_evaluation_point', 'Admin\EvaluationPointController@add_evaluation_points');
	Route::get('/edit_evaluation_point/{id}', "Admin\EvaluationPointController@edit_evaluation_points");
	Route::get('/delete_evaluation_point/{id}', "Admin\EvaluationPointController@delete_evaluation_points");
	Route::post('edit_evaluation_point/add_evaluation_point','Admin\EvaluationPointController@add_evaluation_points');
	//End of Route of EvaluationPointController Section  

    //point_value_settings
    Route::get('/add_points/{id?}', 'Admin\PointValueSettingController@add_points')->name('add_points');
    Route::post('/points_post', 'Admin\PointValueSettingController@points_post')->name('points_post');
    Route::post('add_points/points_post', 'Admin\PointValueSettingController@points_post')->name('points_post');
    Route::get('/view_points', 'Admin\PointValueSettingController@view_points')->name('view_points');
    Route::get('delete_points/{id}',  'Admin\PointValueSettingController@delete_points');

    Route::get('File-upload','Admin\PointValueSettingController@fileupload');
    //End of point_value_settings Routes


    // for ip settings
    Route::any('Ip-setting','Admin\IPController@ip_setting');

});
//End of Admin Route Middleware


//start of Admin Route Middleware
Route::group(['middleware' => 'checkuser'], function() {
	//this route for HR
	Route::get('ticket/view','Ticket\Ticket@get_ticket');
	//get all comment by ID
	Route::post('get_comment','Ticket\comment@get_all_comment');
	});
	//submit Comment
	Route::post('add_comment','Ticket\comment@submit_comment');
	//final question submit
	Route::post('add_final_submit','Ticket\comment@final_comment');

Route::any('/', function(){
    return view('auth.login');
});



//this route is for auth
Auth::routes();
