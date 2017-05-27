<?php

namespace App\Http\Controllers;

use Request;
use App;

class Apiv1Controller extends ApiController
{
    private $allow_methods = [];
    
    public function index( $method )
    {
        return $this->returnData( ['test' => 'aaa'], 404 );
    }
    
    public function getUser( $id )
    {
        $user_model = App::make( '\App\User' );
        
        $user = $user_model->getUserData( $id );
       
        if ( empty( $user ) ) {
           
            return $this->returnData( [], 404 );
        }
       
        return $this->returnData( $user );
    }
    
    public function userLogin()
    {
        $user_model = App::make( '\App\User' );
        
        $data = Request::all();
        
        $result = $user_model->apiUserLogin( $data );
        
        if ( empty( $result ) ) {
           
            return $this->returnData( [], 404 );
        }
        
        return $this->returnData( $result );
    }
    
    public function userRegister()
    {
        $user_model = App::make( '\App\User' );
        $data = Request::all();
        
        $result = $user_model->postRegister( $data );
        
        if ( !empty( $result['error'] ) ) {
           
            return $this->returnData( $result, 404 );
        }
        
        $result['data'] = $user_model->getUser( ['eq|email' => $data['email'] ] );
        
        return $this->returnData( $result );
    }
    
    public function rideSearch()
    {
        $data = Request::all();
        $search_model = App::make( '\App\Search' );
        $rides_model = App::make( '\App\Rides' );
        
        $data = $search_model->searchData( $data );
        
        $rides = !empty( $data ) ? $rides_model->search( $data, 'api' ) : [];
        
        return $this->returnData( $rides );
    }
    
    public function rideRequest()
    {
        $data = Request::all();
        
        $request_model = App::make( '\App\Requests' );
        
        if ( !empty( $data['token'] ) ) {
            
            $user_model = App::make( '\App\User' );
            $user = $user_model->getUser( ['eq|api_token' => $data['token'] ] );
            
            $data['user_id'] = !empty( $user->id ) ? $user->id : 0;
        }
        
        $return_data = $request_model->add( $data, 'api' );
        
        return $this->returnData( $return_data );
    }
    
    public function getRide()
    {
        $data = Request::all();
        
        if ( empty( $data['ride_id'] ) ) {
            
            return $this->returnData( [], 404 );
        }
        
        $ride_model = App::make( '\App\Rides' );
        
        if ( !empty( $data['token'] ) ) {
            
            $user_model = App::make( '\App\User' );
            $user = $user_model->getUser( ['eq|api_token' => $data['token'] ] );
        }
        
        $user_id = !empty( $user->id ) ? $user->id : 0;
        
        $ride = $ride_model->getRideData( $data['ride_id'], $user_id );
        
        if ( empty( $ride ) ) {
            
            return $this->returnData( $ride, 404 );
        }
        
        return $this->returnData( $ride );
    }
    
    public function rideBookSeat()
    {
        $data = Request::all();
        
        if ( empty( $data['ride_id'] ) || empty( $data['token'] ) ) {
            
            return $this->returnData( [], 404 );
        }
        
        if ( !empty( $data['token'] ) ) {
            
            $user_model = App::make( '\App\User' );
            $user = $user_model->getUser( ['eq|api_token' => $data['token'] ] );
            
            if ( empty( $user->id ) ) {
                
                return $this->returnData( [], 404 );
            }
        }
        
        $bookseats_model = App::make( '\App\BookSeats' );
        
        $return_data = $bookseats_model->addSeat( ['user_id' => $user->id, 'ride_id' => $data['ride_id'] ], 'api' );
        
        $params = !empty( $return_data ) ? ['successful' => true ] : ['successful' => false ];
        
        return $this->returnData( $params );
    }
    
    public function userDeviceRegister()
    {
        $this->detectUser();
        
        $data = Request::all();
        
        $devices = App::make( '\App\Devices' );
        $return_data = $devices->add( $data, $this->user );
        
        $params = !empty( $return_data ) ? ['successful' => true ] : ['successful' => false ];
        
        return $this->returnData( $params );
    }
    
    public function userDeviceUnregister()
    {
        $this->detectUser();
        
        $data = Request::all();
        
        $devices = App::make( '\App\Devices' );
        $return_data = $devices->deleteDevice( $data, $this->user );
        
        $params = !empty( $return_data ) ? ['successful' => true ] : ['successful' => false ];
        
        return $this->returnData( $params );
    }
}
