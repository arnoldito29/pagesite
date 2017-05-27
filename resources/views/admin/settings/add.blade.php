@extends('layouts.admin')

@section('content')

@include('admin.blocks.tabs')
<div class="row">
    {{ Form::open(array('url' => 'admin/settings/add', 'class'=> 'form-horizontal' )) }}
    <div id="tab_lt" class="admin-tabs-item hide">
        <div class="form-group">
            <label class="control-label col-sm-2" for="text_lt">{{trans( 'admin.Url') }}:</label>
            <div class="col-sm-6">
                {{Form::text( 'url_lt', '', ['id' => 'url_lt', 'class' => 'form-control' ] )}}
            </div>
            @if ($errors->has('url_lt'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_lt') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="new_window_lt">{{trans( 'admin.New window') }}:</label>
            <div class="col-sm-6">
                <label class="radio-inline">{{Form::radio( 'new_window_lt', 1 )}}{{trans( 'admin.Yes') }}</label>
                <label class="radio-inline">{{Form::radio( 'new_window_lt', 0, true )}}{{trans( 'admin.No') }}</label>
            </div>
        </div>
    </div>
    <div id="tab_lv" class="admin-tabs-item hide">
        <div class="form-group">
            <label class="control-label col-sm-2" for="url_lv">{{trans( 'admin.Url') }}:</label>
            <div class="col-sm-6">
                {{Form::text( 'url_lv', '', ['id' => 'url_lv', 'class' => 'form-control' ] )}}
            </div>
            @if ($errors->has('url_lv'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_lv') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="new_window_lv">{{trans( 'admin.New window') }}:</label>
            <div class="col-sm-6">
                <label class="radio-inline">{{Form::radio( 'new_window_lv', 1 )}}{{trans( 'admin.Yes') }}</label>
                <label class="radio-inline">{{Form::radio( 'new_window_lv', 0, true )}}{{trans( 'admin.No') }}</label>
            </div>
        </div>
    </div>
    <div id="tab_ee" class="admin-tabs-item hide">
        <div class="form-group">
            <label class="control-label col-sm-2" for="url_ee">{{trans( 'admin.Url') }}:</label>
            <div class="col-sm-6">
                {{Form::text( 'url_ee', '', ['id' => 'url_ee', 'class' => 'form-control' ] )}}
            </div>
            @if ($errors->has('url_ee'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_ee') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="new_window_ee">{{trans( 'admin.New window') }}:</label>
            <div class="col-sm-6">
                <label class="radio-inline">{{Form::radio( 'new_window_ee', 1 )}}{{trans( 'admin.Yes') }}</label>
                <label class="radio-inline">{{Form::radio( 'new_window_ee', 0, true )}}{{trans( 'admin.No') }}</label>
            </div>
        </div>
    </div>
    <div id="tab_en" class="admin-tabs-item hide">
        <div class="form-group">
            <label class="control-label col-sm-2" for="url_en">{{trans( 'admin.Url') }}:</label>
            <div class="col-sm-6">
                {{Form::text( 'url_en', '', ['id' => 'url_en', 'class' => 'form-control' ] )}}
            </div>
            @if ($errors->has('url_en'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_en') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="new_window_en">{{trans( 'admin.New window') }}:</label>
            <div class="col-sm-6">
                <label class="radio-inline">{{Form::radio( 'new_window_en', 1 )}}{{trans( 'admin.Yes') }}</label>
                <label class="radio-inline">{{Form::radio( 'new_window_en', 0, true )}}{{trans( 'admin.No') }}</label>
            </div>
        </div>
    </div>
    <div id="tab_ru" class="admin-tabs-item hide">
        <div class="form-group">
            <label class="control-label col-sm-2" for="url_ru">{{trans( 'admin.Url') }}:</label>
            <div class="col-sm-6">
                {{Form::text( 'url_ru', '', ['id' => 'url_ru', 'class' => 'form-control' ] )}}
            </div>
            @if ($errors->has('url_ru'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_ru') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="new_window_ru">{{trans( 'admin.New window') }}:</label>
            <div class="col-sm-6">
                <label class="radio-inline">{{Form::radio( 'new_window_ru', 1 )}}{{trans( 'admin.Yes') }}</label>
                <label class="radio-inline">{{Form::radio( 'new_window_ru', 0, true )}}{{trans( 'admin.No') }}</label>
            </div>
        </div>
    </div>
    <div id="tab_pl" class="admin-tabs-item hide">
        <div class="form-group">
            <label class="control-label col-sm-2" for="url_pl">{{trans( 'admin.Url') }}:</label>
            <div class="col-sm-6">
                {{Form::text( 'url_pl', '', ['id' => 'url_pl', 'class' => 'form-control' ] )}}
            </div>
            @if ($errors->has('url_pl'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_pl') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="new_window_pl">{{trans( 'admin.New window') }}:</label>
            <div class="col-sm-6">
                <label class="radio-inline">{{Form::radio( 'new_window_pl', 1 )}}{{trans( 'admin.Yes') }}</label>
                <label class="radio-inline">{{Form::radio( 'new_window_pl', 0, true )}}{{trans( 'admin.No') }}</label>
            </div>
        </div>
    </div>
    <div id="tab_ua" class="admin-tabs-item hide">
        <div class="form-group">
            <label class="control-label col-sm-2" for="url_ua">{{trans( 'admin.Url') }}:</label>
            <div class="col-sm-6">
                {{Form::text( 'url_ua', '', ['id' => 'url_ua', 'class' => 'form-control' ] )}}
            </div>
            @if ($errors->has('url_ua'))
                <span class="help-block">
                    <strong>{{ $errors->first('url_ua') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="new_window_ua">{{trans( 'admin.New window') }}:</label>
            <div class="col-sm-6">
                <label class="radio-inline">{{Form::radio( 'new_window_ua', 1 )}}{{trans( 'admin.Yes') }}</label>
                <label class="radio-inline">{{Form::radio( 'new_window_ua', 0, true )}}{{trans( 'admin.No') }}</label>
            </div>
        </div>
    </div>
    <div id="tab_generic" class="admin-tabs-item">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">{{trans( 'admin.Name') }}:</label>
            <div class="col-sm-6">
                {{Form::text( 'name', '', ['id' => 'name', 'class' => 'form-control' ] )}}
            </div>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="status">{{trans( 'admin.Status') }}:</label>
            <div class="col-sm-6">
                <label class="radio-inline">{{Form::radio( 'active', 1 )}}{{trans( 'admin.Active') }}</label>
                <label class="radio-inline">{{Form::radio( 'active', 0, true )}}{{trans( 'admin.Inactive') }}</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            {{Form::submit( trans( 'admin.Submit'), ['class' => 'btn btn-primary' ] )}}
        </div>
    </div>
    {{ Form::close() }}
</div>

@endsection