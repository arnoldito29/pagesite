<div class="modal__title">
    {{trans( 'ride.Request of a ride') }}
</div>
<form method="post" onsubmit="requestFormSubmit( this ); return false;" action="">
    <div class="modal__row">
        <div class="form__field">
            <span class="form__addon form__addon-left">
                <img src="/images/ui/location-green.png" alt="">
            </span>
            <input type="text" class="form"  name="popup_from" id="ride_popup_from" placeholder="{{trans( 'ride.Leaving from') }}">
            <input type="hidden" name="from_latitude" id="popup_from_latitude" value="" />
            <input type="hidden" name="from_longitude" id="popup_from_longitude" value="" />
            <input type="hidden" name="from_place" id="popup_from_place" value="" />
            <span class="form__addon form__addon-right">
                <span class="caret"></span>
            </span>
        </div>
    </div>
    <div class="modal__row">
        <div class="form__field">
            <span class="form__addon form__addon-left">
                <img src="/images/ui/location-blue.png" alt="">
            </span>
            <input type="text" class="form"  name="popup_to" id="ride_popup_to" placeholder="{{trans( 'ride.Going to') }}">
            <input type="hidden" name="to_latitude" id="popup_to_latitude" value="" />
            <input type="hidden" name="to_longitude" id="popup_to_longitude" value="" />
            <input type="hidden" name="to_place" id="popup_to_place" value="" />
            <span class="form__addon form__addon-right">
                <span class="caret"></span>
            </span>
        </div>
    </div>
    <div class="modal__row">
        <div class="form__field form__field-8">
            <span class="form__addon form__addon-left">
                <img src="/images/ui/calendar.png" alt="">
            </span>
            <input type="text" class="form datepicker"  name="popup_to" id="popup_ride_date" placeholder="{{trans( 'ride.From:') }}">
            <span class="form__addon form__addon-right">
                <span class="caret"></span>
            </span>
        </div>
        <div class="form__field form__field-4">
            <span class="form__addon form__addon-left">
                <img src="/images/ui/clock.png" alt="">
            </span>
            <select class="form" name="popup_time_from">
                @foreach ( $date_time as $key => $val )
                    <option value="{{$val}}">{{$val}}</option>
                @endforeach
            </select>
            <span class="form__addon form__addon-right">
                <span class="caret"></span>
            </span>
        </div>
    </div>
    <div class="modal__row">
        <div class="form__field form__field-8">
            <span class="form__addon form__addon-left">
                <img src="/images/ui/calendar.png" alt="">
            </span>
            <input type="text" class="form datepicker"  name="popup_date_to" id="popup_ride_date_to" placeholder="{{trans( 'ride.To:') }}">
            <span class="form__addon form__addon-right">
                <span class="caret"></span>
            </span>
        </div>
        <div class="form__field form__field-4">
            <span class="form__addon form__addon-left">
                <img src="/images/ui/clock.png" alt="">
            </span>
            <select class="form" name="popup_time_to">
                @foreach ( $date_time as $key => $val )
                    <option value="{{$val}}" @if( $key == '23:45') selected @endif >{{$val}}</option>
                @endforeach
            </select>
            <span class="form__addon form__addon-right">
                <span class="caret"></span>
            </span>
        </div>
    </div>
    <div class="modal__row">
        <div class="modal__btn-container modal__btn-container-end">
            <button type="submit" class="btn btn__green" >{{trans( 'ride.Leave request') }}</button>
            <input type="hidden" name="user_id" @if (Auth::user() ) value="{{Auth::user()->id}}" @else value="0" @endif />
        </div>
    </div>
</form>