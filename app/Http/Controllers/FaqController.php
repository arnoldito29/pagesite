<?php

namespace App\Http\Controllers;

use App\Faq;
use Request;
use Lang;
use Redirect;

class FaqController extends Controller
{
    protected $limit = 20;
    protected $active_limit = 50;
    
    protected $faq;
    
    public function __construct(Faq $faq )
    {
        $this->faq = $faq;
    }
    
    public function index()
    {
        $page = (int)Request::input('page');
        $page = ( !empty( $page ) ) ? $page : 1;
        $locale = \Lang::getLocale();
        
        $count = $this->faq->getCount( [ 'null|deleted' => null ] );
        
        $page = max( min( $page, ceil( $count / $this->limit ) ), 1 );
        
        $faq = $this->faq->getFaq( [ 'null|deleted' => null ], [ ['id' => 'DESC' ] ], $this->limit, ( $page - 1 ) * $this->limit );
        
        if ( !empty( $locale ) ) {
            
            $faq = \App\Helpers\LangData::changeData( $faq, ['name', 'text'], $locale );
        }
        
        $paging = \App\Helpers\Paging::paging( $count, $this->limit, $page );
        
        return view('admin.faq.list', ['faq' => $faq, 'paging' => $paging ]);
    }
    
    public function showActive()
    {
        $locale = Lang::getLocale();
        $locale = !empty( $locale ) ? $locale : 'lt';
        $faq = $this->faq->showActive( $locale );
        
        return view('user.blocks.faq', ['faq' => $faq ]);
    }
    
    public function show( $id )
    {
        return view('admin.faq.show', ['faq' => Faq::find( $id ) ] );
    }
    
    public function edit( $id )
    {
        $faq = [];
        
        if ( !empty( $id ) ) {
        
            $faq = Faq::find( $id );
        }
        
        $js['editor'] = ['text_lt', 'text_lv', 'text_ee', 'text_en', 'text_ru', 'text_pl'];
        
        return view('admin.faq.edit', ['faq' => $faq, 'js' => $js ] );
    }
    
    public function postActive()
    {
        $data = Request::all();
        
        if ( empty( $data['id'] ) ) {
            
            return response()->json( ['status' => 'error'] ); 
        }
        
        $return = $this->faq->postActive( $data['id'] );
        
        $status = ( !empty( $return ) ) ? ['status' => 'ok']: ['status' => 'error'];
        
        return response()->json( $status ); 
    }
    
    public function postDelete()
    {
        $data = Request::all();
        
        if ( empty( $data['id'] ) ) {
            
            return response()->json( ['status' => 'error'] ); 
        }
        
        $return = $this->faq->postDelete( $data['id'] );
        
        $return_data = !empty( $return ) ? ['status' => 'ok'] : ['status' => 'error'];
        
        return response()->json( $return_data );
    }
    
    public function create()
    {
        $js['editor'] = ['text_lt', 'text_lv', 'text_ee', 'text_en', 'text_ru', 'text_pl'];
        
        return view('admin.faq.add', ['js' => $js ] );
    }
    
    public function postAdd()
    {
        $data = Request::all();
        
        $return_data = $this->faq->add( $data );
        
        if ( $return_data === true ) {
            
            \Session::flash('status_msg', Lang::get('messages.Successfully add'));
        } else {
            
            \Session::flash('status_msg', Lang::get('messages.Unsuccessfully add'));
            \Session::flash('status_error', true);
        }
        
        return Redirect::to('admin/faq/create')->withinput( $data )->withErrors( $return_data );
    }
    
    public function postEdit()
    {
        $data = Request::all();
        
        $return_data = $this->faq->edit( $data );
        
        if ( $return_data === true ) {
            
            \Session::flash('status_msg', Lang::get('messages.Successfully update'));
        } else {
            
            \Session::flash('status_msg', Lang::get('messages.Unsuccessfully update'));
            \Session::flash('status_error', true);
        }
        
        if ( !empty( $data['id'] ) ) {
            
            return Redirect::to('admin/faq/' . $data['id'] . '/edit')->withinput( $data )->withErrors( $return_data );
        } else {
            
            return Redirect::to('admin/faq');
        }
    }
}
