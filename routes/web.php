<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\App;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    
    Route::get('/', function() {
        
        return View::make('admin.admin');
    });
    
    Route::get('home', 'HomeController@index');
    
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'create'] ] );
    Route::get('users/{id}/edit', 'UsersController@edit');
    Route::post('users/edit', 'UsersController@postEdit');
    Route::post('users/delete', 'UsersController@postDelete');
    Route::post('users/add', 'UsersController@postAdd');
    
    Route::resource('reviews', 'ReviewsController', ['only' => ['index', 'show', 'create'] ] );
    Route::get('reviews/{id}/edit', 'ReviewsController@edit');
    Route::post('reviews/edit', 'ReviewsController@postEdit');
    Route::post('reviews/delete', 'ReviewsController@postDelete');
    Route::post('reviews/add', 'ReviewsController@postAdd');
    Route::post('reviews/active', 'ReviewsController@postActive');
    
    Route::resource('contents', 'ContentsController', ['only' => ['index', 'show', 'create'] ] );
    Route::get('contents/{id}/edit', 'ContentsController@edit');
    Route::post('contents/edit', 'ContentsController@postEdit');
    Route::post('contents/delete', 'ContentsController@postDelete');
    Route::post('contents/add', 'ContentsController@postAdd');
    Route::post('contents/active', 'ContentsController@postActive');
    
    Route::resource('faq', 'FaqController', ['only' => ['index', 'show', 'create'] ] );
    Route::get('faq/{id}/edit', 'FaqController@edit');
    Route::post('faq/edit', 'FaqController@postEdit');
    Route::post('faq/delete', 'FaqController@postDelete');
    Route::post('faq/add', 'FaqController@postAdd');
    Route::post('faq/active', 'FaqController@postActive');
    
    Route::resource('benefits', 'BenefitsController', ['only' => ['index', 'show', 'create'] ] );
    Route::get('benefits/{id}/edit', 'BenefitsController@edit');
    Route::post('benefits/edit', 'BenefitsController@postEdit');
    Route::post('benefits/delete', 'BenefitsController@postDelete');
    Route::post('benefits/add', 'BenefitsController@postAdd');
    Route::post('benefits/active', 'BenefitsController@postActive');
    
    Route::resource('settings', 'SettingsController', ['only' => ['index', 'show', 'create'] ] );
    Route::get('settings/{id}/edit', 'SettingsController@edit');
    Route::post('settings/edit', 'SettingsController@postEdit');
    Route::post('settings/delete', 'SettingsController@postDelete');
    Route::post('settings/add', 'SettingsController@postAdd');
    Route::post('settings/active', 'SettingsController@postActive');
});

define( 'UPLOADS_DIR', Config::get('app.uploads_dir') );

$locale = Lang::getLocale();

if ( empty( $locale ) ) {
    
    $locale = 'lt';
}

Route::get('/', 'HomeController@index');

Route::get('login', function() {

    return View::make('login');
});

Auth::routes();

Route::group(array('prefix' => $locale ), function() {
    

    Route::get('/', [ 'as' => 'home', 'uses' => 'HomeController@index' ]);
    Route::get('/get-started', 'HomeController@getStarted');

    Route::get('ui', function() {
        
        return View::make('ui');
    });
    
    Route::get('api', 'HomeController@viewApi');
    
    Route::get('templates/{name}', function( $name ) {
        
        return View::make('html_templates/' . $name );
    });

    Route::get('login', function() {
        
        return View::make('login');
    });
    //POST route
    Auth::routes();
    //Route::get('register', 'HomeController@index');

    Route::get('home', 'HomeController@index');
    Route::get('contents/{name}/{id}', [ 'as' => 'contents', 'uses' => 'ContentsController@activeMenu']);
    
    Route::get('user/edit', [ 'as' => 'user/edit', 'uses' => 'UsersController@userEdit' ]);
    Route::get('user/gifts', [ 'as' => 'user/gifts', 'uses' => 'UsersController@getGifts' ]);
    Route::get('user/wallet', [ 'as' => 'user/wallet', 'uses' => 'UsersController@getWallet' ]);
    Route::post('user/login', 'UsersController@postLogin');
    Route::post('user/register', 'UsersController@postRegister');
    Route::get('logout', 'UsersController@logout');
    Route::get('user/profile', 'UsersController@getUserProfile' );
    Route::get('user/messages', 'MessagesController@getMessages' );
    Route::get('user/messenger', 'MessengerController@getMessenger' );
    Route::post('user/profile', 'UsersController@postUserProfile' );
    Route::post('user/file_uploader', [ 'as' => 'user/file_uploader', 'uses' => 'UsersController@uploadImage' ]);
    Route::get('user/check_number_form/{id}', [ 'as' => 'user/check_number_form', 'uses' => 'UsersController@checkNumberForm' ]);
    Route::get('user/{id}', [ 'as' => 'user', 'uses' => 'UsersController@getUser' ]);
    
    Route::get('faq', [ 'as' => 'faq', 'uses' => 'FaqController@showActive' ] );
    
    Route::get('ride', 'RideController@index');
    Route::get('ride/add', [ 'as' => 'ride/add', 'uses' => 'RideController@addRide' ]);
    Route::post('ride/add', 'RideController@addRide');
    Route::post('ride/add/step1', 'RideController@addRideStep1');
    Route::get('ride/out', 'RideController@out');
    Route::get('ride/inline', 'RideController@inline');
    Route::get('ride/wait', 'RideController@wait');
    Route::post('ride/search', 'RideController@search');
    Route::post('ride/book_seat', 'BookSeatsController@bookSeat');
    
    Route::get('ride/get/{id}', [ 'as' => 'ride/get', 'uses' => 'RideController@getRide' ]);
    Route::get('ride/booking_form/{id}', [ 'as' => 'ride/booking_form', 'uses' => 'RideController@getBookingFormData' ]);
    Route::get('requests/form', [ 'as' => 'requests/form', 'uses' => 'RequestsController@getForm' ]);
    Route::post('requests/submit', 'RequestsController@add');
    
    Route::get('messages/{id}', [ 'as' => 'message', 'uses' => 'MessagesController@message']);
    
    Route::get('user/messenger', [ 'as' => 'user/messenger', 'uses' => 'MessengerController@getMessenger' ]);    
    Route::post('user/messenger/submit', 'MessengerController@submitMessenger' );
});
/*
 * test notification
$deviceToken = 'eQw_xtq1bP8:APA91bFNN4CGFbf9nu0uNJHovotqHdM3maqLquBc68hay2H7Pmu_ZHeD7LUAmx_ExnX2lTyPzYC8QkKUd_mU3KuJFUFzdJ84NCMqAdGsBJvh_hikNrnfXrdB4f2WKHTfTcvH27EdRM6Ns';
$notifications = App::make( 'App\System\PushNotifications' );
$result = $notifications->android(['mtitle' => 'bannacar', 'mdesc' => 'test' ], $deviceToken );
echo var_dump($result);
 * 
 */