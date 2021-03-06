<div id="modalRegistration" class="modal fade" role="dialog">
    <div class="modal-dialog modal-registration">
        <!-- Modal content-->
        <div class="modal-content modal-registration__content">
            <ul class="nav nav-tabs modal-registration__nav">
                <li class="active"><a data-toggle="tab" href="#signin">{{trans( 'modal.Sign In') }}</a></li>
                <li><a data-toggle="tab" href="#signup">{{trans( 'modal.Sign Up') }}</a></li>
            </ul>
            <button type="button" class="close btn-modal__close" data-dismiss="modal">
                <img src="/images/ui/x.png" alt="">
            </button>
            <div class="tab-content modal-registration__tab-content">
                <form id="signin" class="tab-pane fade in active modal-registration__form" method="post"
                      onsubmit="submitLogin( this ); return false;">
                    <div class="modal-registration__form-row">
                        <a href="" class="btn__social btn__social-fb">{{trans( 'modal.Sign in with Facebook') }}</a>
                    </div>
                    <div class="modal-registration__form-row">
                        <a href="" class="btn__social btn__social-g">{{trans( 'modal.Sign in with Google') }}</a>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="divider__container">
                            <span class="divider divider-left"></span>
                            <span class="divider-center">{{trans( 'modal.or') }}</span>
                            <span class="divider divider-right "></span>
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="modal-registration__title">
                            {{trans( 'modal.Sign in title') }}
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="form__field">
                            <input type="email" id="login_email" name="email" class="form"
                                   placeholder="{{trans( 'modal.Email placeholder') }}">
                            <span class="invalid__msg"></span>
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="form__field">
                            <input type="password" id="login_password" name="password" class="form"
                                   placeholder="{{trans( 'modal.Password login placeholder') }}">
                            <span class="invalid__msg"></span>
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="modal-registration__btn-container">
                            <a href=""
                               class="btn btn__modals btn__modals-forgot">{{trans( 'modal.Forgot password') }}</a>
                            <button type="submit"
                                    class="btn btn__modals btn__modals-sign-in btn__green login_button">{{trans( 'modal.Sign in button') }}</button>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                </form>
                <form id="signup" class="tab-pane fade modal-registration__form" method="post"
                      onsubmit="submitRegister( this ); return false;">
                    <div class="modal-registration__form-row">
                        <a href="" class="btn__social btn__social-fb">{{trans( 'modal.Sign in with Facebook') }}</a>
                    </div>
                    <div class="modal-registration__form-row">
                        <a href="" class="btn__social btn__social-g">{{trans( 'modal.Sign in with Google') }}</a>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="divider__container">
                            <span class="divider divider-left"></span>
                            <span class="divider-center">{{trans( 'modal.or') }}</span>
                            <span class="divider divider-right "></span>
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="modal-registration__title">
                            {{trans( 'modal.Register title') }}
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <label class="radio-container">
                            <input type="radio" name="sex" value="m" checked>
                            <span class="radio">{{trans( 'modal.Male') }}</span>
                        </label>
                        <label class="radio-container">
                            <input type="radio" name="sex" value="w">
                            <span class="radio">{{trans( 'modal.Female') }}</span>
                        </label>
                    </div>
                    <div class="modal-registration__form-row content__space-between">
                        <div class="form__field form__field-6">
                            <input type="text" name="name" id="register_name" class="form"
                                   placeholder="{{trans( 'modal.Name placeholder') }}">
                            <span class="invalid__msg"></span>
                        </div>
                        <div class="form__field form__field-6">
                            <input type="text" name="surname" id="register_surname" class="form"
                                   placeholder="{{trans( 'modal.Surname placeholder') }}">
                            <span class="invalid__msg"></span>
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="form__field">
                            <input type="text" name="email" id="register_email" class="form"
                                   placeholder="{{trans( 'modal.Email placeholder') }}">
                            <span class="invalid__msg"></span>
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="form__field">
                            <input type="password" name="password" id="register_password" class="form"
                                   placeholder="{{trans( 'modal.Password placeholder') }}">
                            <span class="invalid__msg"></span>
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="form__field">
                            <input type="password" name="confirm_password" id="register_confirm_password" class="form"
                                   placeholder="{{trans( 'modal.Confirm placeholder') }}">
                            <span class="invalid__msg"></span>
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="form__field">
                            <select class="form" name="birth" id="register_birth">
                                <option>{{trans( 'modal.birthday') }}</option>
                                @foreach ( $years as $year )
                                    <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                            <span class="form__addon form__addon-right">
                                <span class="caret"></span>
                            </span>
                        </div>
                    </div>
                    <div class="modal-registration__form-row">
                        <button type="submit"
                                class="btn btn__modals btn__modals-sign-up btn__green">{{trans( 'modal.Sign up button') }}</button>
                    </div>
                    <div class="modal-registration__form-row">
                        <div class="modal-registration__text">{{trans( 'modal.signing up you accept') }} <a
                                    href="{{trans( 'modal.Privacy Policy url') }}">{{trans( 'modal.Privacy Policy') }}</a>.
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                </form>
            </div>
        </div>

    </div>
</div>

<div id="modalRequest-of-a-ride" class="modal fade" role="dialog">
    <div class="modal-dialog modal-request">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close btn-modal__close" data-dismiss="modal">
                <img src="/images/ui/x.png" alt="">
            </button>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<div id="modalBooking" class="modal fade" role="dialog">
    <div class="modal-dialog modal-booking">
        <!-- Modal content-->
        <div class="modal-content modal-booking__content">
            <button type="button" class="close btn-modal__close" data-dismiss="modal">
                <img src="/images/ui/x.png" alt="">
            </button>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<div id="modalBooking-check-number" class="modal fade" role="dialog">
    <div class="modal-dialog modal-booking modal-booking__check-number">
        <!-- Modal content-->
        <div class="modal-content modal-booking__content">
            <button type="button" class="close btn-modal__close" data-dismiss="modal">
                <img src="/images/ui/x.png" alt="">
            </button>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<div id="modalBooking-trip-info" class="modal fade" role="dialog">
    <div class="modal-dialog modal-booking modal-booking__trip-info">
        <!-- Modal content-->
        <div class="modal-content modal-booking__content">
            <button type="button" class="close btn-modal__close" data-dismiss="modal">
                <img src="/images/ui/x.png" alt="">
            </button>
            <div class="modal__aside">
                <div class="modal__row">
                    <div class="aside__img">
                        <a href="" class="link">
                            <img src="/images/background-images/user.png" alt="ad">
                        </a>
                    </div>
                </div>
                <div class="modal__row">
                    <div class="aside__user-name">
                        <a href="" class="link">Neringa Andriukaitytė</a>
                    </div>
                    <div class="aside__user-rating">
                        <div class="star-rating__container">
                            <div class="star-rating star-rating__2"></div>
                        </div>
                        <div class="star-rating__count">
                            2.0
                        </div>
                        <div class="star-rating__reviews">
                            (0 reviews)
                        </div>
                    </div>
                </div>
                <div class="modal__row content__center">
                    <div class="trip-info__habits ">
                        <div class="habits__item habits__item-pets"></div>
                        <div class="habits__item habits__item-music"></div>
                        <div class="habits__item habits__item-smoke"></div>
                        <div class="habits__item habits__item-food"></div>
                    </div>
                </div>
                <div class="modal__row">
                    <div class="aside__user-car">
                        <strong>Audi A4</strong> 1998
                    </div>
                    <div class="aside__user-phone link">
                        <div class="aside__user-phone-number">
                            +380503482073
                        </div>
                        <div class="aside__user-phone-reveal">
                            (Reveal phone number)
                        </div>
                    </div>
                    <div class="aside__user-social aside__user-social-fb">
                        486 friends on <a href="" class="link">Facebook</a>
                    </div>
                </div>
                <div class="modal__row content__center">
                    <button class="btn btn__blue btn__with-addon-left">
                        <span class="btn__addon btn__addon-msg-blue"></span>
                        Send message
                    </button>
                </div>

            </div>
            <div class="modal__main">
                <div class="modal__title">
                    <div class="trip-info__date">
                        December 28, 18:00
                    </div>
                    <div class="trip-info__title-description">
                        <div class="trip-info__habits">
                            <div class="habits__item habits__item-people-blue"></div>
                        </div>
                        <div class="trip-info__description-price">
                            100 &euro;
                        </div>
                    </div>
                </div>
                <div class="modal__row">
                    <div class="trip-info__destination">
                        <div class="trip-info__destination-city">Vilnius</div>
                        <div class="trip-info__destination-img"></div>
                        <div class="trip-info__destination-city grey">Elektrėnai</div>
                        <div class="trip-info__destination-img"></div>
                        <div class="trip-info__destination-city">Kaunas</div>
                        <div class="trip-info__destination-img grey"></div>
                        <div class="trip-info__destination-city grey">Klaipėda</div>
                    </div>
                </div>
                <div class="modal__row">
                    <div class="trip-info__desription">
                        Laikas derinimas, geriausia jog susisiektumete nr.:860024018
                    </div>
                </div>

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
                        <button type="button" class="btn btn__green" data-dismiss="modal">Book</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>