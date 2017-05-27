@extends('layouts.admin')

@section('content')

<div class="row">
    <a href="{{url('admin/settings/create' )}}" class="btn btn-primary">{{trans( 'admin.New') }}</a>
</div>
@if (count($settings) > 0)
    <table class="table table-hover">
        <thead>
          <tr>
            <th>{{trans( 'admin.Number') }}</th>
            <th>{{trans( 'admin.Name') }}</th>
            <th>{{trans( 'admin.Actions') }}</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($settings as $key => $setting)
        <tr data-id="{{$setting->id}}">
            <td><a href="{{url('admin/settings/' . $setting->id )}}">{{$setting->id}}</a></td>
            <td>{{$setting->name}}</td>
            <td>
                <a href="{{url('admin/settings/' . $setting->id )}}/edit" class="btn btn-primary">{{trans( 'admin.Edit') }}</a>
                <button type="button" data-action="setting-active" data-id="{{$setting->id}}" class="btn @if (!empty( $setting->active ))btn-success @else btn-danger @endif">{{trans( 'admin.Active') }}</button>
                <button type="button" data-action="setting-delete" data-id="{{$setting->id}}" class="btn btn-danger">{{trans( 'admin.Delete') }}</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@else
    {{trans( 'admin.list empty') }}
@endif

@endsection