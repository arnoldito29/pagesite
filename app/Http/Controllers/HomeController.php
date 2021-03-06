<?php

namespace App\Http\Controllers;

use Event;
use App\Events\UserLogin;
use Request;
use Config;

class HomeController extends Controller
{
    protected $allow = ['get-started', 'api'];
    protected $view_key = 'dkfjg81321df';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $path = Request::path();
        
        if ( $path == '/' ) {
            
            return false;
        }
        
        $data = preg_split( '/\//', $path );
        
        if ( !empty( $data[2] ) && !empty( $this->allow[ $data[1] ] ) ) {
        
            if ( !in_array( $data[2], $this->allow[ $data[1] ] ) ) {
                
                $this->middleware('auth');
            }
        } else if ( !empty( $data[1] ) ) {
            
            if ( !in_array( $data[1], $this->allow ) ) {
                
                $this->middleware('auth');
            }
        } else if ( !empty( $data[0] ) && !in_array( $data[0], Config::get('app.available_locales') ) ) {
            
            $this->middleware('auth');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Event::fire(new UserLogin( ['data'] ));
        
        return view('site.index', ['home_page' => 1 ] );
    }
    
    public function getStarted()
    {
        return view('site.pages.started');
    }
    
    public function viewApi()
    {
        $data = Request::all();
        
        if ( empty( $data['key'] ) || $data['key'] != $this->view_key ) {
            
            return view('errors.404');
        }
        
        return view('layouts.api');
    }
}
