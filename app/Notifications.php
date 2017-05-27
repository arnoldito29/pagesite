<?php

namespace App;

use App\AppDb;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use AppDb;
    
    public $timestamps = false; 
   
    public function getNotifications( $filter = [], $order = [], $limit = 100000, $offset = 0 )
    {
        $sql = $this->get( $filter, $order, $limit, $offset );
        
        $notices = $sql->get();
        
        return $notices;
    }
    
    public function getNotification( $filter = [] )
    {
        $sql = $this->get( $filter, [], 1 );
        
        $notice = $sql->first();
        
        return $notice;
    }
    
    public function getCount( $filter = [] )
    {
        $count = $this->count( $filter );
        
        return $count;
    }
    
    public function mark( $user_id, $notice )
    {
        if ( empty( $user_id ) || empty( $notice ) ) {
            
            return false;
        }
        
        $data = $this->getNotification( ['user_id' => $user_id, 'id' => $notice ] );
        
        if ( empty( $data ) ) {
            
            return false;
        }
        
        $data->read = 1;
        
        return $data->save();
    }
}
