@if ( empty( $rides ) )
    <div class="find__container find__container-right find__container-grey">
        <div class="find__noresults-container">
            <div class="noresults__title">{{trans( 'ride.no result title') }}</div>
            <div class="noresults__img"></div>
        </div>
    </div>
@else
    <div class="find__container find__container-right">
        <div class="find__title">
            <button class="btn find__btn-left ride_search_buttons" rel="{{$data["prev_date"]}}" type="button" @if ( empty( $data["prev_date"] ) )disabled @endif></button>
            <div class="find__location-container">
                <div class="find__location">{{$data["from"]["_name_"]}}<img src="/images/ui/arrow-short.png" alt="">{{$data["to"]["_name_"]}}</div>
                <div class="find__date">{{$data["change_date"]}}</div>
            </div>
            <button class="btn find__btn-right ride_search_buttons" rel="{{$data["next_date"]}}" type="button" @if ( empty( $data["next_date"] ) )disabled @endif></button>
        </div>
        <ul class="fade__container">
            @foreach ($rides as $ride)
                @include('site.blocks.ride.item', ['ride' => $ride ])
            @endforeach
        </ul>
    </div>
@endif