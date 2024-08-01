<html dir="ltr" lang="{{ App::currentLocale() }}" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="max-image-preview:large" name="robots">
    <meta name="description" content="@yield('meta_description', 'Default description')">
    <meta name="keywords" content="@yield('meta_keywords', 'Default keywords')">
    <meta name="author" content="@yield('meta_author', 'Your Name')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', 'Default Title')">
    <meta property="og:description" content="@yield('og_description', 'Default description')">
    <meta property="og:image" content="@yield('og_image', asset('default-image.jpg'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">

    <!-- Twitter -->
    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
    <meta name="twitter:title" content="@yield('twitter_title', 'Default Title')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Default description')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('default-image.jpg'))">

    <title>@yield('title', 'Blog')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[ CSS ]-->
    <link rel="stylesheet" href="{{ URL('/') }}/fontend/blog/css/app.css" rel="stylesheet">
    @stack('styles')
</head>

<body class="oGrd bD onIt onPg {{ str_contains(request()->url(), '/blog/') ? 'onIt' : 'onId' }} " id="mainCont" style="padding-right: 0px;">

    <input class="navi hidden" id="offNav" type="checkbox">
    <div class="mainWrp">

        <header class="header" id="header">
            @include('partials.blog.header')
        </header>

        <div class="mainIn">
            <div class="secIn">

                <div class="blogCont">
                    <div class="blogIn">

                        <div class="blogM">
                            <main class="blogItm mainbar">
                                @yield('content')
                            </main>

                            @if(View::hasSection('sidebar'))
                            <aside class="blogItm sidebar">
                                @yield('sidebar')
                            </aside>
                            @endif
                        
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer>
        @include('partials.blog.footer')
    </footer>
    </div>

    <div id="cookie-container"></div>

    <script src="{{ asset('/fontend/blog/js/app.js') }}"></script>
    <script src="{{ asset('/fontend/blog/js/cookie.js') }}"></script>
    <script src="{{ asset('/fontend/blog/js/simpleAjax.js') }}"></script>

    @stack('scripts')

    <!--[ Javascript disable condition ]-->
    <noscript>
        <input class='nJs hidden' id='forNoJS' type='checkbox' />
        <div class='noJs' data-text='Link4Sub - Only works with JavaScript enabled!'>
            <label for='forNoJS'></label>
        </div>
    </noscript>
    <!--[ </body> close ]-->
</body>

</html>
