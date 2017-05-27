@include('site.blocks.ride.user_profile')
<div class="modal__main">
    <div class="modal__title">
        {{trans('user.Why is it necessary to press the button to book') }}
    </div>
    <div class="modal__row">
        <div class="modal__info-block">
            <div class="modal__info-img">
                <img src="/images/ui/msg-big.png" alt="">
            </div>
            <div class="modal__info-text">
                {{trans('user.The driver will receive an SMS message with your reservation') }}
            </div>
        </div>
        <div class="modal__info-block">
            <div class="modal__info-img">
                <img src="/images/ui/gift-big.png" alt="">
            </div>
            <div class="modal__info-text">
                {{trans('user.You receive gifts from Statoil and ForumCinemas!') }}
            </div>
        </div>
        <div class="modal__info-block">
            <div class="modal__info-img">
                <img src="/images/ui/shield-check-big.png" alt="">
            </div>
            <div class="modal__info-text">
                {!! trans('user.It is safer! The system will be stored all the information about the trip') !!}
            </div>
        </div>
    </div>
    <div class="modal__row">
        <div class="modal__btn-container modal__btn-container-end">
            <button type="button" class="btn btn__empty-white">{{trans('user.Check number') }}</button>
            <button type="button" class="btn btn__white" data-dismiss="modal" data-target="#modalBooking-trip-info" data-toggle="modal" data-href="{{ URL::route('ride/get', ['id' => $ride ] ) }}">{{trans( 'ride.Book') }}</button>
        </div>
    </div>
</div>