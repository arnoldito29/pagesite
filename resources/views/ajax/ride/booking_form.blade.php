@include('site.blocks.ride.user_profile')
<div class="modal__main">
    <div class="modal__title">
        {{trans( 'ride.Additional information optional') }}
    </div>
    <form action="" onsubmit="submitBookSeat( this );return false;" method="post">
        <div class="modal__row">
            <div class="textarea__container modal__textarea-container">
                <textarea class="textarea" name="comment" id="" rows="4"
                          placeholder="{{trans( 'ride.Enter the name of the region or place from where you want the driver to pick you up or ask your question about trip') }}"></textarea>
            </div>
        </div>
        <div class="modal__row">
            <div class="modal__btn-container modal__btn-container-end">
                <button type="button" class="btn btn__empty-white" data-dismiss="modal" data-target="#modalBooking-trip-info" data-toggle="modal" data-href="{{ URL::route('ride/get', ['id' => $ride["id"] ] ) }}">{{trans( 'ride.Cancel') }}</button>
                <button type="submit" class="btn btn__white">{{trans( 'ride.Confirm Booking') }}</button>
            </div>
        </div>
        <input type="hidden" name="user_id" @if (Auth::guest()) value="0" @else value="{{Auth::user()->id}}" @endif />
        <input type="hidden" name="ride_id" value="{{$ride["id"]}}" />
    </form>
</div>