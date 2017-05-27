<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use Auth;
use App\User;
use App\Messages;

class MessengerController extends Controller
{
    protected $users;
    protected $messages;
    
    public function __construct( User $users, Messages $messages )
    {
        $this->users = $users;
        $this->messages = $messages;
    }
    
    public function getMessenger()
    {
        if ( empty( Auth::user() ) ) {
            
            return Redirect::to('/');
        }
        
        $user_token = Request::input('user');
        
        $users = $this->messages->getUserMessages( Auth::user()->id );
        
        $user = !empty( $user_token ) ? $this->users->getUser( ['api_token' => $user_token ] ) : [];
        $user_id = !empty( $user ) ? $user->id : 0;
        
        $channel = \App\Helpers\Helpers::getChannel( Auth::user()->id, $user_id );
        
        $messages = $this->messages->getMessagesByUser( Auth::user()->id, $user_id );
        
        return view('site.pages.messenger', ['messenger_users' => $users, 'messenger_container' => $user, 'messages' => $messages, 'channel' => $channel ] );
    }
    
    public function submitMessenger()
    {
        if ( empty( Auth::user() ) ) {
            
            $return_data = ['error' => 'message' ];
            
            return response()->json( $return_data );
        }
        
        $data = Request::all();
        $data['user_id'] = Auth::user()->id;
        $return_data = $this->messages->addMessneger( $data, 'web' );
        
        return response()->json( $return_data );
    }
}
