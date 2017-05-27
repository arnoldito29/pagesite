<header class="header header__sticky">
    <div class="container">
        <div class="row">
            <div class="header__top-menu">
                <div class="logo">
                    <a href="{{ URL::route('home') }}">Home</a>
                </div>
                @include('site.blocks.login_langs')
            </div>
        </div>
    </div>
</header>