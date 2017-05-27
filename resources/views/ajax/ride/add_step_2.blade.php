
<div class="add-ride add-ride__step-finished">
    <!--left side block-->
    <div class="add-ride__container">
        <div class="add-ride__header">
            <div class="badge badge__big badge__white">{{trans( 'ride.one') }}</div>
            <div class="add-ride__header-text">{{trans( 'ride.Your journey details') }}</div>
        </div>
    </div>
    <!--right side block-->
    <div class="add-ride__container">
        <div class="add-ride__header content__end">
            <button class="btn btn__long-high btn__empty-white">{{trans( 'ride.Edit') }}</button>
        </div>
    </div>
</div>
<!--step1 end-->

<!--step2-->
<div class="add-ride">
    <div class="add-ride__container">
        <div class="add-ride__header">
            <div class="badge badge__big badge__green">{{trans( 'ride.two') }}</div>
            <div class="add-ride__header-text">{{trans( 'ride.Travel schedule & savings') }}</div>
        </div>
        <div class="add-ride__content">
            <div class="flex-row">
                <div class="calendar">
                    <input type="text" id="calendar">
                </div>
            </div>
            <div class="flex-row">
                <div class="flex-container">
                    <div class="flex-row add-ride__title">
                        {{trans( 'ride.Departure time') }}
                    </div>
                <div class="form__field form__field-8">
                    <span class="form__addon form__addon-left">
                        <img src="/images/ui/clock.png" alt="">
                    </span>
                    <select class="form" name="departure_time">
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
                <div class="flex-container">
                    <div class="flex-row add-ride__title">
                        {{trans( 'ride.Return time') }}
                    </div>
                    <div class="form__field form__field-8">
                        <span class="form__addon form__addon-left">
                            <img src="/images/ui/clock.png" alt="">
                        </span>
                        <select class="form" name="return_time">
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
                <div class="flex-container">
                    {{trans( 'ride.Return journey') }}
                    <div class="flipswitch">
                        <input type="checkbox" name="flipswitch" class="flipswitch-cb"
                               id="returnJourney" checked="">
                        <label class="flipswitch-label" for="returnJourney">
                            <div class="flipswitch-inner"></div>
                            <div class="flipswitch-switch"></div>
                        </label>
                    </div>
                </div>
                <div class="flex-container">
                    {{trans( 'ride.Same dates as above') }}
                    <div class="flipswitch">
                        <input type="checkbox" name="flipswitch" class="flipswitch-cb" id="sameDates">
                        <label class="flipswitch-label" for="sameDates">
                            <div class="flipswitch-inner"></div>
                            <div class="flipswitch-switch"></div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex-row">
                <div class="calendar">
                    <input type="text" id="calendar2">
                </div>
            </div>


        </div>
    </div>
    <div class="add-ride__container">
        <div class="add-ride__header"></div>
        <div class="add-ride__content add-ride__content-grey">
            <div class="flex-row add-ride__title">
                {{trans( 'ride.Suggested contribution per passenger') }}
            </div>
            <div class="flex-row">
                <label class="checkbox__container">
                    <input type="checkbox" name="">
                    <span class="checkbox">{{trans( 'ride.Free') }}</span>
                </label>
            </div>
            <div class="flex-row content__space-between">
                <div class="ride-list__container-inline">
                    <div class="ride-list__location">
                        Vilnus
                        <img src="/images/ui/arrow-short.png" alt="">
                        <span class="in-between">Kaunus</span>
                    </div>
                </div>
                <div class="form__field form__field-count">
                    <button type="button"
                            class=" btn form__addon form__addon-left form__dec"><img
                            src="/images/ui/minus.png" alt=""></button>
                    <span class="form__count">1</span>
                    <button type="button"
                            class="btn form__addon form__addon-right form__inc"><img
                            src="/images/ui/plus.png" alt=""></button>
                </div>
            </div>
            <div class="flex-row content__space-between">
                <div class="ride-list__container-inline">
                    <div class="ride-list__location">
                        <span class="in-between">Kaunus</span>
                        <img src="/images/ui/arrow-short.png" alt="">
                        Klaipeda
                    </div>
                </div>
                <div class="form__field form__field-count">
                    <button type="button"
                            class=" btn form__addon form__addon-left form__dec"><img
                            src="/images/ui/minus.png" alt=""></button>
                    <span class="form__count">1</span>
                    <button type="button"
                            class="btn form__addon form__addon-right form__inc"><img
                            src="/images/ui/plus.png" alt=""></button>
                </div>
            </div>
            <div class="flex-row content__space-between">
                <div class="ride-list__container-inline">
                    <div class="ride-list__location">
                        Vilnus
                        <img src="/images/ui/arrow-short.png" alt="">
                        Klaipeda
                    </div>
                </div>
                <div class="ride__total">
                    2
                </div>
            </div>
            <!-- remove payment methods
            <div class="flex-row add-ride__title">
                Receive your contribution <a href="#" class="info">i</a>
            </div>
            <div class="flex-row content__space-between">
                <div class="add-ride__contribution-container">
                    <label class="checkbox__container contribution__checkbox checked">
                        <input type="checkbox" name="" checked>
                        <span class="checkbox">Cash</span>
                    </label>
                    <div class="contribution__text">
                        Get paid in cash or alternate the driving
                    </div>
                </div>
                <div class="add-ride__contribution-container">
                    <label class="checkbox__container contribution__checkbox">
                        <input type="checkbox" name="">
                        <span class="checkbox">Online payment</span>
                    </label>
                    <div class="contribution__text">
                        Easy, safe, secure
                    </div>
                </div>

            </div>
            -->
        </div>
        <div class="add-ride__content">
            <div class="flex-row add-ride__title">
                {{trans( 'ride.Car Available seats') }}
            </div>
            <div class="flex-row">
                <div class="form__container content__space-between">
                    <div class="form__field form__field-8">
                        <span class="form__addon form__addon-left">
                            <img src="/images/ui/car-grey.png" alt="">
                        </span>
                        <select class="form" name="car">
                            @foreach ( $cars as $key => $val )
                                <option value="{{$val["id"]}}">{{$val["car_brand"]}} {{$val["car_model"]}} @if($val["years"]) {{$val["years"]}} @endif @if( !empty( $val["_colors_name_"] )) ({{$val["_colors_name_"]}}) @endif</option>
                            @endforeach
                        </select>
                        <span class="form__addon form__addon-right">
                            <span class="caret"></span>
                        </span>
                        <!--<span class="invalid__msg">error msg</span>-->
                    </div>
                    <div class="form__field form__field-3">
                    <span class="form__addon form__addon-left">
                        <img src="/images/ui/seats.png" alt="">
                    </span>
                    <select class="form" name="seats">
                        <option value="">{{trans( 'ride.Seats') }}</option>
                        @foreach ( $seats as $key => $val )
                            <option value="{{$val}}">{{$val}}</option>
                        @endforeach
                    </select>
                        <span class="form__addon form__addon-right">
                        <span class="caret"></span>
                    </span>
                        <!--<span class="invalid__msg">error msg</span>-->
                    </div>
                    <a href="" class="add-ride__info">
                        <img src="/images/ui/two-back-seats-grey.png" alt="">
                    </a>
                </div>
            </div>
            <div class="flex-row add-ride__title">
                {{trans( 'ride.Any further details') }}
            </div>
            <div class="flex-row">
                <div class="textarea__container">
                    <textarea name="name" class="textarea"></textarea>
                </div>
            </div>
            <div class="flex-row alignself__end">
                <div class="btn__container content__end">
                    <button class="btn btn__green btn__long-high">{{trans( 'ride.Post journey') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function(){
    var calendar = flatpickr("#calendar", {
      inline: true
    });
    var calendar2 = flatpickr("#calendar2", {
      inline: true
    });
  });
</script>