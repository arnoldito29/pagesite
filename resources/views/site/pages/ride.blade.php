@extends('layouts.pages')

@section('content')

<section class="find-a-ride">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <form id="ride_search" method="post" onsubmit="rideSearchSubmit( this ); return false;">
                    <div class="find__container find__container-left">
                        <div class="find__row">
                            <div class="find__title">{{trans( 'ride.Find a ride') }}</div>
                        </div>
                        <div class="find__row">
                            <div class="form__field ">
                                <span class="form__addon form__addon-left">
                                    <img src="/images/ui/location-green.png" alt="">
                                </span>
                                <input type="text" name="from" id="ride_from" class="form" placeholder="{{trans( 'ride.Leaving from') }}">
                                <input type="hidden" name="from_latitude" id="from_latitude" value="" />
                                <input type="hidden" name="from_longitude" id="from_longitude" value="" />
                                <input type="hidden" name="from_place" id="from_place" value="" />
                                <span class="form__addon form__addon-right">
                                    <span class="caret"></span>
                                </span>
                            </div>
                        </div>
                        <div class="find__row">
                            <div class="form__field ">
                                <span class="form__addon form__addon-left">
                                    <img src="/images/ui/location-blue.png" alt="">
                                </span>
                                <input type="text" name="to" id="ride_to" class="form" placeholder="{{trans( 'ride.Going to') }}">
                                <input type="hidden" name="to_latitude" id="to_latitude" value="" />
                                <input type="hidden" name="to_longitude" id="to_longitude" value="" />
                                <input type="hidden" name="to_place" id="to_place" value="" />
                                <span class="form__addon form__addon-right">
                                    <span class="caret"></span>
                                </span>
                            </div>
                        </div>
                        <div class="find__row">
                            <div class="form__field ">
                                <span class="form__addon form__addon-left">
                                    <img src="/images/ui/calendar.png" alt="">
                                </span>
                                <input  type="text" name="date" id="ride_date" class="form datepicker" placeholder="{{trans( 'ride.From:') }}">
                                <span class="form__addon form__addon-right">
                                    <span class="caret"></span>
                                </span>
                            </div>
                        </div>
                        <div class="find__row">
                            <div class="find__btn-container">
                                <button type="submit" class="btn btn__green find__btn-search">{{trans( 'ride.Search submit') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="find__leave-request-container">
                        <div class="find__leave-request-container-title">{{trans( 'ride.Ride title') }}</div>
                        <div class="find__leave-request-container-img">
                            <img src="/images/find-a-ride/request.png" alt="">
                        </div>
                        <div class="find__leave-request-container-info">
                            <div class="find__leave-request-container-text">
                                {{trans( 'ride.Ride request text') }}
                            </div>
                            <div class="find__leave-request-container-btn">
                                <buttton class="btn btn__empty-green find__btn-leave"
                                         data-toggle="modal" data-href="{{ URL::route('requests/form') }}" data-target="#modalRequest-of-a-ride">{{trans( 'ride.Leave request') }}</buttton>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-lg-6" id="ride_container">
                <div class="find__container find__container-right find__container-grey">
                    <div class="find__noresults-container">
                        <div class="noresults__title">{{trans( 'ride.no result title') }}</div>
                        <div class="noresults__text">
                            {!!trans( 'ride.no result text')!!}
                        </div>
                    </div>
                </div>
            </div>
            @include('site.blocks.loading')
        </div>
    </div>
</section>
@endsection