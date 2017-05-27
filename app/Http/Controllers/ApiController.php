<?php

namespace App\Http\Controllers;

use Request;
use App\User;

class ApiController extends Controller
{
    public $user;
    public $user_model;

    public function __construct( User $user_model )
    {
        $this->user_model = $user_model;
    }
    
    public function returnData( $data = [], $status = 200 )
    {
       return response()->json( $data, $status );
    }
    
    public function detectUser()
    {
        $token = Request::header('Authorization');
        
        if ( !empty( $token ) ) {
            
            $this->user = $this->user_model->getUser(['eq|api_token' => $token, 'eq|active' => 1, 'eq|deleted' => null ]);
        }
        
        return $this->user;
    }
}
