<?php

namespace App;

use App\AppDb;
use Illuminate\Database\Eloquent\Model;
use App;

class Faq extends Model
{
    use AppDb;
    
    public $timestamps = false;
    protected $table = 'faq';


    public function getFaq( $filter = [], $order = [], $limit = 100000, $offset = 0 )
    {
        $sql = self::get( $filter, $order, $limit, $offset );
        
        $faq = $sql->get();
        
        return $faq;
    }
    
    public function getCount( $filter = [] )
    {
        $count = self::count( $filter );
        
        return $count;
    }
    
    public function postActive( $id )
    {
        if ( empty( $id ) ) {
           
            return false;
        }
        
        $faq = self::find( $id );
        
        if ( empty( $faq ) ) {
            
            return false;
        }
        
        $faq->active = !empty( $faq->active ) ? 0 : 1;
        
        return $faq->save();
    }
    
    public function postDelete( $id )
    {
        if ( empty( $id ) ) {
           
            return false;
        }
        
        $faq = self::find( $id );
        
        if ( empty( $faq ) ) {
            
            return false;
        }
        
        $faq->deleted = true;
        
        return $faq->save();
    }
    
    public function add( $data = array() )
    {
        if ( empty( $data ) ) {
            
            return false;
        }
          
        $messages = array(
            'required' => \Lang::get('messages.error_empty'),
            'min' => \Lang::get('messages.error_min'),
            'email' => \Lang::get('messages.error_email'),
        );
        
        $rules = array();
        
        $validator = \Validator::make($data, $rules, $messages );
        
        if ( $validator->fails() ) {

            return $validator->getMessageBag()->toArray();
        }
        
        $faq = App::make( 'App\Faq' );
        
        $faq->name_lt = ( isset( $data['name_lt'] ) ) ? $data['name_lt'] : '';
        $faq->name_lv = ( isset( $data['name_lv'] ) ) ? $data['name_lv'] : '';
        $faq->name_ee = ( isset( $data['name_ee'] ) ) ? $data['name_ee'] : '';
        $faq->name_en = ( isset( $data['name_en'] ) ) ? $data['name_en'] : '';
        $faq->name_ru = ( isset( $data['name_ru'] ) ) ? $data['name_ru'] : '';
        $faq->name_pl = ( isset( $data['name_pl'] ) ) ? $data['name_pl'] : '';
        $faq->text_lt = ( isset( $data['text_lt'] ) ) ? $data['text_lt'] : '';
        $faq->text_lv = ( isset( $data['text_lv'] ) ) ? $data['text_lv'] : '';
        $faq->text_ee = ( isset( $data['text_ee'] ) ) ? $data['text_ee'] : '';
        $faq->text_en = ( isset( $data['text_en'] ) ) ? $data['text_en'] : '';
        $faq->text_ru = ( isset( $data['text_ru'] ) ) ? $data['text_ru'] : '';
        $faq->text_pl = ( isset( $data['text_pl'] ) ) ? $data['text_pl'] : '';
        $faq->create = date( 'Y-m-d H:i:s' );
        $faq->active = ( !empty( $data['active'] ) ) ? 1 : 0;
        
        return $faq->save();
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
        
        $faq = self::find( $data['id'] );
        
        if ( empty( $faq ) ) {
            
            return false;
        }
        
        $rules = array();
        
        $validator = \Validator::make($data, $rules, $messages );
        
        if ( $validator->fails() ) {

            return $validator->getMessageBag()->toArray();
        }
        
        $faq->name_lt = ( isset( $data['name_lt'] ) ) ? $data['name_lt'] : $faq->name_lt;
        $faq->name_lv = ( isset( $data['name_lv'] ) ) ? $data['name_lv'] : $faq->name_lv;
        $faq->name_ee = ( isset( $data['name_ee'] ) ) ? $data['name_ee'] : $faq->name_ee;
        $faq->name_en = ( isset( $data['name_en'] ) ) ? $data['name_en'] : $faq->name_en;
        $faq->name_ru = ( isset( $data['name_ru'] ) ) ? $data['name_ru'] : $faq->name_ru;
        $faq->name_pl = ( isset( $data['name_pl'] ) ) ? $data['name_pl'] : $faq->name_pl;
        $faq->text_lt = ( isset( $data['text_lt'] ) ) ? $data['text_lt'] : $faq->text_lt;
        $faq->text_lv = ( isset( $data['text_lv'] ) ) ? $data['text_lv'] : $faq->text_lv;
        $faq->text_ee = ( isset( $data['text_ee'] ) ) ? $data['text_ee'] : $faq->text_ee;
        $faq->text_en = ( isset( $data['text_en'] ) ) ? $data['text_en'] : $faq->text_en;
        $faq->text_ru = ( isset( $data['text_ru'] ) ) ? $data['text_ru'] : $faq->text_ru;
        $faq->text_pl = ( isset( $data['text_pl'] ) ) ? $data['text_pl'] : $faq->text_pl;
        $faq->active = ( !empty( $data['active'] ) ) ? 1 : 0;
        
        return $faq->save();
    }
    
    public function showActive( $lang )
    {
        $list = Faq::getFaq(['null|deleted' => null, 'noteq|name_' . $lang => '', 'eq|active' => 1 ], [ ['id' => 'DESC'] ] );
        $list = \App\Helpers\LangData::changeData( $list, ['name', 'text'], $lang );
        
        return $list;
    }
}
