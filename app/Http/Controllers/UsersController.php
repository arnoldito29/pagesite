<?php

namespace App\Http\Controllers;

use Request;
use App\User;
use Auth;
use Lang;
use Validator;
use Redirect;
use URL;
use App\System\qqFileUploader;
use File;

class UsersController extends Controller
{
    protected $limit = 20;
    protected $users;
    protected $user_image_cache = __DIR__.'/../../../public/cache/';
    protected $user_image = __DIR__.'/../../../public/images/uploads/';

    public function __construct( User $users )
    {
        $this->users = $users;
    }
    
    public function index()
    {
        $page = (int)Request::input('page');
        $page = ( !empty( $page ) ) ? $page : 1;
                
        $count = $this->users->getCount( ['lesseq|admin' => 10, 'null|deleted' => null ] );
        
        $page = max( min( $page, ceil( $count / $this->limit ) ), 1 );
        
        $users = $this->users->getUsers( ['lesseq|admin' => 10, 'null|deleted' => null ], [ ['id' => 'DESC' ] ], $this->limit, ( $page - 1 ) * $this->limit );
        $paging = \App\Helpers\Paging::paging( $count, $this->limit, $page );
        
        return view('admin.users.list', ['users' => $users, 'paging' => $paging ]);
    }
    
    public function show( $id )
    {
        return view('admin.users.show', ['user' => User::find( $id ) ] );
    }
    
    public function edit( $id )
    {
        $user = [];
        
        if ( !empty( $id ) ) {
        
            $user = User::find( $id );
        }
        
        if ( Auth::user()->id != $user->id ) { 
        
            return view('admin.users.edit', ['user' => $user ] );
        } else {
            
            return view('admin.users.show', ['user' => $user ] );
        }
    }
    
    public function postEdit()
    {
        $data = Request::all();
        
        $return_data = $this->users->edit( $data );
        
        if ( $return_data === true ) {
            
            \Session::flash('status_msg', Lang::get('messages.Successfully update'));
        } else {
            
            \Session::flash('status_msg', Lang::get('messages.Unsuccessfully update'));
            \Session::flash('status_error', true);
        }
        
        if ( !empty( $data['id'] ) ) {
            
            return Redirect::to('admin/users/' . $data['id'] . '/edit')->withinput( $data )->withErrors( $return_data );
        } else {
            
            return Redirect::to('admin/users');
        }
    }
    
    public function postDelete() {
        
        $data = Request::all();
        
        if ( empty( $data['id'] ) ) {
            
            return response()->json( ['status' => 'error'] ); 
        }
        
        $user = User::find( $data['id'] );
        
        $return = $this->users->postDelete( $data['id'] );
        
        return response()->json( ['status' => 'ok'] ); 
    }
    
    public function create()
    {
        return view('admin.users.add' );
    }
    
    public function postAdd()
    {
        $data = Request::all();
        
        $return_data = $this->users->add( $data );
        
        if ( $return_data === true ) {
            
            \Session::flash('status_msg', Lang::get('messages.Successfully add'));
        } else {
            
            \Session::flash('status_msg', Lang::get('messages.Unsuccessfully add'));
            \Session::flash('status_error', true);
        }
        
        return Redirect::to('admin/users/create')->withinput( $data )->withErrors( $return_data );
    }
    
    public function postLogin()
    {
        $data = Request::all();
        
        $messages = array(
            'required' => Lang::get('messages.error_empty'),
            'min' => Lang::get('messages.error_min'),
            'email' => Lang::get('messages.error_email'),
        );
        
        $rules = array(
            'password' => 'required|min:8',
            'email' => 'required|email'
        );
        
        $validator = Validator::make($data, $rules, $messages );
        
        if ( $validator->fails() ) {
            
            $errors = $validator->getMessageBag()->toArray();
            
            $return_data = ['error' => true, 'data' => [] ];
            
            foreach ( $errors as $key => $error ) {
                
               $return_data['data'][ $key ] = !empty( $error[0] ) ? $error[0] : $error;
            }
            
            return response()->json( $return_data );
        }
        
        $return_data = $this->users->postLogin( $data );
        
        return response()->json( $return_data );
    }
    
    public function postRegister()
    {
        $data = Request::all();
        
        $messages = array(
            'required' => Lang::get('messages.error_empty'),
            'min' => Lang::get('messages.error_min'),
            'email' => Lang::get('messages.error_email'),
            'not equal' => Lang::get('messages.not equal'),
            'email used' => Lang::get('messages.email used'),
        );
        
        $rules = array(
            'confirm_password' => 'required|min:8',
            'password' => 'required|min:8',
            'email' => 'required|email',
            'name' => 'required',
            'surname' => 'required',
            'birth' => 'required',
            'sex' => 'required',
        );
        
        $validator = Validator::make($data, $rules, $messages );
        
        if ( $validator->fails() ) {
            
            $errors = $validator->getMessageBag()->toArray();
            
            $return_data = ['error' => true, 'data' => [] ];
            
            foreach ( $errors as $key => $error ) {
                
               $return_data['data'][ $key ] = !empty( $error[0] ) ? $error[0] : $error;
            }
            
            return response()->json( $return_data );
        }
        
        $return_data = $this->users->postRegister( $data );
        
        if ( isset( $return_data['error'] ) && $return_data['error'] === true ) {
            
            foreach ( $return_data['data'] as $key => $val ) {
                
                if ( !empty( $messages[ $val ] ) ) {
                    
                    $return_data['data'][ $key ] = $messages[ $val ];
                }
            }
        } else {
            
            $user = $this->users->getUser( ['eq|email' => $data['email'] ] );
            
            if ( !empty( $user ) ) {
                
                Auth::loginUsingId( $user->id );
            }
        }
        
        return response()->json( $return_data );
    }
    
    public function logout()
    {
        Auth::logout();
        // Redirect to the users page.
        //
        return Redirect::to('/')->with('success', 'Logged out with success!');
    }
    
    public function getUser( $id )
    {
        
        return '';
    }
    
    public function getUserProfile()
    {
        if ( empty( Auth::user() ) ) {
            
            return Redirect::to('/')->with('error', 'Please login!');
        }
        
        $settings = [
            'action' => URL::route( 'user/file_uploader' ),
            'sizeLimit' => 100000,
            'allowedExtensions' => ['jpg', 'gif', 'png']
        ];
        
        return view('site.pages.user_profile', [ 'qq_uploader_settings' => json_encode( $settings ) ] );
    }
    
    public function uploadImage()
    {
        $allowedExtensions = ['jpg', 'gif', 'png'];
        $sizeLimit = 100000;
        
        $uploader = new qqFileUploader( $allowedExtensions, $sizeLimit );
        
        $result = $uploader->handleUpload( $this->user_image_cache );
        
        return response()->json( $result );
    }
    
    public function postUserProfile()
    {
        $data = Request::all();
        
        if ( empty( Auth::user() ) || empty( Auth::user()->id ) ) {
            
            return Redirect::to('/')->with('error', 'Please login!');
        }
        
        $update_data = [];
        $settings = [
            'action' => URL::route( 'user/file_uploader' ),
            'sizeLimit' => 100000,
            'allowedExtensions' => ['jpg', 'gif', 'png']
        ];
        
        if ( !empty( $data['image'] ) ) {
            
            if ( is_file( $this->user_image_cache . $data['image'] ) ) {
                
                $move = File::move( $this->user_image_cache . $data['image'] , $this->user_image . Auth::user()->id . $data['image'] );
                $update_data['image'] = Auth::user()->id . $data['image'];
            }
        }
        
        $return_data = $this->users->updateUser( $update_data, Auth::user()->id );
        
        return view('site.pages.user_profile', [ 'qq_uploader_settings' => json_encode( $settings ) ] );
    }
    
    public function checkNumberForm( $id )
    {
        $user = $this->users->getUserData( $id );
        
        $cars = !empty( $user['_cars_'] ) ? $user['_cars_'] : [];
        $data = Request::all();
        
        $ride = !empty( $data['ride'] ) ? $data['ride'] : 0;
        
        return view('ajax.user.check_number_from', ['user' => $user, 'cars' => $cars, 'ride' => $ride, 'block_phone' => 1 ] );
    }
}
