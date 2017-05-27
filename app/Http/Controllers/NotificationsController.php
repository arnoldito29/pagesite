<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications;
use Auth;

class NotificationsController extends Controller
{
    protected $limit = 10;
    protected $notifications;
    
    public function __construct( Notifications $notifications )
    {
        $this->notifications = $notifications;
    }
    
    public function getUnreadNotifications()
    {
        if ( empty( Auth::user() ) ) {
            
            return false;
        }
        
        $count = $this->notifications->getCount( ['user_id' => Auth::user()->id, 'read' => 0] );
        
        return $count;
    }
    
    public function getUserNotifications()
    {
        if ( empty( Auth::user() ) ) {
            
            return [];
        }
        
        $list = $this->notifications->getNotifications( ['user_id' => Auth::user()->id], [ ['created_at' => 'DESC'] ], $this->limit );
        $list = $this->notifications->returnArray( $list );
        
        foreach ( $list as $key => $val ) {
            
            $list[ $key ]['url'] = '';
            $list[ $key ]['text'] = '';
            
            if ( !empty( $val['params'] ) ) {
                
                $params = json_decode( $val['params'], true);
                
                $list[ $key ]['url'] = !empty( $params['url'] ) ? $params['url'] : '';
                $list[ $key ]['text'] = !empty( $params['text'] ) ? $params['text'] : '';
            }
            
            $list[ $key ]['url'] = $list[ $key ]['url'] . '?n=' . $val['id'];
        }
        
        return $list;
    }
}
