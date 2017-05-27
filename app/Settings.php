<?php

namespace App;

use App\AppDb;
use Illuminate\Database\Eloquent\Model;
use App;

class Settings extends Model
{
    use AppDb;
    public $timestamps = false;

    public function getSettings( $filter = [], $order = [], $limit = 100000, $offset = 0 )
    {
        $sql = $this->get( $filter, $order, $limit, $offset );
        
        $settings = $sql->get();
        
        return $settings;
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
            'required' => \Lang::get('messages.error_empty'),
            'min' => \Lang::get('messages.error_min')
        );
        
        $setting = self::find( $data['id'] );
        
        if ( empty( $setting ) ) {
            
            return false;
        }
        
        $rules = array('name' => 'required');
        
        $validator = \Validator::make($data, $rules, $messages );
        
        if ( $validator->fails() ) {

            return $validator->getMessageBag()->toArray();
        }
        
        $setting->name = ( !empty( $data['name'] ) ) ? $data['name'] : $setting->name;
        $setting->url_lt = ( isset( $data['url_lt'] ) ) ? $data['url_lt'] : $setting->url_lt;
        $setting->new_window_lt = ( !empty( $data['new_window_lt'] ) ) ? 1 : 0;
        $setting->url_lv = ( isset( $data['url_lv'] ) ) ? $data['url_lv'] : $setting->url_lv;
        $setting->new_window_lv = ( !empty( $data['new_window_lv'] ) ) ? 1 : 0;
        $setting->url_ee = ( isset( $data['url_ee'] ) ) ? $data['url_ee'] : $setting->url_ee;
        $setting->new_window_ee = ( !empty( $data['new_window_ee'] ) ) ? 1 : 0;
        $setting->url_en = ( isset( $data['url_en'] ) ) ? $data['url_en'] : $setting->url_en;
        $setting->new_window_en = ( !empty( $data['new_window_en'] ) ) ? 1 : 0;
        $setting->url_ru = ( isset( $data['url_ru'] ) ) ? $data['url_ru'] : $setting->url_ru;
        $setting->new_window_ru = ( !empty( $data['new_window_ru'] ) ) ? 1 : 0;
        $setting->url_pl = ( isset( $data['url_pl'] ) ) ? $data['url_pl'] : $setting->url_pl;
        $setting->new_window_pl = ( !empty( $data['new_window_pl'] ) ) ? 1 : 0;
        $setting->url_ua = ( isset( $data['url_ua'] ) ) ? $data['url_ua'] : $setting->url_ua;
        $setting->new_window_ua = ( !empty( $data['new_window_ua'] ) ) ? 1 : 0;
        $setting->sort = 0;
        $setting->active = ( !empty( $data['active'] ) ) ? 1 : 0;
        
        return $setting->save();
    }
    
    public function postDelete( $id )
    {
        if ( empty( $id ) ) {
           
            return false;
        }
        
        $setting = self::find( $id );
        
        if ( empty( $setting ) ) {
            
            return false;
        }
        
        $setting->deleted = true;
        
        return $setting->save();
    }
    
    public function postActive( $id )
    {
        if ( empty( $id ) ) {
           
            return false;
        }
        
        $setting = self::find( $id );
        
        if ( empty( $setting ) ) {
            
            return false;
        }
        
        $setting->active = !empty( $setting->active ) ? 0 : 1;
        
        return $setting->save();
    }
    
    public function add( $data = array() )
    {
        if ( empty( $data ) ) {
            
            return false;
        }
          
        $messages = array(
            'required' => \Lang::get('messages.error_empty'),
            'min' => \Lang::get('messages.error_min'),
        );
        
        $rules = array('name' => 'required');
        
        $validator = \Validator::make($data, $rules, $messages );
        
        if ( $validator->fails() ) {

            return $validator->getMessageBag()->toArray();
        }
        
        $setting = App::make( 'App\Settings' );
        
        $setting->name = ( !empty( $data['name'] ) ) ? $data['name'] : '';
        $setting->url_lt = ( isset( $data['url_lt'] ) ) ? $data['url_lt'] : '';
        $setting->new_window_lt = ( !empty( $data['new_window_lt'] ) ) ? 1 : 0;
        $setting->url_lv = ( isset( $data['url_lv'] ) ) ? $data['url_lv'] : '';
        $setting->new_window_lv = ( !empty( $data['new_window_lv'] ) ) ? 1 : 0;
        $setting->url_ee = ( isset( $data['url_ee'] ) ) ? $data['url_ee'] : '';
        $setting->new_window_ee = ( !empty( $data['new_window_ee'] ) ) ? 1 : 0;
        $setting->url_en = ( isset( $data['url_en'] ) ) ? $data['url_en'] : '';
        $setting->new_window_en = ( !empty( $data['new_window_en'] ) ) ? 1 : 0;
        $setting->url_ru = ( isset( $data['url_ru'] ) ) ? $data['url_ru'] : '';
        $setting->new_window_ru = ( !empty( $data['new_window_ru'] ) ) ? 1 : 0;
        $setting->url_pl = ( isset( $data['url_pl'] ) ) ? $data['url_pl'] : '';
        $setting->new_window_pl = ( !empty( $data['new_window_pl'] ) ) ? 1 : 0;
        $setting->url_ua = ( isset( $data['url_ua'] ) ) ? $data['url_ua'] : '';
        $setting->new_window_ua = ( !empty( $data['new_window_ua'] ) ) ? 1 : 0;
        $setting->create = date( 'Y-m-d H:i:s' );
        $setting->sort = 0;
        $setting->active = ( !empty( $data['active'] ) ) ? 1 : 0;
        
        return $setting->save();
    }
    
    public function getPublicSettings( $lang )
    {
        $list = $this->getSettings(['null|deleted' => null, 'noteq|url_' . $lang => '', 'eq|active' => 1 ], [ ['id' => 'DESC'] ] );
        $list = $this->returnArray( $list );
        $list = \App\Helpers\LangData::changeArrayData( $list, ['url', 'new_window'], $lang );
        
        return $list;
    }
}
