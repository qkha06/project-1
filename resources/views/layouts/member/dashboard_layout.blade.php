@php extract($data) @endphp

<!DOCTYPE html>
<html lang="{{ Lang::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}} - Link4Sub</title>
    <meta name="keywords" content="sub2unlock, sub2unlock link, sub unlock, subscribe to unlock link, sub to unlock, sub 2 unlock, sub4 unlock net, sub4unlock, subfor unlock net, unlock link, unlock, link, sub, to unlock, subscribe, unlock net, subfor, sub3unlock, Link4Sub.com, link locker, content locking, subscribe for access, unlock with subscription, locked content, đăng ký để mở khoá, khoá nội dung, đăng ký để tải xuống, subscribe download, link4sub, subunlock, unlock link, url shortener, social unlock">

    <!-- Favicon -->
    <link href='{{ URL('/') }}/images/favicon.png' rel='apple-touch-icon' sizes='120x120'/>
    <link href='{{ URL('/') }}/images/favicon.png' rel='apple-touch-icon' sizes='152x152'/>
    <link href='{{ URL('/') }}/images/favicon.png' rel='icon' type='image/x-icon'/>
    <link href='{{ URL('/') }}/images/favicon.png' rel='shortcut icon' type='image/x-icon'/>  
    
    <!-- Open Graph Tag --->
    <meta property='og:url' content='{{ URL('/') }}' />
    <meta property="og:type" content="Website" />
    <meta property="og:title" content="Link4Sub.com - Best Money Making Link Locking Service"/>
    <meta property="og:description" content="Mô tả" />
    <meta property="og:image" content="{{ URL('/') }}/images/banner.png" />
    <meta property="og:site_name" content="Link4Sub" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="link4sub">
    <meta name="twitter:title" content="Link4Sub.com - Best Money Making Link Locking Service">
    <meta name="twitter:description" content="Mô tả">
    <meta name="twitter:image" content="{{ URL('/') }}/images/banner.png">

    <!-- Others -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL('/') }}/images/favicon.png">
    <link rel="shortcut icon" href="{{ URL('/') }}/images/favicon.png">
    <meta name="apple-mobile-web-app-title" content="Link4Sub.com">
    <meta name="application-name" content="Link4Sub.com">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS STYLE -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        .stu_ftr_inp label[data-group=g_sty] div {
            padding: 0 8px 0 52px !important;
            height: 44px;
        }
        #i_sty {
            width: 100%;
            height: 100%;
            font-size: 16px !important;
            background: transparent;
            border: 0;
        }
        .ck-powered-by-balloon {
            display: none !important
        }


    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL('/') }}/css/style.css">
    <link rel="stylesheet" href="{{ URL('/') }}/css/notyf.css">
    <link rel="stylesheet" href="{{ URL('/') }}/css/ckeditor.css">
    @if(isset($config['css']) && is_array($config['css']))
        @foreach($config['css'] as $key => $val)
            {!! '<link rel="stylesheet" href="'.$val.'"></script>' !!}
        @endforeach
    @endif
    <script src="{{ URL('/') }}/js/notyf.js"></script>

    <script src="{{ URL('/') }}/js/ckeditor/ckeditor.js"></script>
    <script src="{{ URL('/') }}/js/ckeditor/translations/{{ Lang::getLocale() }}.js"></script>

    <script>
        const BASE_URL = "{{ !empty($settings['url']) ? $settings['url'] : URL('/') }}";
        const STU_URL = "{{ !empty($settings['stu_short_url']) ? $settings['stu_short_url'] : URL('/') }}";
        const STU_ALIAS_LEN = {{ !empty($settings['stu_alias_length']) ? $settings['stu_alias_length'] : 4 }};
        const NOTE_URL = "{{ !empty($settings['note_short_url']) ? $settings['note_short_url'] : URL('/').'/note' }}";
        const NOTE_ALIAS_LEN = {{ !empty($settings['note_alias_length']) ? $settings['note_alias_length'] : 4 }};
    </script>

</head>

<body>
    <input class="cbNav hidden" id="pNav" type="checkbox" />
    <input class="cbStu hidden" id="pCreate" type="checkbox" />
    <!--[ Wrapper ]-->
    <div class="mainW">
        <!-- header -->
        @include('blocks.member.header')
        <div class="mainC">
            <!-- [ Left Sidebar ] -->
            @include('blocks.member.sidebar')

            <div class="container">
                @include('backend.member.blocks.breadcrumb')

                @if ($errors->any())
                <p class="note wr">{{ $errors->all()[0] }}</p>
                @endif  
                @if (session('success'))
                    <p class="note">{{ session('success') }}</p>
                @endif

                @include('backend.member.dashboard.'.$content)
                <style>
                    .create-container {
                        display: flex;
                        justify-content: center;
                        gap: 20px;
                    }
                    .create-card {
                        width: 100%;
                        height: auto;
                        border: 1px solid var(--border-color);
                        border-radius: 12px;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        padding: 20px;
                    }
                    .create-card .i {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border: 1px solid var(--border-color);
                        border-radius: 50%;
                        padding: 25px;
                        height: 150px;
                        width: 150px;
                        margin-bottom: 30px;
                    }
                    .create-card .i svg {
                        height: 100%;
                        width: 100%;
                        stroke: #0a8800;
                    }
                    .create-card .t {
                        font-size: 22px;
                        font-weight: bold;
                    }
                    .create-card .d {
                        text-align: center;
                        height: 75px;
                    }
                    .create-card .b {
                        width: 100%;
                        background: #0e4bf1;
                        color: white;
                        border-radius: 10px;
                        padding: 10px 0;
                        text-align: center;
                        transition: all 0.1s;
                        margin-top: 20px;
                        cursor: pointer;
                   
                    }
                    .create-card .b:hover {
                        opacity: 0.8;
                    }
                    .create-card .o {
                        margin-top: 10px
                    }

                    @media screen and (max-width: 756px)
                    {
                        .create-container {
                            display: grid;
                        }
                    }


                    /* .create-panel .panel-stu, .create-panel .panel-note {
                        display: none;
                    } */

                    #forSTU:checked ~ .create-container {
                        display: none;
                    }
                    #forNOTE:checked ~ .create-container {
                        display: none;
                    }
                    #forSTU:checked ~ .create-panel .panel-stu {
                        display: block;
                    }
                    #forNOTE:checked ~ .create-panel .panel-note {
                        display: block;
                    }

                    .stu-container-tabs {

                        
                        
                    }
                    button {
                        font: 500 20px Poppins, sans-serif;
                    }

                    .stu-tabs {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: #eee;
                        border-radius: 10px;
                        position: relative;
                        margin: 10px auto 35px auto;
                        max-width: 450px;
                    }
                    .stu-tabs button {
                        width: 49.9%;
                        background: transparent;
                        border: none;
                        padding: 12px 10px;
                        font-size: 16px;
                        cursor: pointer;
                        z-index: 2;
                    }
                    .stu-tabs .active {
                        background: white;
                        height: calc(100% - 10px);
                        width: calc(50% - 10px);
                        position: absolute;
                        top: 5px;
                        left: 0;
                        transform: translateX(5px);
                        border-radius: inherit;
                        box-shadow: 0 2px 2px #ccc;
                        transition: all 200ms;
                    }
                    .stu-container-tabs .stuContainer, .stu-container-tabs .noteContainer {
                        display: none
                    }
                    .stu-tabs.tbnote ~ .stu-tab-ctns .noteContainer {
                        display: block
                    }
                    .stu-tabs.tbstu ~ .stu-tab-ctns .stuContainer {
                        display: block
                    }

                </style>
                <input class="hidden" id="forCreate" type="checkbox" />
                <div class="popUp create"> 
                    <div class="popIn">
                        <div class="popC">
                            <div class="popH">
                                <div class="t">Tạo mới</div>
                                <label class="c" for="forCreate"></label>
                            </div>
                            <div class="popB">
                                <div class="c">
            
                                    <div class="create-panel">
                                        <div class="panel-stu">
                                            <div class="stu-container-tabs">
                                                <div class="stu-tabs tbstu">
                                                    <div class="active"></div>
                                                    <button name-tab="tbstu" class="a">STU</button>
                                                    <button name-tab="tbnote">NOTE</button>
                                                </div>
                                                <div class="stu-tab-ctns">
                                                    <div class="stuContainer">
                                                        <div class="stu_cnt" id="CREATE_STU"></div>
                                                    </div>
                                                    <div class="noteContainer">
                                                        <div class="stu_cnt" id="CREATE_NOTE"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <script>
                                                const btns = document.querySelectorAll(".stu-tabs button");
                                                const active = document.querySelector(".stu-tabs .active");

                                                for (let i = 0; i < btns.length; i++) {
                                                    btns[i].onclick = function () {
                                                        btns.forEach(btn => {
                                                            if (btn.classList.contains('a')) {
                                                                btn.classList.remove('a');
                                                                btn.parentNode.classList.remove(btn.getAttribute('name-tab'));
                                                            }
                                                        })
                                                        btns[i].classList.add('a');
                                                        btns[i].parentNode.classList.add(btns[i].getAttribute('name-tab'));
                                                        let move = (100 / btns.length) * i;
                                                        active.style.left = move + "%";
                                                    };
                                                }
                                            </script>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="fc" for="forCreate"></label>
                </div>
                @include('blocks.member.footer')
            </div>

</div>
</div>

<!-- SCRIPT !-->
<script>
    const STUtxt = {
        'ttl_ph': '{{__('stu.ttl_ph')}}',
        'sttl_ph': '{{__('stu.sttl_ph')}}',

        'yt1_n': 'Subscribe',
        'yt1_ph': '{{__('stu.yt1_ph')}}', 
        'yt2_n': 'Subscribe #2',
        'yt2_ph': '{{__('stu.yt2_ph')}}',
        'yt3_n': 'Subscribe #3',
        'yt3_ph': '{{__('stu.yt3_ph')}}',

        'ytl1_n': 'Like',
        'ytl1_ph': '{{__('stu.ytl1_ph')}}',
        'ytl2_n': 'Like #2',
        'ytl2_ph': '{{__('stu.ytl2_ph')}}',
        'ytl3_n': 'Like #3',
        'ytl3_ph': '{{__('stu.ytl3_ph')}}',

        'ytc1_n': 'Comment',
        'ytc1_ph': '{{__('stu.ytc1_ph')}}',
        'ytc2_n': 'Comment #2',
        'ytc2_ph': '{{__('stu.ytc2_ph')}}',

        'tg1_n': 'Join Group',
        'tg1_ph': '{{__('stu.tg1_ph')}}',
        'tg2_n': 'Join Group #2',
        'tg2_ph': '{{__('stu.tg2_ph')}}',
        'tg3_n': 'Join Group #3',
        'tg3_ph': '{{__('stu.tg3_ph')}}',

        'tk1_n': 'Follow',
        'tk1_ph': '{{__('stu.tk1_ph')}}',
        'tk2_n': 'Follow #2',
        'tk2_ph': '{{__('stu.tk2_ph')}}',
        'tk3_n': 'Follow #3',
        'tk3_ph': '{{__('stu.tk3_ph')}}',

        'tkl1_n': 'Like',
        'tkl1_ph': '{{__('stu.tkl1_ph')}}',
        'tkl2_n': 'Like #2',
        'tkl2_ph': '{{__('stu.tkl2_ph')}}',
        'tkl3_n': 'Like #3',
        'tkl3_ph': '{{__('stu.tkl3_ph')}}',

        'ig1_n': 'Follow',
        'ig1_ph': '{{__('stu.ig1_ph')}}',
        'ig2_n': 'Follow #2',
        'ig2_ph': '{{__('stu.ig2_ph')}}',
        'ig3_n': 'Follow #3',
        'ig3_ph': '{{__('stu.ig3_ph')}}',

        'igl1_n': 'Like',
        'igl1_ph': '{{__('stu.igl1_ph')}}',
        'igl2_n': 'Like #2',
        'igl2_ph': '{{__('stu.igl2_ph')}}',
        'igl3_n': 'Like #3',
        'igl3_ph': '{{__('stu.igl3_ph')}}',

        'fb1_n': 'Follow',
        'fb1_ph': '{{__('stu.fb1_ph')}}',
        'fb2_n': 'Follow #2',
        'fb2_ph': '{{__('stu.fb2_ph')}}',
        'fb3_n': 'Follow #3',
        'fb3_ph': '{{__('stu.fb3_ph')}}',

        'fbl1_n': 'Like',
        'fbl1_ph': '{{__('stu.fbl1_ph')}}',
        'fbl2_n': 'Like #2',
        'fbl2_ph': '{{__('stu.fbl2_ph')}}',
        'fbl3_n': 'Like #3',
        'fbl3_ph': '{{__('stu.fbl3_ph')}}',

        'dc1_n': 'Join',
        'dc1_ph': '{{__('stu.dc1_ph')}}',
        'dc2_n': 'Join #2',
        'dc2_ph': '{{__('stu.dc2_ph')}}',
        'dc3_n': 'Join #3',
        'dc3_ph': '{{__('stu.dc3_ph')}}',

        'ct1_n': '{{__('stu.ct1_n')}}',
        'ct1_ph': '{{__('stu.ct1_ph')}}',
        'ct1t_ph': '{{__('stu.ct1t_ph')}}',
        'ct2_n': '{{__('stu.ct2_n')}}',
        'ct2_ph': '{{__('stu.ct2_ph')}}',
        'ct2t_ph': '{{__('stu.ct2t_ph')}}',
        'ct3_n': '{{__('stu.ct3_n')}}',
        'ct3_ph': '{{__('stu.ct3_ph')}}',
        'ct3t_ph': '{{__('stu.ct3t_ph')}}',

        'lnk1_n': '{{__('stu.lnk1t_n')}}',
        'lnk1_ph': '{{__('stu.lnk1_ph')}}',
        'lnk1t_ph': '{{__('stu.lnk1t_ph')}}',
        'lnk2_n': '{{__('stu.lnk2_n')}}',
        'lnk2_ph': '{{__('stu.lnk2_ph')}}',
        'lnk2t_ph': '{{__('stu.lnk2t_ph')}}',
        'lnk3_n': '{{__('stu.lnk3_n')}}',
        'lnk3_ph': '{{__('stu.lnk3_ph')}}',
        'lnk3t_ph': '{{__('stu.lnk3t_ph')}}',
        'lnk4_n': '{{__('stu.lnk4_n')}}',
        'lnk4_ph': '{{__('stu.lnk4_ph')}}',
        'lnk4t_ph': '{{__('stu.lnk4t_ph')}}',
        'lnk5_n': '{{__('stu.lnk5_n')}}',
        'lnk5_ph': '{{__('stu.lnk5_ph')}}',
        'lnk5t_ph': '{{__('stu.lnk5t_ph')}}',

        'pwd_n': '{{__('stu.pwd_n')}}',
        'not_n': '{{__('stu.not_n')}}',
        'sty_n': '{{__('stu.sty_n')}}',
        'exp_n': '{{__('stu.exp_n')}}',
        'thmb_n': '{{__('stu.thmb_n')}}',
        'pwd_ph': '{{__('stu.pwd_ph')}}',
        'not_ph': '{{__('stu.not_ph')}}',
        'sty_ph': '{{__('stu.sty_ph')}}',
        'exp_ph': '{{__('stu.exp_ph')}}',
        'thmb_ph': '{{__('stu.thmb_ph')}}',

        'lv_lb': '{{__('stu.lv_lb')}}',

        'create_link': '{{__('stu.create_link')}}',
        'reset': '{{__('stu.reset')}}',
    };

    document.addEventListener("DOMContentLoaded", function () {
        const CREATE_STU = new STU({
            select: '#CREATE_STU',
            type: 'create',
        });
        const CREATE_NOTE = new NOTE({
            select: '#CREATE_NOTE',
            type: 'create',
        });
        
        const labelsCreate = document.querySelectorAll('[for="forCreate"]');
        if (labelsCreate.length) {
            labelsCreate.forEach((label) => {
                console.log(label);
            })
        }
    });
    
    function logout() {
        Swal.fire({title: "Bạn có chắc không?", text: "Bạn có chắc chắn muốn đăng xuất tài khoản này không?", icon: 'warning', showCancelButton: true, confirmButtonColor: "#195afe", confirmButtonText: "Chắc chắn!",cancelButtonText: "Huỷ"}).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{route('auth.logout')}}'
            }
        })
    }
</script>

<script src="{{ URL('/') }}/js/create-link.js"></script>


@if(isset($config['js']) && is_array($config['js']))
    @foreach($config['js'] as $key => $val)
        {!! '<script src="'.$val.'"></script>' !!}
    @endforeach
@endif
</body>
</html>
