<?php

namespace App\system;
use Illuminate\Support\Facades\Redirect AS RedirectParent;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Redirect extends RedirectParent
{
    static public function to( string $path, int $status = 302, array $headers = array(), bool $secure = null ) {
        
        return parent::to( $path, $status, $headers, $secure );
    }
    
    static public function away($path, $status = 302, $headers = array()) {
        
        return $this->createRedirect($path, $status, $headers);
    }
}

