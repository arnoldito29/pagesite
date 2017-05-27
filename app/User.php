<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Event;
use App\Events\UserLogin;
use Validator;
use Lang;
use Illuminate\Support\Facades\Hash;
use App\AppDb;
use Illuminate\Support\Facades\Auth;
use App;

class User extends Authenticatable
{
    use Notifiable;
    use AppDb;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $table = 'users';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $user_reviews;
    
    public function isAdmin()
    {
        
        return $this->admin; // this looks for an admin column in your users table
    }
    
    public function getUsers( $filter = [], $order = [], $limit = 10000, $offset = 0 )
    {
        $sql = $this->get( $filter, $order, $limit, $offset );
        
        $users = $sql->get();
        
        return $users;
    }
    
    public function getUser( $filter = [] )
    {
        $sql = $this->get( $filter, [], 1 );
        
        $user_item = $sql->first();
        
        return $user_item;
    }
    
    public function getCount( $filter = [] )
    {
        $count = $this->count( $filter );
        
        return $count;
    }
    
    public function edit( $data = array() )
    {
        if ( empty( $data ) || empty( $data['id'] ) ) {
            
            return false;
        }
          
        $messages = array(
            'required' => Lang::get('messages.error_empty'),
            'min' => Lang::get('messages.error_min')
        );
        
        $user = self::find( $data['id'] );
        
        if ( empty( $user ) ) {
            
            return false;
        }
        
        $rules = array(
            'name' => 'required|min:3'
        );
        
        if ( !empty( $data['password'] ) ) {
            
            $rules['password'] = 'required|min:3';
        }
        
        $validator = Validator::make($data, $rules, $messages );
        
        if ( $validator->fails() ) {

            return $validator->getMessageBag()->toArray();
        }
        
        $user->name = $data['name'];
        $user->password = Hash::make( $data['password'] );
        
        return $user->save();
    }
    
    public function postDelete( $id )
    {
        if ( empty( $id ) ) {
           
            return false;
        }
        
        $user = self::find( $id );
        
        if ( empty( $user ) ) {
            
            return false;
        }
        
        $user->deleted = true;
        
        return $user->save();
    }
    
    public function add( $data = array() )
    {
        if ( empty( $data ) ) {
            
            return false;
        }
        
        $messages = array(
            'required' => Lang::get('messages.error_empty'),
            'min' => Lang::get('messages.error_min'),
            'email' => Lang::get('messages.error_email'),
        );
        
        $rules = array(
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'password' => 'required|min:3',
            'birth' => 'required',
            'sex' => 'required',
            'email' => 'required|email'
        );
        
        $validator = Validator::make($data, $rules, $messages );
        
        if ( $validator->fails() ) {
            
            return $validator->getMessageBag()->toArray();
        }
        
        $user = App::make( 'App\User' );
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->password = Hash::make( $data['password'] );
        $user->email = $data['email'];
        $user->birthday = $data['birth'];
        $user->sex = $data['sex'];
        $user->admin = 0;
        $user->api_token = str_random( 60 );
        $user->lang = LANG;
        $user->active = 1;
        
        return $user->save();
    }
    
    public function postLogin( $data )
    {
        if ( empty( $data['email'] ) || empty( $data['password'] ) ) {
            
            return ['error' => true, 'data' => ['email' => 'bad email or/and password', 'password' => 'bad email or/and password'] ];
        }
        
        if ( Auth::attempt( ['email' => $data['email'], 'password' => $data['password'], 'active' => 1, 'deleted' => null ] ) ) {
            
            return ['error' => false, 'data' => Auth::user() ];
        }
        
        return ['error' => true, 'data' => ['email' => 'bad email or/and password', 'password' => 'bad email or/and password'] ];
    }
    
    public function postRegister( $data )
    {
        $errors = [];
        
        if ( empty( $data['password'] ) ) {
            
            $errors['password'] = 'not equal';
        }
        
        if ( !empty( $data['email'] ) ) {
            
            $user = $this->getCount( ['email' => $data['email'] ] );
            
            if ( $user > 0 ) {
                
                $errors['email'] = 'email used';
            }
        }
        
        if ( empty( $errors ) ) {
            
            $user = $this->add( $data );
            
            if ( $user === true ) {
                
                return ['error' => false ];
            }
        }
        
        return ['error' => true, 'data' => $errors ];
    }
    
    public function getUserData( $id )
    {
        $users_params = [
            'eq|users.id' => $id,
            'null|users.deleted' => 1
        ];
        
        $this->user_cars = App::make( 'App\UserCars' );
        $this->user_rating = App::make( 'App\UserRating' );
        $this->user_reviews = App::make( 'App\UserReviews' );
        
        $user = $this->returnArray( $this->getUser( $users_params ) );
        
        if ( !empty( $user ) ) {
            
            if ( !empty( $user['phone'] ) ) {

                $user = \App\Helpers\Helpers::hiddenPhone( $user, 'phone' );
            }
            
            $reviews_params = [
                'eq|user_to_id' => $id,
                'null|deleted' => 1,
                'eq|status' => 'confirm'
            ];
            
            $user['_reviews_count_'] = $this->user_reviews->getCount( $reviews_params );
            
            $user['_rating_'] = $this->returnArray( $this->user_rating->getUserRating( [ 'eq|user_to_id' => $id ], 'user_to_id' ) );
            
            if ( !empty( $user['_rating_']['avarage'] ) ) {
                
                $user['_rating_']['avarage'] = round( $user['_rating_']['avarage'], 1 );
                $user['_rating_']['percent'] = \App\Helpers\Helpers::getRatingPercent( $user['_rating_']['avarage'] );
            }
            
            $cars = $this->returnArray( $this->user_cars->getUserCars( ['user_cars.user_id' => $id ] ) );
            $user['_cars_'] = \App\Helpers\LangData::changeArrayData( $cars, ['colors_name'], LANG ); 
        }
        
        return $user;
    }
    
    public function updateUser( $data, $id )
    {
        $user = $this->getUser( ['id' => $id ] );
        
        if ( empty( $user ) || empty( $data ) ) {
            
            return false;
        }
        
        foreach ( $data as $key => $val ) {
            
            $user->$key = $val;
        }
        
        return $user->save();
    }
    
    public function apiUserLogin( $data )
    {
        if ( empty( $data['password'] ) || ( empty( $data['phone'] ) && empty( $data['email'] ) ) ) {
            
            return [];
        }
        
        $params = [ 'eq|active' => 1, 'null|deleted' => null ];
        
        if ( !empty( $data['email'] ) ) {
            
            $params['eq|email'] = $data['email'];
        } elseif ( !empty( $data['phone'] ) ) {
            
            $params['eq|phone'] = $data['phone'];
        }
       
        $user = $this->getUser( $params );
        
        if ( empty( $user ) || empty( $user['password'] ) ) {
            
            return false;
        }
        
        if ( !Hash::check( $data['password'], $user['password'] ) ) {
            
            return false;
        }
        
        
        return $user;
    }
}
