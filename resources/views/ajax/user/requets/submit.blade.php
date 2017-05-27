<div class="modal__title">
    {{trans( 'ride.Request successfully created') }}
</div>
<div class="modal__row">
    <div class="modal-successfully-created__location-container">
        <div class="modal-successfully-created__location">{{$request_data["from"]}}<img src="/images/ui/arrow-short.png" alt="">{{$request_data["to"]}}</div>
        <div class="modal-successfully-created__date">{{$request_data["from_date"]}} - {{$request_data["to_date"]}}</div>
    </div>
</div>
<div class="modal__row">
    <div class="modal-successfully-created__text">
        {{trans( 'ride.We will inform you via sms and app if matching ride will appear.') }}
    </div>
</div>
<div class="modal__row">
    <div class="modal__btn-container modal__btn-container-center">
        <a href="" class="btn">
            <img src="/images/social/google.png" alt="">
        </a>
        <a href="" class="btn">
            <img src="/images/social/app.png" alt="">
        </a>
    </div>
</div>
<div class="modal__row">
    <div class="modal__btn-container modal__btn-container-end">
        <button type="button" class="btn btn__green" data-dismiss="modal">{{trans( 'ride.Done') }}</button>
    </div>
</div>