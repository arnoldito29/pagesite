@extends('layouts.admin')

@section('content')
@if ( !empty( $setting ) )
@include('admin.blocks.tabs')
<div id="tab_lt" class="admin-tabs-item hide">
    <div class="row">
        <div class="col-md-2">
            {{trans( 'admin.Url') }}:
        </div>
        <div class="col-md-5">
            {{$setting["url_lt"]}}
        </div>
    </div>
</div>
<div id="tab_lv" class="admin-tabs-item hide">
    <div class="row">
        <div class="col-md-2">
            {{trans( 'admin.Url') }}:
        </div>
        <div class="col-md-5">
            {{$setting["url_lv"]}}
        </div>
    </div>
</div>
<div id="tab_ee" class="admin-tabs-item hide">
    <div class="row">
        <div class="col-md-2">
            {{trans( 'admin.Url') }}:
        </div>
        <div class="col-md-5">
            {{$setting["url_ee"]}}
        </div>
    </div>
</div>
<div id="tab_en" class="admin-tabs-item hide">
    <div class="row">
        <div class="col-md-2">
            {{trans( 'admin.Url') }}:
        </div>
        <div class="col-md-5">
            {{$setting["url_en"]}}
        </div>
    </div>
</div>
<div id="tab_ru" class="admin-tabs-item hide">
    <div class="row">
        <div class="col-md-2">
            {{trans( 'admin.Url') }}:
        </div>
        <div class="col-md-5">
            {{$setting["url_ru"]}}
        </div>
    </div>
</div>
<div id="tab_pl" class="admin-tabs-item hide">
    <div class="row">
        <div class="col-md-2">
            {{trans( 'admin.Url') }}:
        </div>
        <div class="col-md-5">
            {{$setting["url_pl"]}}
        </div>
    </div>
</div>
<div id="tab_ua" class="admin-tabs-item hide">
    <div class="row">
        <div class="col-md-2">
            {{trans( 'admin.Url') }}:
        </div>
        <div class="col-md-5">
            {{$setting["url_ua"]}}
        </div>
    </div>
</div>
<div id="tab_generic" class="admin-tabs-item">
    <div class="row">
        <div class="col-md-2">
            {{trans( 'admin.Created') }}:
        </div>
        <div class="col-md-5">
            {{$setting["create"]}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            {{trans( 'admin.Active') }}:
        </div>
        <div class="col-md-5">
            @if ( !empty( $setting["active"] ))
                {{trans( 'admin.Active') }}
            @else
                {{trans( 'admin.Inactive') }}
            @endif
        </div>
    </div>
</div>
@else
    {{trans( 'admin.not found') }}
@endif

@endsection