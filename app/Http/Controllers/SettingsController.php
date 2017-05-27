<?php

namespace App\Http\Controllers;

use Request;
use App\Settings;
use Redirect;
use Lang;

class SettingsController extends Controller
{
    protected $limit = 10;
    protected $settings;
    
    public function __construct( Settings $settings )
    {
        $this->settings = $settings;
    }
    
    public function index()
    {
        $page = (int)Request::input('page');
        $page = ( !empty( $page ) ) ? $page : 1;
        $locale = Lang::getLocale();
        
        $count = $this->settings->getCount( [ 'null|deleted' => null ] );
        
        $page = max( min( $page, ceil( $count / $this->limit ) ), 1 );
        
        $settings = $this->settings->getSettings( [ 'null|deleted' => null ], [ ['id' => 'DESC' ] ], $this->limit, ( $page - 1 ) * $this->limit );
        
        if ( !empty( $locale ) ) {
            
            $settings = \App\Helpers\LangData::changeData( $settings, ['name', 'text'], $locale );
        }
        
        $paging = \App\Helpers\Paging::paging( $count, $this->limit, $page );
        
        return view('admin.settings.list', ['settings' => $settings, 'paging' => $paging ]);
    }
    
    public function show( $id )
    {
        return view('admin.settings.show', ['setting' => Settings::find( $id ) ] );
    }
    
    public function edit( $id )
    {
        $benefit = [];
        
        if ( !empty( $id ) ) {
        
            $setting = Settings::find( $id );
        }
        
        return view('admin.settings.edit', ['setting' => $setting ] );
    }
    
    public function postEdit()
    {
        $data = Request::all();
        
        $return_data = $this->settings->edit( $data );
        
        if ( $return_data === true ) {
            
            \Session::flash('status_msg', Lang::get('messages.Successfully update'));
        } else {
            
            \Session::flash('status_msg', Lang::get('messages.Unsuccessfully update'));
            \Session::flash('status_error', true);
        }
        
        if ( !empty( $data['id'] ) ) {
            
            return Redirect::to('admin/settings/' . $data['id'] . '/edit')->withinput( $data )->withErrors( $return_data );
        } else {
            
            return Redirect::to('admin/settings');
        }
    }
    
    public function postDelete()
    {
        $data = Request::all();
        
        if ( empty( $data['id'] ) ) {
            
            return response()->json( ['status' => 'error'] ); 
        }
        
        $return = $this->settings->postDelete( $data['id'] );
        
        $return_data = !empty( $return ) ? ['status' => 'ok'] : ['status' => 'error'];
        
        return response()->json( $return_data );
    }
    
    public function create()
    {        
        return view('admin.settings.add' );
    }
    
    public function postAdd()
    {
        $data = Request::all();
        
        $return_data = $this->settings->add( $data );
        
        if ( $return_data === true ) {
            
            \Session::flash('status_msg', Lang::get('messages.Successfully add'));
        } else {
            
            \Session::flash('status_msg', Lang::get('messages.Unsuccessfully add'));
            \Session::flash('status_error', true);
        }
        
        return Redirect::to('admin/settings/create')->withinput( $data )->withErrors( $return_data );
    }
    
    public function postActive()
    {
        $data = Request::all();
        
        if ( empty( $data['id'] ) ) {
            
            return response()->json( ['status' => 'error'] ); 
        }
        
        $return = $this->settings->postActive( $data['id'] );
        
        $status = ( !empty( $return ) ) ? ['status' => 'ok']: ['status' => 'error'];
        
        return response()->json( $status ); 
    }
    
    public function socialMenu()
    {
        $locale = defined('LANG') ? LANG : 'lt';
        $list = $this->settings->getPublicSettings( $locale );
        
        return $list;
    }
}
