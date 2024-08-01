<!DOCTYPE html>
<html lang="{{ Lang::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <title>@yield('title', 'Member') - {{ $settings['web_name'] ?? env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link href='{{ URL('/') }}/images/favicon.png' rel='apple-touch-icon' sizes='120x120' />
    <link href='{{ URL('/') }}/images/favicon.png' rel='apple-touch-icon' sizes='152x152' />
    <link href='{{ URL('/') }}/images/favicon.png' rel='icon' type='image/x-icon' />
    <link href='{{ URL('/') }}/images/favicon.png' rel='shortcut icon' type='image/x-icon' />

    <!-- CSS STYLE -->
    <link href="{{ URl('/') }}/backend/dist/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ URL('/') }}/css/style.css" rel="stylesheet">
    <link href="{{ URL('/') }}/css/notyf.css" rel="stylesheet">
    <link href="{{ URL('/') }}/css/ckeditor.css" rel="stylesheet">
    @stack('styles')

    <script>
        const BASE_URL = "{{ !empty($settings['url']) ? $settings['url'] : URL('/') }}";
        const STU_URL = "{{ !empty($settings['stu_short_url']) ? $settings['stu_short_url'] : URL('/') }}";
        const STU_ALIAS_LEN = {{ !empty($settings['stu_alias_length']) ? $settings['stu_alias_length'] : 4 }};
        const NOTE_URL = "{{ !empty($settings['note_short_url']) ? $settings['note_short_url'] : URL('/') . '/note' }}";
        const NOTE_ALIAS_LEN = {{ !empty($settings['note_alias_length']) ? $settings['note_alias_length'] : 4 }};
    </script>

</head>

<body>
    <input class="cbNav hidden" id="pNav" type="checkbox" />
    <input class="cbStu hidden" id="pCreate" type="checkbox" />
    <!--[ Wrapper ]-->
    <div class="mainW">
        <!-- header -->
        @include('partials.member.header')

        <div class="mainC">

            <!-- [ Left Sidebar ] -->
            @include('partials.member.sidebar')

            <div class="container">
                @include('partials.member.breadcrumb')

                @include('partials.member.arlert')

                @yield('content')

                @include('partials.member.footer')
            </div>

            @include('partials.member.create')
        </div>
    </div>
    @include('partials.member.script')
    @stack('scripts')
</body>

</html>
