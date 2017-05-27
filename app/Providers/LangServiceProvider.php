<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class LangServiceProvider extends ServiceProvider
{
    protected $allow = [ 'admin', 'logout', 'login', 'api', 'register' ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $data = Request::all();
        $api = Request::segment(1);
        
        if ( empty( $api ) ) {
            
            $locale = $this->webLang();
        } elseif ( empty( $data['lang'] ) && empty( $data['token'] ) && $api != 'api' ) {
            
            $locale = $this->webLang();
        } elseif ( !empty( $data['lang'] ) && !empty( $data['token'] ) ) {
            
            $locale = $this->changeLang( $data );
        } else {
            
            $lang = Request::header('Accept-Language');
            $locale = $this->apiLang( $lang );
        }
        
        \Lang::setLocale( $locale );
        
        define( 'LANG', $locale );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    public function webLang()
    {
        $locale = Request::segment(1);

        if (!in_array($locale, \Config::get('app.available_locales'))) {

            if ( !empty( $locale ) && !in_array( $locale, $this->allow ) ) {
                
                $url = url( 'lt' );
                header('Location: '.  $url );
                die();
            }

            $locale = 'lt';
        }
        
        return $locale;
    }
    
    public function apiLang( $data, $token = '' )
    {
        if ( !empty( $data ) && in_array( $data, \Config::get('app.available_locales') ) ) {
            
            return $data;
        }
        
        if ( empty( $token ) ) {
            
            return \Config::get('app.locale');
        }
        
        $user_model = \App::make( '\App\User' );
        $user = $user_model->getUser( ['api_token' => $token ] );
        
        if ( empty( $user->lang ) ) {
            
            return \Config::get('app.locale');
        }
        
        return  $user->lang;
    }
    
    public function changeLang( $data )
    {
        if ( empty( $data['lang'] ) || empty( $data['token'] ) ) {
            
            return \Config::get('app.locale');
        }
        
        if ( !in_array( $data['lang'], \Config::get('app.available_locales') ) ) {
            
            return \Config::get('app.locale');
        }
        
        $user_model = \App::make( '\App\User' );
        $user = $user_model->getUser( ['api_token' => $data['token'] ] );
        
        if ( empty( $user->lang ) || empty( $user->id ) ) {
            
            return \Config::get('app.locale');
        }
        
        $user_model->updateUser( ['lang' => $data['lang'] ], $user->id );
        
        return  $data['lang'];
    }
}
