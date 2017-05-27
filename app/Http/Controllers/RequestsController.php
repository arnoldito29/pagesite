<?php

namespace App\Http\Controllers;

use App\Requests;
use Request;
use App;

class RequestsController extends Controller
{
    protected $requests;
    
    public function __construct( Requests $requests )
    {
        $this->requests = $requests;
    }
    
    public function getForm()
    {
        return view('ajax.user.requets.form', ['date_time' => \App\Helpers\Helpers::dateTimes() ]);
    }
    
    public function add()
    {
        $data = Request::all();
        
        $return_data = $this->requests->add( $data, 'web' );
        
        if ( !empty( $return_data['errors'] ) ) {
            
            return response()->json( $return_data );
        }
        
        $return = ['successful' => true, 'html' => view('ajax.user.requets.submit', ['request_data' => $return_data['data'] ] )->render() ];
        
        return response()->json( $return );
    }
    
    static public function showLastRequests()
    {
        $locale = defined('LANG') ? LANG : 'lt';
        $requests = App::make( 'App\Requests' );
        $list = $requests->getLastRequests( $locale );
        
        return $list;
    }
}
