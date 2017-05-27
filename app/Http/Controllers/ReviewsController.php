<?php

namespace App\Http\Controllers;

use Request;
use App\Reviews;
use Lang;
use Redirect;
use App;

class ReviewsController extends Controller
{
    protected $limit = 20;
    
    public function __construct( Reviews $reviews )
    {
        $this->reviews = $reviews;
    }
    
    public function index()
    {
        $page = (int)Request::input('page');
        $page = ( !empty( $page ) ) ? $page : 1;
        $locale = Lang::getLocale();
        
        $count = $this->reviews->getCount( [ 'null|deleted' => null ] );
        
        $page = max( min( $page, ceil( $count / $this->limit ) ), 1 );
        
        $reviews = $this->reviews->getReviews( [ 'null|deleted' => null ], [ ['id' => 'DESC' ] ], $this->limit, ( $page - 1 ) * $this->limit );
        
        if ( !empty( $locale ) ) {
            
            $reviews = \App\Helpers\LangData::changeData( $reviews, ['name', 'text'], $locale );
        }
        
        $paging = \App\Helpers\Paging::paging( $count, $this->limit, $page );
        
        return view('admin.reviews.list', ['reviews' => $reviews, 'paging' => $paging ]);
    }
    
    public function show( $id )
    {
        return view('admin.reviews.show', ['review' => Reviews::find( $id ) ] );
    }
    
    public function edit( $id )
    {
        $review = [];
        
        if ( !empty( $id ) ) {
        
            $review = Reviews::find( $id );
        }
        
        $js['editor'] = ['text_lt', 'text_lv', 'text_ee', 'text_en', 'text_ru', 'text_pl'];
        
        return view('admin.reviews.edit', ['review' => $review, 'js' => $js ] );
    }
    
    public function postEdit()
    {
        $data = Request::all();
        
        $return_data = $this->reviews->edit( $data );
        
        if ( $return_data === true ) {
            
            \Session::flash('status_msg', Lang::get('messages.Successfully update'));
        } else {
            
            \Session::flash('status_msg', Lang::get('messages.Unsuccessfully update'));
            \Session::flash('status_error', true);
        }
        
        if ( !empty( $data['id'] ) ) {
            
            return Redirect::to('admin/reviews/' . $data['id'] . '/edit')->withinput( $data )->withErrors( $return_data );
        } else {
            
            return Redirect::to('admin/reviews');
        }
    }
    
    public function postDelete()
    {
        $data = Request::all();
        
        if ( empty( $data['id'] ) ) {
            
            return response()->json( ['status' => 'error'] ); 
        }
        
        $return = $this->reviews->postDelete( $data['id'] );
        
        $return_data = !empty( $return ) ? ['status' => 'ok'] : ['status' => 'error'];
        
        return response()->json( $return_data );
    }
    
    public function create()
    {
        $js['editor'] = ['text_lt', 'text_lv', 'text_ee', 'text_en', 'text_ru', 'text_pl'];
        
        return view('admin.reviews.add', ['js' => $js ] );
    }
    
    public function postAdd()
    {
        $data = Request::all();
        
        $return_data = $this->reviews->add( $data );
        
        if ( $return_data === true ) {
            
            \Session::flash('status_msg', Lang::get('messages.Successfully add'));
        } else {
            
            \Session::flash('status_msg', Lang::get('messages.Unsuccessfully add'));
            \Session::flash('status_error', true);
        }
        
        return Redirect::to('admin/reviews/create')->withinput( $data )->withErrors( $return_data );
    }
    
    public function postActive()
    {
        $data = Request::all();
        
        if ( empty( $data['id'] ) ) {
            
            return response()->json( ['status' => 'error'] ); 
        }
        
        $return = $this->reviews->postActive( $data['id'] );
        
        $status = ( !empty( $return ) ) ? ['status' => 'ok']: ['status' => 'error'];
        
        return response()->json( $status ); 
    }
    
    static public function getPublicReviews()
    {
        $locale = Lang::getLocale();
        $locale = !empty( $locale ) ? $locale : 'lt';
        $reviews = App::make( 'App\Reviews' );
        $list = $reviews->getPublicReviews( $locale );
        
        return $list;
    }
}
