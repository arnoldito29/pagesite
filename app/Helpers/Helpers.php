<?php

namespace App\Helpers;

use Request;

class Helpers
{
    static public function back()
    {
        return redirect()->back()->getTargetUrl();
    }
    
    static public function shortText( $text, $length = 50 )
    {
        if ( empty( $text ) ) {
            
            return false;
        }
        
        $text = substr( strip_tags( $text ), 0, $length );
        
        return $text . ' ...';
    }
    
    static function dateTimes()
    {
        $data = [];
        
        $minutes = ['00', '15', '30', '45'];
        
        for ( $i = 0; $i < 24; $i++ ) {
            
            $h = ( $i > 9 ) ? $i : '0' . $i;
            
            foreach ( $minutes as $val ) {
                
                $item = $h . ':' . $val;
                
                $data[ $item ] = $item;
            }
        }
        
        return $data;
    }
    
    static public function getIds( $data, $key )
    {
        $return_array = [];
        
        if ( empty( $key ) ) {
            
            return $return_array;
        }
        
        foreach ( $data as $val ) {
            
            $return_array[] = $val->$key;
        }
        
        return $return_array;
    }
    
    static public function groupByKey( $data, $key )
    {
        if ( !is_array( $data ) || empty( $data ) || empty( $key ) ) {
            
            return $data;
        }
        
        $return_array = [];
        
        foreach ( $data as $val ) {
            
            if ( isset( $val[ $key ] ) ) {
                
                $return_array[ $val[ $key ] ][] = $val;
            } else {
                
                $return_array[] = $val;
            }
        }
        
        return $return_array;
    }
    
    static public function dataToKey( $data, $key )
    {
        if ( !is_array( $data ) || empty( $data ) || empty( $key ) ) {
            
            return $data;
        }
        
        $return_array = [];
        
        foreach ( $data as $val ) {
            
            if ( isset( $val[ $key ] ) ) {
                
                $return_array[ $val[ $key ] ] = $val;
            } else {
                
                $return_array[] = $val;
            }
        }
        
        return $return_array;
    }
    
    static public function hiddenPhone( $data, $key )
    {
        if ( empty( $data ) || empty( $key ) ) {
            
            return [];
        }
        
        if ( isset( $data[ $key ] ) ) {
            
            $data[ '_' . $key . '_hidden_' ] = substr( $data[ $key ], 0, 4) . '...';
        }
        
        return $data;
    }
    
    static public function getRatingPercent( $data )
    {
        if ( empty( $data ) ) {
            
            return 0;
        }
        
        $data = round( $data / 5 * 100 );
        
        return $data;
    }
    
    static public function getChannel( $from, $to )
    {
        $name = 'chat-channel-';
        $channel = $from > $to ? $name . $to . '-' . $from : $name . $from . '-' . $to;
        
        return $channel;
    }
    
    static public function getYearsList()
    {
        $now = date( "Y" );
        
        $years = [];
        
        for ( $i = ( $now - 18 ); $i > ( $now - 99 ) ; $i-- ) {
            
            $years[] = $i;
        }
        
        return $years;
    }
    
    static public function seats()
    {
        $return = [];
        
        for( $i = 1; $i < 8; $i++ ) {
            
            $return[] = $i;
        }
        
        return $return;
    }
}
