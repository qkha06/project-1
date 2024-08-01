<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Decode</title>
</head>

<body>


    <style>
        .chmv {
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            z-index: 100;
            /* background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3E%3Cg mask='url(%23SvgjsMask1007)' fill='none'%3E%3Crect width='1440' height='560' x='0' y='0' fill='%23c20025'%3E%3C/rect%3E%3Cpath d='M1440 0L1293.33 0L1440 107.4z' fill='rgba(255, 255, 255, 0.1)'%3E%3C/path%3E%3Cpath d='M1293.33 0L1440 107.4L1440 349.63L926.2199999999999 0z' fill='rgba(255, 255, 255, 0.075)'%3E%3C/path%3E%3Cpath d='M926.22 0L1440 349.63L1440 405.67L364.98 0z' fill='rgba(255, 255, 255, 0.05)'%3E%3C/path%3E%3Cpath d='M364.98 0L1440 405.67L1440 439.12L353.16 0z' fill='rgba(255, 255, 255, 0.025)'%3E%3C/path%3E%3Cpath d='M0 560L590.88 560L0 506.21z' fill='rgba(0, 0, 0, 0.1)'%3E%3C/path%3E%3Cpath d='M0 506.21L590.88 560L822.63 560L0 360.37z' fill='rgba(0, 0, 0, 0.075)'%3E%3C/path%3E%3Cpath d='M0 360.37L822.63 560L1187.81 560L0 225.48000000000002z' fill='rgba(0, 0, 0, 0.05)'%3E%3C/path%3E%3Cpath d='M0 225.48000000000002L1187.81 560L1205.58 560L0 186.44000000000003z' fill='rgba(0, 0, 0, 0.025)'%3E%3C/path%3E%3C/g%3E%3Cdefs%3E%3Cmask id='SvgjsMask1007'%3E%3Crect width='1440' height='560' fill='white'%3E%3C/rect%3E%3C/mask%3E%3C/defs%3E%3C/svg%3E"); */
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            color: #000
        }

        .chmv svg.safe {
            color: #000;
            fill: #000;
            width: 50px;
            height: 50px
        }

        .hmvH-icon {
            display: inline-block;
            border: 1px solid;
            border-color: #dadce0;
            border-radius: 50%;
            line-height: 0;
            padding: 10px
        }

        .hmvB-title {
            font-size: 24px;
            margin: 20px 0;
            font-weight: 700
        }

        .hmv {
            background: #FFF;
            position: relative;
            border-radius: 10px;
            padding: 30px 20px;
            text-align: center;
            overflow: hidden;
            margin: 25px 15px;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            border: 1px solid #dadce0;
        }

        .hmv::before {
            content: '';
            position: absolute;
            z-index: 0;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: .06
        }

        .hmv::after {
            content: '';
            width: 60px;
            height: 60px;
            background: rgba(0, 0, 0, 0);
            display: block;
            border-radius: 50%;
            position: absolute;
            top: -12px;
            left: -12px;
            opacity: .1
        }

        .hmv>* {
            position: relative;
            z-index: 1
        }

        .hmv .hmvD {
            font-size: 13px;
            opacity: .8;
            display: inline-flex;
            align-items: center
        }

        .hmv .hmvD svg {
            width: 13px;
            height: 13px;
            margin-right: 5px
        }

        .chmv>.exp {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column
        }

        .exp .b {
            text-align: center
        }

        .chmv>.exp .i svg {
            width: 350px;
            height: 350px;
            max-width: 100%
        }

        .chmv>.exp .button {
            background: #181087
        }

        .hmvH {
            margin-bottom: 25px;
        }

        .hmvB {
            margin-bottom: 15px;
        }

        .hmvF {
            margin-top: 10px;
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-30px)
            }

            100% {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes lightSpeedLeft {
            from {
                transform: translate3d(-50%, 0, 0) skewX(20deg);
                opacity: 0
            }

            60% {
                transform: skewX(-10deg);
                opacity: 1
            }

            80% {
                transform: skewX(2deg)
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0)
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0
            }

            100% {
                opacity: 1
            }
        }

        @keyframes zoomOut {
            0% {
                opacity: 0;
                transform: scale(1.5)
            }

            100% {
                opacity: 1;
                transform: scale(1)
            }
        }

        @keyframes slideRight {
            0% {
                opacity: 0;
                transform: translateX(30px)
            }

            100% {
                opacity: 1;
                transform: translateX(0)
            }
        }

        @keyframes lightSpeedRight {
            from {
                transform: translate3d(50%, 0, 0) skewX(-20deg);
                opacity: 0
            }

            60% {
                transform: skewX(10deg);
                opacity: 1
            }

            80% {
                transform: skewX(-2deg)
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0)
            }
        }

        .button {
            display: inline-flex;
            text-align: center;
            align-items: center;
            background: #ed143d;
            color: #fff;
            font-weight: 400;
            padding: 8px 12px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            transition: opacity 0.3s;
            cursor: pointer;
        }

        .button.wait {
            cursor: default;
        }

        .button:not(.wait):hover {
            opacity: 0.8;
        }

        .button.exp {
            background: #FFF !important;
            color: #181087
        }

        .button.wait {
            background-color: #0454E71f;
            color: #0454E7;
            box-shadow: none;
        }

        .button.wait:hover {
            box-shadow: none;
        }

        .button svg {
            width: 18px;
            height: 18px;
            fill: none !important
        }

        .button .wait-icon {
            margin-right: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .circle_animate {
            animation: rotation 1s linear infinite;
        }

        @keyframes rCv {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateX(0)
            }

            40% {
                transform: translateX(10px)
            }

            60% {
                transform: translateX(5px)
            }
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        h2.expired {
            transition: 1s;
            animation: 0.8s 1 forwards cubic-bezier(.36, -.01, .5, 1.38) zoomIn
        }

        @media screen and (min-width:1024px) {
            .waveT {
                margin-top: -50px
            }

            .waveB {
                margin-bottom: -50px
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.5)
            }

            100% {
                box-shadow: 0 0 0 15px rgba(255, 255, 255, 0)
            }
        }
    </style>
    </head>

    <body>
        <!-- <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:svgjs="http://svgjs.com/svgjs" width="1440" height="560" preserveAspectRatio="none"
    viewBox="0 0 1440 560">
    <g mask="url(#SvgjsMask1007)" fill="none">
        <rect width="1440" height="560" x="0" y="0" fill="#181087"></rect>
        <path d="M1440 0L1293.33 0L1440 107.4z" fill="rgba(255, 255, 255, 0.1)"></path>
        <path d="M1293.33 0L1440 107.4L1440 349.63L926.2199999999999 0z"
            fill="rgba(255, 255, 255, 0.075)"></path>
        <path d="M926.22 0L1440 349.63L1440 405.67L364.98 0z" fill="rgba(255, 255, 255, 0.05)"></path>
        <path d="M364.98 0L1440 405.67L1440 439.12L353.16 0z" fill="rgba(255, 255, 255, 0.025)"></path>
        <path d="M0 560L590.88 560L0 506.21z" fill="rgba(0, 0, 0, 0.1)"></path>
        <path d="M0 506.21L590.88 560L822.63 560L0 360.37z" fill="rgba(0, 0, 0, 0.075)"></path>
        <path d="M0 360.37L822.63 560L1187.81 560L0 225.48000000000002z"
            fill="rgba(0, 0, 0, 0.05)"></path>
        <path d="M0 225.48000000000002L1187.81 560L1205.58 560L0 186.44000000000003z"
            fill="rgba(0, 0, 0, 0.025)"></path>
    </g>
    <defs>
        <mask id="SvgjsMask1007">
            <rect width="1440" height="560" fill="white"></rect>
        </mask>
    </defs>
</svg> -->
        <div class="chmv">
            <div class="hmv alt" id="hmVrfy">
                <div class="hmvH">
                    <div class="hmvH-icon">
                        <svg class="safe" width="64" height="64" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.9,11.1a.4.4,0,0,0,.4-.4h0a.5.5,0,0,1,.5-.5.5.5,0,0,1,.4.5.5.5,0,0,0,.5.4.4.4,0,0,0,.4-.4A1.3,1.3,0,0,0,9.8,9.3a1.4,1.4,0,0,0-1.4,1.4.5.5,0,0,0,.5.4Zm6,3a7.3,7.3,0,0,1-5.8,0,.4.4,0,0,0-.6.2c-.2.2-.1.5.2.6a7.2,7.2,0,0,0,3.3.7,7.2,7.2,0,0,0,3.3-.7c.3-.1.4-.4.2-.6a.4.4,0,0,0-.6-.2Zm4.7-3.9h-.4V8.9a2.3,2.3,0,0,0-2.3-2.3H15.6v-1a1.3,1.3,0,0,0,.8-1.7,1.3,1.3,0,0,0-1.7-.8,1.3,1.3,0,0,0-.8,1.7,1.1,1.1,0,0,0,.8.8v1H9.3v-1a1.3,1.3,0,0,0,.8-1.7,1.3,1.3,0,0,0-1.7-.8,1.3,1.3,0,0,0-.8,1.7,1.1,1.1,0,0,0,.8.8v1H7.1A2.3,2.3,0,0,0,4.8,8.9v1.3H4.4A1.4,1.4,0,0,0,3,11.6v1.8a1.3,1.3,0,0,0,1.4,1.3h.4v1.8a2.2,2.2,0,0,0,2.3,2.2H9.3v1.8a.5.5,0,0,0,.5.5H10l3.5-2.2h3.4a2.2,2.2,0,0,0,2.3-2.2V14.7h.4A1.3,1.3,0,0,0,21,13.4V11.6A1.4,1.4,0,0,0,19.6,10.2ZM15.1,3.9a.5.5,0,0,1,.5.5.5.5,0,0,1-.5.4.4.4,0,0,1-.4-.4A.5.5,0,0,1,15.1,3.9Zm-6.2,0a.5.5,0,0,1,.4.5.4.4,0,0,1-.4.4.5.5,0,0,1-.5-.4A.5.5,0,0,1,8.9,3.9ZM4.4,13.8a.5.5,0,0,1-.5-.4V11.6a.5.5,0,0,1,.5-.5h.4v2.7Zm13.9,2.7a1.3,1.3,0,0,1-1.4,1.3H13.1l-2.9,1.8V18.3a.5.5,0,0,0-.4-.5H7.1a1.3,1.3,0,0,1-1.4-1.3V8.9A1.4,1.4,0,0,1,7.1,7.5h9.8a1.4,1.4,0,0,1,1.4,1.4Zm1.8-3.1a.5.5,0,0,1-.5.4h-.4V11.1h.4a.5.5,0,0,1,.5.5ZM14.2,9.3a1.3,1.3,0,0,0-1.3,1.4.4.4,0,0,0,.4.4.5.5,0,0,0,.5-.4.5.5,0,0,1,.4-.5.5.5,0,0,1,.5.5.4.4,0,0,0,.4.4.5.5,0,0,0,.5-.4A1.4,1.4,0,0,0,14.2,9.3Z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="hmvB">
                    <div class="hmvB-title" id="title-popup">Verify that You are not a Robot</div>
                </div>
                <div class="hmvF">
                    <a class="button pstL wait" id="continue-btn">
                        <div class="wait-icon">
                            <svg class="circle_animate" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 12c0 5.523 4.477 10 10 10s10-4.477 10-10S17.523 2 12 2"></path>
                                <path d="M18 12a6 6 0 1 0-6 6"></path>
                            </svg>
                        </div>

                        <div class="wait-text">Wait a moment...</div>
                    </a>
                </div>

            </div>
            <script>
                const getEpochTime = () => {
                    return new Date().getTime()
                }

                const getParam = e => {
                    let t = window.location.href;
                    return new URLSearchParams(new URL(t).search).get(e);
                };
                const alias = getParam('a');
                var xhrSTU = new XMLHttpRequest,
                    xhrSTU_URL = '/stu/' + alias + '/fetch-data';
                epochTime = getEpochTime();

                function setCookie(name, value, daysToLive) {
                    var expirationDate = "";
                    if (daysToLive) {
                        var date = new Date();
                        date.setTime(date.getTime() + (daysToLive * 1000));
                        expirationDate = "; expires=" + date.toUTCString();
                    }
                    document.cookie = name + "=" + value + expirationDate + "; path=/";
                }
                xhrSTU.open('GET', xhrSTU_URL);
                xhrSTU.setRequestHeader('Content-Type', 'application/json');
                xhrSTU.onreadystatechange = function() {
                    if (this.readyState == XMLHttpRequest.DONE) {
                        if (this.status == 200) {
                            var res = (this.responseText),
                                timeout = (getEpochTime() - epochTime) >= 1e3 ? 0 : 1000;
                            console.log('Ok i\'m fine..')
                            if (res)(setCookie('_STU', res, 3600));
                            window.location.href = "{{ route('stu.load') }}";
                            setTimeout(() => {
                                ctnHanlde()
                            }, timeout)
                        } else {
                            setTimeout(() => {
                                titlePopup.innerText = 'There was an error';
                                ctnBtn.innerText = `Try later!`;
                            }, 1000)
                        }
                    }

                }
                xhrSTU.send();

                var ctnBtn = document.getElementById('continue-btn');
                var titlePopup = document.getElementById('title-popup');

                function ctnHanlde() {
                    ctnBtn.innerText = `I'm not a Robot`;
                    ctnBtn.classList.remove('wait');
                    titlePopup.innerText = 'Are you a Robot?';
                    ctnBtn.setAttribute('href', '/loadd');
                    ctnBtn.setAttribute('target', '_blank');

                }
            </script>


    </body>

</html>
