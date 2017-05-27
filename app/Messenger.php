<?php

namespace App;

use App\AppDb;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use AppDb;
    
    public $timestamps = false;
    private $limit = 10;


    public function getMessengers( $filter = [], $order = [], $limit = 100000, $offset = 0 )
    {
        $sql = $this->get( $filter, $order, $limit, $offset );
        
        $messengers = $sql->get();
        
        return $messengers;
    }
    
    public function getMessenger( $filter = [] )
    {
        $sql = $this->get( $filter, [], 1 );
        
        $messenger = $sql->first();
        
        return $messenger;
    }
    
    public function getCount( $filter = [] )
    {
        $count = $this->count( $filter );
        
        return $count;
    }
}