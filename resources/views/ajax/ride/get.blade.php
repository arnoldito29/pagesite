@include('site.blocks.ride.user_profile')
<div class="modal__main">
    <div class="modal__title">
        <div class="trip-info__date">
            {{$ride["_departure_datetime_"]}}
        </div>
        <div class="trip-info__title-description">
            <div class="trip-info__habits">
                @if ( !empty( $ride["pet"] ) )
                <div class="habits__item habits__item-pets"></div>
                @endif
                @if ( !empty( $ride["music"] ) )
                <div class="habits__item habits__item-music"></div>
                @endif
                @if ( !empty( $ride["smoke"] ) )
                <div class="habits__item habits__item-smoke"></div>
                @endif
                @if ( !empty( $ride["food"] ) )
                <div class="habits__item habits__item-food"></div>
                @endif
                @if ( !empty( $ride["sex"] ) && $ride["sex"] == 'mix' )
                <div class="habits__item habits__item-people"></div>
                @endif
                @if ( !empty( $ride["sex"] ) && $ride["sex"] == 'girl' )
                <div class="habits__item habits__item-girl"></div>
                @endif
                @if ( !empty( $ride["sex"] ) && $ride["sex"] == 'boy' )
                <div class="habits__item habits__item-boy"></div>
                @endif
            </div>
            <div class="trip-info__description-price">
                {{$ride["_price_"]}} {{trans( 'ride.currency') }}
            </div>
        </div>
    </div>
    @if ( !empty( $ride["_locations_"] ) )
    <div class="modal__row">
        <div class="trip-info__destination">
            @foreach ( $ride["_locations_"] as $l_key => $location )
                @if ( $l_key > 0 )
                <div class="trip-info__destination-img @if ( $location["type"] != 2 && $l_key != 1 ) grey @endif"></div>
                @endif
                <div class="trip-info__destination-city @if ( $location["type"] != 0 && $location["type"] != 2)grey @endif">{{$location["_name_"]}}</div>
            @endforeach 
        </div>
    </div>
    @endif
    @if ( !empty( $ride["comment"] ) )
    <div class="modal__row">
        <div class="trip-info__desription">
            {{$ride["comment"]}}
        </div>
    </div>
    @endif
    <div class="modal__row">
        <div class="gallery__container">
            <div class="gallery__item">
                <div class="gallery__text">bla bla</div>
            </div>
            <div class="gallery__item"></div>
            <div class="gallery__item"></div>
            <div class="gallery__item"></div>
            <div class="gallery__item"></div>
            <div class="gallery__item"></div>
            <div class="gallery__item"></div>
        </div>
    </div>

    <div class="modal__row">
        <div class="modal__btn-container modal__btn-container-end">
            @if (Auth::user() && Auth::user()->id != $ride["user_id"])
            <a type="button" class="btn btn__green" data-dismiss="modal" data-target="#modalBooking" data-toggle="modal" data-href="{{ URL::route('ride/booking_form', ['id' => $ride["id"] ] ) }}">{{trans( 'ride.Book') }}</a>
            @endif
        </div>
    </div>
</div>