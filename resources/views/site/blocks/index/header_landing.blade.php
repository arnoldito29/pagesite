<header class="header header__sticky-landing" id="header__sticky">
    <div class="container">
        <div class="row">
            <div class="header__top-menu">
                <div class="logo">
                    <a href="{{ URL::route('home') }}">
                        <img src="/images/header/logo-small-header.png" alt="logo banana car" class="logo-img">
                    </a>
                </div>
                @include('site.blocks.login_langs')
            </div>
        </div>
    </div>
</header>
<div class="header header-landing">
    <div class="container">
        <div class="row">
            <div class="header__top-menu">
                <div class="logo">
                    <a href="{{ URL::route('home') }}">
                        <img src="/images/header/logo.png" alt="{trans( 'index.Logo title') }}" class="logo-img">
                    </a>
                </div>
                @include('site.blocks.login_langs')
            </div>
            <div class="col-lg-12">
                @include('site.blocks.index.intro')
            </div>
        </div>
    </div>
</div>