@if ( !empty( $messages_list ) )
    @foreach ( $messages_list as $message )
        <div class="header__infomsg ">
            <div class="header__infomsg-img ">
            </div>
            <div class="header__infomsg-info ">
                <div class="header__infomsg-title ">
                    <a href="{{ URL::route('message',[ $message->from_user_id ] ) }}" class="link">{{$message->name}} {{$message->surname}}</a>
                </div>
                <div class="header__infomsg-date ">{{$message->created_at}}</div>
                <div class="header__infomsg-text ">{{$message->short_text}}</div>
            </div>
        </div>
    @endforeach
@endif