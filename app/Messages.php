<?php

namespace App;

use App\AppDb;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App;

class Messages extends Model
{
    use AppDb;
    
    public $timestamps = false;
    private $short_text = 50;


    public function getMessages( $filter = [], $order = [], $limit = 100000, $offset = 0 )
    {
        $sql = $this->get( $filter, $order, $limit, $offset );
        
        $messages = $sql->get();
        
        return $messages;
    }
    
    public function getMessage( $filter = [] )
    {
        $sql = $this->get( $filter, [], 1 );
        
        $message = $sql->first();
        
        return $message;
    }
    
    public function getCount( $filter = [] )
    {
        $count = $this->count( $filter );
        
        return $count;
    }
    
    public function getCountUnreadMessages( $user_id )
    {
        $select = self::select('from_user_id')->distinct()->where('to_user_id', '=', $user_id )->where('read', '=', 0 )->get();
        $count = 0;
        
        if ( !empty( $select ) ) {
            
            foreach ( $select as $val ) {
                
                $count = $val->from_user_id;
            }
        }
        
        return $count;
    }
    
    public function getUserMessages( $user_id )
    {
        $sql = 'SELECT ms.* ,users.name, users.surname, users.image, users.api_token '
                . 'FROM '
                . '( SELECT max(messages.id) as id '
                . 'FROM messages '
                . 'WHERE messages.`to_user_id` = ' . $user_id . ' '
                . 'GROUP BY messages.from_user_id '
                . ') AS messages '
                . 'LEFT JOIN messages AS ms ON ms.id = messages.id '
                . 'LEFT JOIN users ON users.id = ms.from_user_id';
        $messages = DB::select( DB::raw( $sql ) );
        
        return $messages;
    }
    
    public function mark( $from_user_id, $to_user_id )
    {
        if ( empty( $from_user_id ) || empty( $to_user_id ) ) {
            
            return false;
        }
        
        $data = $this->getMessages( ['to_user_id' => $to_user_id, 'from_user_id' => $from_user_id, 'read' => 0 ] );
        
        if ( empty( $data ) ) {
            
            return false;
        }
        
        $return_data = self::where('to_user_id', '=', $to_user_id )
                        ->where('from_user_id', '=', $from_user_id )
                        ->update( ['read' => 1 ] );
        
        return $return_data;
    }
    
    public function getMessagesByUser( $from, $to )
    {
        
    }
    
    public function addMessneger( $data, $type = 'web' )
    {
        if ( empty( $data['to_id'] ) || empty( $data['user_id'] ) || empty( $data['message'] ) ) {
            
            return ['errors' => ['message'] ];
        }
        
        $message = App::make( 'App\Messages' );
        $message->created_at = date('Y-m-d Y:i:s');
        $message->updated_at = date('Y-m-d Y:i:s');
        $message->from_user_id = $data['user_id'];
        $message->to_user_id = $data['to_id'];
        $message->type = $type;
        $message->short_text = strlen( $data['message'] ) > $this->short_text ? \App\Helpers\Helpers::shortText( $data['message'], $this->short_text ) : $data['message'];
        $message->text = $data['message'];
        $message->lang = LANG;
        
        $status = $message->save();
        
        if ( empty( $status ) ) {
            
            return ['errors' => ['message'] ];
        }
        
        $user_module = App::make( 'App\User' );
        $from_user = $user_module->getUser( ['id' => $data['user_id'] ] );
        $to_user = $user_module->getUser( ['id' => $data['to_id'] ] );
        
        $data = [
            'created' => $message->created_at,
            'short_text' => $message->short_text,
            'text' => $message->text,
            'user_id' => $data['user_id'],
            'to_id' => $data['to_id']
        ];
        
        if ( !empty( $from_user ) ) {
            
            $data['from_user'] = [
                'id' => $from_user->id,
                'name' => $from_user->name,
                'surname' => $from_user->surname,
                'email' => $from_user->email,
                'image' => $from_user->image
            ];
        }
        
        if ( !empty( $to_user ) ) {
            
            $data['to_user'] = [
                'id' => $to_user->id,
                'name' => $to_user->name,
                'surname' => $to_user->surname,
                'email' => $to_user->email,
                'image' => $to_user->image
            ];
        }
        
        $pusher = App::make('pusher');
        $channel = \App\Helpers\Helpers::getChannel( $data['user_id'], $data['to_id'] );
        $pusher->trigger( $channel,'chat', array( 'data' => json_encode( $data ) ) );
        
        return ['errors' => false, 'data' => $data ];
    }
}
