<?php

namespace App;

use App;
use App\AppDb;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use AppDb;
    protected $active_requests_limit = 3;
    protected $users;

    public function __construct()
    {
        $this->users = App::make( 'App\User' );
        $this->user_rating = App::make( 'App\UserRating' );
        $this->user_reviews = App::make( 'App\UserReviews' );
    }
    
    public function getRequests( $filter = [], $order = [], $limit = 100000, $offset = 0 )
    {
        $sql = $this->get( $filter, $order, $limit, $offset );
        
        $requests = $sql->get();
        
        return $requests;
    }
    
    public function getRequest( $filter = [] )
    {
        
        $sql = $this->get( $filter, [], 1 );
        
        $request = $sql->first();
        
        return $request;
    }
    
    public function getCount( $filter = [] )
    {
        $count = $this->count( $filter );
        
        return $count;
    }
    
    public function get( $filter = [], $order = [], $limit = 100000, $offset = 0 )
    {
        if ( !empty( $filter['_without_locations_'] ) ) {
            
            $sql = self::select( '*' );
            unset( $filter['_without_locations_'] );
        } else {
            
            $sql = self::select( 
                'requests.*',
                'f.name_lt AS f_name_lt',
                'f.original_lt AS f_original_lt',
                'f.name_lv AS f_name_lv',
                'f.original_lv AS f_original_lv',
                'f.name_ee AS f_name_ee',
                'f.original_ee AS f_original_ee',
                'f.name_en AS f_name_en',
                'f.original_en AS f_original_en',
                'f.name_ru AS f_name_ru',
                'f.original_ru AS f_original_ru',
                'f.name_pl AS f_name_pl',
                'f.original_pl AS f_original_pl',
                't.name_lt AS t_name_lt',
                't.original_lt AS t_original_lt',
                't.name_lv AS t_name_lv',
                't.original_lv AS t_original_lv',
                't.name_ee AS t_name_ee',
                't.original_ee AS t_original_ee',
                't.name_en AS t_name_en',
                't.original_en AS t_original_en',
                't.name_ru AS t_name_ru',
                't.original_ru AS t_original_ru',
                't.name_pl AS t_name_pl',
                't.original_pl AS t_original_pl'
            );

            $sql->join('users AS u', 'u.id', '=', 'requests.user_id');
            $sql->leftjoin('locations AS f', 'f.id', '=', 'requests.from_id');
            $sql->leftjoin('locations AS t', 't.id', '=', 'requests.to_id');
        }
        
        $sql = $this->whereParams( $sql, $filter );
        
        foreach ( $order as $order_item ) {

            foreach ( $order_item as $key => $val ) {

                $sql->orderBy( $key, $val );
            }
        }
        
        $sql->offset( $offset )->limit( $limit );
        
        return $sql;
    }
    
    public function add( $data, $type = 'web' )
    {
        $errors = ( $type == 'web' ) ? $this->validationWeb( $data ) : $this->validationApi( $data );
        
        if ( !empty( $errors ) ) {
            
            return ['errors' => $errors, 'data' => '', 'successful' => false ];
        }
        
        $locations = App::make( 'App\Locations' );
        
        $from = $locations->addLocation( ['latitude' => $data['from_latitude'], 'longitude' => $data['from_longitude'] ] );
        $from = \App\Helpers\LangData::changeDataItem( $from, ['name', 'original'], LANG );
        $from = $this->returnArray( $from );

        $to = $locations->addLocation( ['latitude' => $data['to_latitude'], 'longitude' => $data['to_longitude'] ] );
        $to = \App\Helpers\LangData::changeDataItem( $to, ['name', 'original'], LANG );
        $to = $this->returnArray( $to );

        if ( empty( $from['id'] ) || empty( $to['id'] ) ) {
            
            $errors['popup_from'] = 1;
            $errors['popup_to'] = 1;
        }
        
        if ( !empty( $errors ) ) {
            
            return ['errors' => $errors, 'data' => '', 'successful' => false ];
        }
        
        $new_request = App::make( 'App\Requests' );
        
        $new_request->from_id = $from['id'];
        $new_request->from_date = ( $type == 'web' ) ? $data['popup_date'] . ' ' . $data['popup_time_from'] : $data['date_from'] . ' ' . $data['time_from'];
        $new_request->to_id = $to['id'];
        $new_request->to_date = ( $type == 'web' ) ? $data['popup_date_to'] . ' ' . $data['popup_time_to'] : $data['date_to'] . ' ' . $data['time_to'];
        $new_request->data = json_encode( $data );
        $new_request->status = 'wait';
        $new_request->lang = LANG;
        $new_request->type = $type;
        $new_request->user_id = !empty( $data['user_id'] ) ? $data['user_id'] : 0;
        
        $return_data = [
            'from' => $from['_name_'],
            'to' => $to['_name_'],
            'from_date' => ( $type == 'web' ) ? $data['popup_date'] . ' ' . $data['popup_time_from'] : $data['date_from'] . ' ' . $data['time_from'],
            'to_date' => ( $type == 'web' ) ? $data['popup_date_to'] . ' ' . $data['popup_time_to'] : $data['date_to'] . ' ' . $data['time_to'],
        ];
        
        $save = $new_request->save();
        
        $return = !empty( $save ) ?  ['successful' => true, 'data' => $return_data ] : ['successful' => false, 'errors' => [ 'add' => 1 ] ];
        
        return $return;
    }
    
    private function validationWeb( $data )
    {
        $errors = [];
        
        if ( empty( $data['popup_from'] ) || empty( $data['from_latitude'] ) || empty( $data['from_longitude'] ) || empty( $data['from_place'] ) ) {
            
            $errors['popup_from'] = 1;
        }
        
        if ( empty( $data['popup_to'] ) || empty( $data['to_latitude'] ) || empty( $data['to_longitude'] ) || empty( $data['to_place'] ) ) {
            
            $errors['popup_to'] = 1;
        }
        
        $detect = ['popup_date', 'popup_time_from', 'popup_date_to', 'popup_time_to'];
        
        foreach ( $detect as $val ) {
            
            if ( empty( $data[ $val ] ) ) {
                
                $errors[ $val ] = 1;
            }
        }
        
        return $errors;
    }
    
    private function validationApi( $data )
    {
        $errors = [];
        
        if ( empty( $data['from_latitude'] ) || empty( $data['from_longitude'] ) || empty( $data['from_place'] ) ) {
            
            $errors['from'] = 1;
        }
        
        if ( empty( $data['to_latitude'] ) || empty( $data['to_longitude'] ) || empty( $data['to_place'] ) ) {
            
            $errors['to'] = 1;
        }
        
        $detect = ['date_from', 'time_from', 'date_to', 'time_to'];
        
        foreach ( $detect as $val ) {
            
            if ( empty( $data[ $val ] ) ) {
                
                $errors[ $val ] = 1;
            }
        }
        
        return $errors;
    }
    
    public function getLastRequests( $lang, $limit = 0 )
    {
        $limit = !empty( $limit ) ? $limit : $this->active_requests_limit;
        
        $list = [];
        
        $filter = ['moreeq|from_date' => date('Y-m-d H:i:s') ];
        
        $list = $this->getRequests( $filter, [['from_date' => 'ASC']], $limit );
        $uers_ids = \App\Helpers\Helpers::getIds( $list, 'user_id' );
        $list = $this->returnArray( $list );
        $list = \App\Helpers\LangData::changeArrayData( $list, ['f_name','f_original','t_name','t_original'], $lang );
        
        $reviews_params = [
            'in|user_to_id' => $uers_ids,
            'null|deleted' => 1,
            'eq|status' => 'confirm'
        ];
        
        $reviews = $this->returnArray( $this->user_reviews->getUserReviews( $reviews_params ) );
        $reviews = \App\Helpers\Helpers::groupByKey( $reviews, 'user_to_id' );
        
        $users_params = [
            'in|users.id' => $uers_ids,
            'null|users.deleted' => 1
        ];
        
        $users = $this->returnArray( $this->users->getUsers( $users_params ) );
        $users = \App\Helpers\Helpers::dataToKey( $users, 'id' );
        
        $ratings = $this->returnArray( $this->user_rating->getUserRatings( [ 'in|user_to_id' => $uers_ids ], [], 100000, 0, 'user_to_id' ) );
        $ratings = \App\Helpers\Helpers::dataToKey( $ratings, 'user_to_id' );
        
        if ( !empty( $list ) ) {
            
            if ( !empty( $users ) ) {
                
                foreach ( $list as $key => $val ) {
                    
                    if ( isset( $users[ $val['user_id'] ] ) ) {
                        
                        $list[ $key ]['_user_'] = $users[ $val['user_id'] ];
                        
                        $list[ $key ]['_user_']['_reviews_count_'] = isset( $reviews[ $val['user_id'] ] ) ? count( $reviews[ $val['user_id'] ] ) : 0;
                    }
                }
            }
            
            if ( !empty( $ratings ) ) {
                
                foreach ( $list as $key => $val ) {
                    
                    if ( isset( $ratings[ $val['user_id'] ] ) ) {
                        
                        $list[ $key ]['_rating_'] = $ratings[ $val['user_id'] ];
                        $list[ $key ]['_rating_']['avarage'] = round( $list[ $key ]['_rating_']['avarage'], 1 );
                    }
                }
            }
        }
        
        return $list;
    }
}
