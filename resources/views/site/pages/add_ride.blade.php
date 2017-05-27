@extends('layouts.pages')

@section('content')
<section class="add-a-ride">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 add_ride_step">
                <!--step1-->
                <div class="add-ride">
                    <!--left side block-->
                    <div class="add-ride__container">
                        <div class="add-ride__header">
                            <div class="badge badge__big badge__green">{{trans( 'ride.one') }}</div>
                            <div class="add-ride__header-text">{{trans( 'ride.Your journey details') }}</div>
                        </div>
                        <div class="add-ride__content">
                            <form action="" onsubmit="ride.clickAddRide( this ); return false;" method="post">
                                <div class="flex-row">
                                    <label class="radio-container">
                                        <input type="radio" name="type" value="1" checked>
                                        <span class="radio">{{trans( 'ride.One-off') }}</span>
                                    </label>
                                    <label class="radio-container">
                                        <input type="radio" name="type" value="2">
                                        <span class="radio">{{trans( 'ride.Regular') }}</span>
                                    </label>
                                </div>
                                <div class="flex-row">
                                    <div class="form__field">
                                            <span class="form__addon form__addon-left">
                                                <img src="/images/ui/location-green.png" alt="">
                                            </span>
                                        <input type="text" class="form" name="from" id="ride_from" placeholder="{{trans( 'ride.From') }}">
                                        <input type="hidden" name="from_latitude" id="from_latitude" value="" />
                                        <input type="hidden" name="from_longitude" id="from_longitude" value="" />
                                        <input type="hidden" name="from_place" id="from_place" value="" />
                                        <span class="form__addon form__addon-right">
                                            <span class="caret"></span>
                                            </span>
                                        <!--<span class="invalid__msg">error msg</span>-->
                                    </div>
                                </div>
                                <div class="flex-row">
                                    <div class="form__field">
                                            <span class="form__addon form__addon-left">
                                                <img src="/images/ui/location-blue.png" alt="">
                                            </span>
                                        <input type="text" class="form" name="to" id="ride_to" placeholder="{{trans( 'ride.To') }}">
                                        <input type="hidden" name="to_latitude" id="to_latitude" value="" />
                                        <input type="hidden" name="to_longitude" id="to_longitude" value="" />
                                        <input type="hidden" name="to_place" id="to_place" value="" />
                                        <span class="form__addon form__addon-right">
                                            <span class="caret"></span>
                                        </span>
                                        <!--<span class="invalid__msg">error msg</span>-->
                                    </div>
                                </div>
                                <div class="flex-row more_city" rel="1" style="display: none;">
                                    <div class="form__field">
                                            <span class="form__addon form__addon-left">
                                                <img src="/images/ui/location-blue.png" alt="">
                                            </span>
                                        <input type="text" class="form" name="additional_1" id="ride_additional_1" placeholder="{{trans( 'ride.To') }}">
                                        <input type="hidden" name="additional_1_latitude" id="additional_1_latitude" value="" />
                                        <input type="hidden" name="additional_1_longitude" id="additional_1_longitude" value="" />
                                        <input type="hidden" name="additional_1_place" id="additional_1_place" value="" />
                                        <span class="form__addon form__addon-right">
                                            <span class="caret"></span>
                                        </span>
                                        <!--<span class="invalid__msg">error msg</span>-->
                                    </div>
                                </div>
                                <div class="flex-row more_city" rel="2" style="display: none;">
                                    <div class="form__field">
                                            <span class="form__addon form__addon-left">
                                                <img src="/images/ui/location-blue.png" alt="">
                                            </span>
                                        <input type="text" class="form" name="additional_2" id="ride_additional_2" placeholder="{{trans( 'ride.To') }}">
                                        <input type="hidden" name="additional_2_latitude" id="additional_2_latitude" value="" />
                                        <input type="hidden" name="additional_2_longitude" id="additional_2_longitude" value="" />
                                        <input type="hidden" name="additional_2_place" id="additional_2_place" value="" />
                                        <span class="form__addon form__addon-right">
                                            <span class="caret"></span>
                                        </span>
                                        <!--<span class="invalid__msg">error msg</span>-->
                                    </div>
                                </div>
                                <div class="flex-row more_city" rel="3" style="display: none;">
                                    <div class="form__field">
                                            <span class="form__addon form__addon-left">
                                                <img src="/images/ui/location-blue.png" alt="">
                                            </span>
                                        <input type="text" class="form" name="additional_3" id="ride_additional_3" placeholder="{{trans( 'ride.To') }}">
                                        <input type="hidden" name="additional_3_latitude" id="additional_3_latitude" value="" />
                                        <input type="hidden" name="additional_3_longitude" id="additional_3_longitude" value="" />
                                        <input type="hidden" name="additional_3_place" id="additional_3_place" value="" />
                                        <span class="form__addon form__addon-right">
                                            <span class="caret"></span>
                                        </span>
                                        <!--<span class="invalid__msg">error msg</span>-->
                                    </div>
                                </div>
                                <div class="flex-row more_city" rel="4" style="display: none;">
                                    <div class="form__field">
                                            <span class="form__addon form__addon-left">
                                                <img src="/images/ui/location-blue.png" alt="">
                                            </span>
                                        <input type="text" class="form" name="additional_4" id="ride_additional_4" placeholder="{{trans( 'ride.To') }}">
                                        <input type="hidden" name="additional_4_latitude" id="additional_4_latitude" value="" />
                                        <input type="hidden" name="additional_4_longitude" id="additional_4_longitude" value="" />
                                        <input type="hidden" name="additional_4_place" id="additional_4_place" value="" />
                                        <span class="form__addon form__addon-right">
                                            <span class="caret"></span>
                                        </span>
                                        <!--<span class="invalid__msg">error msg</span>-->
                                    </div>
                                </div>
                                <div class="flex-row more_city" rel="5" style="display: none;">
                                    <div class="form__field">
                                            <span class="form__addon form__addon-left">
                                                <img src="/images/ui/location-blue.png" alt="">
                                            </span>
                                        <input type="text" class="form" name="additional_5" id="ride_additional_5" placeholder="{{trans( 'ride.To') }}">
                                        <input type="hidden" name="additional_5_latitude" id="additional_5_latitude" value="" />
                                        <input type="hidden" name="additional_5_longitude" id="additional_5_longitude" value="" />
                                        <input type="hidden" name="additional_5_place" id="additional_5_place" value="" />
                                        <span class="form__addon form__addon-right">
                                            <span class="caret"></span>
                                        </span>
                                        <!--<span class="invalid__msg">error msg</span>-->
                                    </div>
                                </div>
                                <div class="flex-row">
                                    <button class="btn btn__full btn__dashed-grey add_city">{{trans( 'ride.add a city your route') }}</button>
                                </div>
                                <div class="flex-row">
                                    <div class="form__container content__space-between">
                                        <div class="form__field form__field-8">
                                            <span class="form__addon form__addon-left">
                                                <img src="/images/ui/calendar.png" alt="">
                                            </span>
                                            <input type="text" name="departure_date" class="form datepicker" placeholder="{{trans( 'ride.Departure date') }}">
                                            <span class="form__addon form__addon-right">
                                                <span class="caret"></span>
                                            </span>
                                            <!--<span class="invalid__msg">error msg</span>-->
                                        </div>
                                        <div class="form__field form__field-4">
                                        <span class="form__addon form__addon-left">
                                            <img src="/images/ui/clock.png" alt="">
                                        </span>
                                        <select class="form" name="time">
                                            <option value="">{{trans( 'ride.Time') }}</option>
                                            @foreach ( $date_time as $key => $val )
                                                <option value="{{$val}}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                        <span class="form__addon form__addon-right">
                                        <span class="caret"></span>
                                        </span>
                                            <!--<span class="invalid__msg">error msg</span>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-row">
                                    <div class="btn__container content__end">
                                        <button type="submit" class="btn btn__long-high btn__green add_ride_first_step">{{trans( 'ride.Next') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--right side block-->
                    <div class="add-ride__container">
                        <div class="add-ride__header"></div>
                        <div class="add-ride__content empty-text">
                            {!!trans( 'ride.There is no active requests from BananaCar users at this moment. Please add your ride so passenger can find you!') !!}
                        </div>
                    </div>
                </div>
                <!--step1 end-->
                <!--step2-->
                <div class="add-ride not-active">
                    <div class="add-ride__container">
                        <div class="add-ride__header">
                            <div class="badge badge__medium badge__grey">{{trans( 'ride.two') }}</div>
                            <div class="add-ride__header-text">{{trans( 'ride.Travel schedule & savings') }}</div>
                        </div>
                    </div>
                    <div class="add-ride__container">

                    </div>
                </div>
                <!--step2 end-->
            </div>
            <div class="col-lg-12 add_ride_step_2">
            </div>
        </div>
    </div>
</section>
@endsection