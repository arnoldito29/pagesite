{{--General template for pages--}}


@include('site.header.head')

<body>

@include('site.blocks.index.header')

@yield('content')

@include('site.blocks.modals')

@include('site.footer.footer')

<div id="fb-root"></div>
@include('site.blocks.js')
</body>

</html>