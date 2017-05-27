<?php

namespace App\System;

class Sms
{
    protected $phones = [
        'lt' => '37067363236',
        'lv' => '37128914555',
        'ua' => '',
        'ee' =>''
    ];
    
    public $phone;

    public function __construct()
    {
        if ( defined('LANG') ) {
            
            $this->phone = ( !empty( $this->phones[ LANG ] ) ) ? $this->phones[ LANG ] : $this->phones['lt'];
        } else {
            
            $this->phone = $this->phones['lt'];
        }
    }
    
    public function send( $to, $text)
    {
        $type = 'text';

        if (\App\Helpers\LangData::toAscii($text) != $text) {
            $type = 'unicode';
        }

        $fields = [
            'sender' => $this->phone,
            'recipient' => $to,
            'type' => $type,
            'text' => $text
        ];

        $ch = curl_init('http://sms.eurospektras.lt:8081/sms');

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        return json_decode($result, true);
    }
}