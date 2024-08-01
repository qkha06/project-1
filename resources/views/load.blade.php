<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View stu</title>
    <style>
        /* Standar CSS */
        ::selection {
            color: #fff;
            background: #195afe
        }

        :root {
            --headerBd-color: #e4e3e1;
            --headerBd-line: 1px;
        }

        *,
        ::after,
        ::before {
            -webkit-box-sizing: border-box;
            box-sizing: border-box
        }

        body {
            display: block;
            margin: 0;
            padding: 0 !important;
            width: 100%;
            font-size: 16px;
            color: black;
            background: #f2f6fc !important;

        }


        a {
            color: black;
            text-decoration: none
        }

        a:hover {
            opacity: .9;
            transition: opacity .1s
        }

        table {
            border-spacing: 0
        }

        iframe {
            max-width: 100%;
            border: 0;
            margin-left: auto;
            margin-right: auto
        }

        input,
        button,
        select,
        textarea {
            font: inherit;
            font-size: 100%;
            color: inherit;
            line-height: normal;
            outline: 0
        }

        input::placeholder {
            color: rgba(0, 0, 0, .5)
        }

        img {
            display: block;
            position: relative;
            max-width: 100%;
            height: auto
        }

        svg {
            width: 22px;
            height: 22px;
            fill: var(--iconC)
        }

        svg.line,
        svg .line {
            fill: none !important;
            stroke: var(--iconC);
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-width: 1
        }

        svg.c-1 {
            fill: var(--iconCa)
        }

        svg.c-2 {
            fill: var(--iconCs);
            opacity: .4
        }

        .hidden {
            display: none
        }

        .invisible {
            visibility: hidden
        }

        .clear {
            width: 100%;
            display: block;
            margin: 0;
            padding: 0;
            float: none;
            clear: both
        }

        .fCls {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            transition: var(--trans-1);
            background: transparent;
            opacity: 0;
            visibility: hidden
        }

        .free::after,
        .new::after {
            display: inline-block;
            content: 'Free!';
            color: var(--linkC);
            font-size: 12px;
            font-weight: 400;
            margin: 0 5px
        }

        .new::after {
            content: 'New!'
        }

        /* DM Sans Font */
        @font-face {
            font-family: 'DM Sans';
            font-style: italic;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Fp2ywxg089UriCZa4ET-DNl0.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: italic;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Fp2ywxg089UriCZa4Hz-D.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: italic;
            font-weight: 500;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Ap2ywxg089UriCZaw7ByWB3wTyCg.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: italic;
            font-weight: 500;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Ap2ywxg089UriCZaw7ByWCXwT.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: italic;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Ap2ywxg089UriCZawpBqWB3wTyCg.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: italic;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Ap2ywxg089UriCZawpBqWCXwT.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Hp2ywxg089UriCZ2IHSeH.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Hp2ywxg089UriCZOIHQ.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Cp2ywxg089UriAWCrCBamC2QX.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Cp2ywxg089UriAWCrCBimCw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Cp2ywxg089UriASitCBamC2QX.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF
        }

        @font-face {
            font-family: 'DM Sans';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Cp2ywxg089UriASitCBimCw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD
        }


        svg {
            width: 22px;
            height: 22px;
            fill: var(--iconC);
        }

        /* UI STU */
        /* .stu .mainB, .stu .mainL,.stu .sideB,.stu .BlogSearch,.stu .sc,.stu .ibook,.stu .LinkList#LinkList88,.stu #comment,.stu .pF,.stu .blogT,.stu .pE img,.stu .pE .separator,.stu .mainM,.pH .byline.img, .pH .share{display:none!important} */
        .stu header.mainH,
        .stu footer .maxC {
            max-width: 1200px;
            margin: 0 auto
        }

        .stu .mainF::before {
            left: 0;
            right: 0;
            max-width: 1200px;
            margin: 0 auto
        }

        header .inL {
            display: flex;
            align-items: center;
            height: 100%;
            padding-inline-start: calc((var(--sideWidth) - var(--iconWidth)) /2)
        }

        .inL a {
            font-weight: 700;
            font-size: 18px
        }

        @media screen and (max-width:640px) {
            header .inL {
                padding-inline-start: 0
            }
        }

        .stu .credit a {
            color: var(--themeLink)
        }

        .stu .mainB .blogB.item {
            max-width: 950px
        }

        .stu .pH .item {
            display: flex;
            justify-content: center
        }

        .stu .pH .time::before {
            content: var(--readtimeBefore) ' ';
            margin-inline: 5px
        }

        .stu h1#postT {
            text-align: center
        }

        .stu .pH {
            opacity: .8
        }

        .stu .pE {
            text-align: center;
        }

        .stu .bg_stu {
            display: block
        }

        .bg_stu {
            display: block;
            max-width: 950px;
            margin: 0 auto;
            font-family: 'DM Sans';
            padding: 20px;
        }

        /* STU */
        .stu-box-wrap {
            margin: 15px 0 30px;
            position: relative;
            text-align: center;
            display: inline-block;
            border-radius: 12px;
            width: 100%;
            padding: 20px 10px;
            border: var(--headerBd-line) solid var(--headerBd-color);
            /*box-shadow:0 5px 35px rgb(0 0 0 / 7%);*/
            background: #fff
        }

        .stu-box-wrap h2 {
            font-family: 'DM Sans';
            font-weight: 700;
            margin: 10px 0 15px
        }

        .stu-box-wrap h3 {
            font-family: 'DM Sans';
            font-weight: 500;
            margin: 0 0 15px;
            font-size: 18px
        }

        /* button stu */
        .stu-box-wrap>* {
            margin: 0 auto;
            position: relative;
            width: calc(90% - 10px);
            max-width: 750px
        }

        .crStu {
            display: block;
            margin: 0 auto;
            text-align: center;
            margin-top: 20px;
            font-family: Montserrat;
            font-size: 12px
        }

        @media screen and (max-width:400px) {
            .stu-box-wrap {
                padding: 10px 5px
            }

            .stu-box-wrap h2 {
                font-size: 20px
            }

            .stu-box-wrap>* {
                max-width: 87%
            }
        }

        .stu-box-wrap .stu-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            padding: 15px 20px;
            margin: 15px auto;
            cursor: pointer;
            font-weight: 700;
            text-decoration: none;
            user-select: none
        }

        .stu-box-wrap .stu-btn i.load svg {
            animation: elRot 2s 0s infinite linear
        }

        .stu-box-wrap .stu-btn i {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, .03);
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 0 3px 1px rgba(0, 0, 0, .2);
            max-width: 30px;
            max-height: 30px
        }

        .stu-btn i svg {
            height: 20px;
            width: 20px
        }

        .stu-box-wrap svg {
            height: 24px;
            width: 24px;
            fill: currentColor
        }

        .stu-box-wrap .d .unlock>svg {
            animation: opaCity 1s 0s, bounce 2.2s 0.5s infinite;
            -webkit-animation: opaCity 1s 0s, bounce 2.2s 0.5s infinite
        }

        .thumbyt {
            display: block;
            padding-top: 50%;
            position: relative;
            margin: 25px auto
        }

        .thumbyt>.lazy {
            position: absolute;
            display: block;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            border-radius: 8px;
            box-shadow: rgb(118 118 118 / 48%) 0 0 7px 1px;
            margin: 0 auto
        }

        .thumbyt>.lazy:hover {
            transform: scale(1.01)
        }

        /*==s1==*/
        .stu-box-wrap.s1 .stu-btn {
            background: #ff3838;
            border: 3px solid transparent;
            box-shadow: rgba(0, 0, 0, .24) 0 3px 8px;
            color: #fff;
            font-family: 'DM Sans';
            transition: all .4s, color .0s, background .4s, border .4s
        }

        .stu-box-wrap.s1 .stu-btn:hover {
            font-size: 15.5px;
            border: 3px solid #fff;
            box-shadow: rgba(0, 0, 0, .24) 0 3px 8px
        }

        .stu-box-wrap.s1 .stu-btn:active {
            border: 3px solid #fff;
            transition: all .4s
        }

        .stu-box-wrap.s1 .d .stu-btn {
            background: rgba(0, 221, 0, .5)
        }

        .stu-box-wrap.s1 .d .stu-btn:hover {
            box-shadow: rgba(50, 205, 50, .5) 0 3px 8px
        }

        .stu-box-wrap.s1 .d .stu-btn[href] {
            background: rgba(0, 221, 0, 1);
            animation: nudge 0.5s 0s;
            cursor: pointer
        }

        .stu-box-wrap.s1 .d .stu-btn[href]:hover {
            box-shadow: rgba(0, 221, 0, 0.5) 0 3px 8px
        }

        .stu-box-wrap.s1 .stu-btn:hover {
            box-shadow: rgb(255 80 80 / 50%) 0 3px 8px
        }

        .stu-box-wrap.s1 .stu-btn i {
            background: none;
            padding: 0;
            border-radius: 0;
            box-shadow: none
        }

        .stu-box-wrap.s1 .stu-btn.done i svg {
            animation: opaC0 0.3s 0s, opaCity 0.3s 0.3s, elRot 0.5s 0.3s linear, nudge 0.5s 0.8s
        }

        .stu-box-wrap.s1 svg {
            height: 22px;
            width: 22px
        }

        .stu-box-wrap.s1 .stu-btn i svg {
            height: 20px;
            width: 20px
        }

        @media screen and (max-width:500px) {
            .stu-box-wrap.s1 .stu-btn:hover {
                font-size: 13px
            }

            .stu-box-wrap.s1 .stu-btn {
                font-size: 13px;
                padding: 10px 12px
            }
        }

        @media screen and (max-width:400px) {
            .stu-box-wrap.s1 .stu-btn:hover {
                font-size: 12px
            }

            .stu-box-wrap.s1 .stu-btn {
                font-size: 12px;
                padding: 10px 12px
            }
        }

        /*=====*/

        /*==s2==*/
        .stu-box-wrap.s2 .stu-btn {
            background: #fff;
            box-shadow: 0 0 3px 1px rgba(0, 0, 0, .2);
            color: #4b5563
        }

        .s2 .stu-btn span {
            font-size: 17px;
            font-weight: 700
        }

        .stu-box-wrap.s2 .d .stu-btn {
            opacity: 0.7;
            cursor: not-allowed
        }

        .stu-box-wrap.s2 .d .stu-btn.unlock {
            opacity: 1;
            cursor: pointer
        }

        .s2 .d .unlock svg {
            color: #00ab40
        }

        .s2 .done i,
        .s2 .unlock i {
            animation: nudge .5s 1s, opaCity 1s 0s, elRot 1s 0s
        }

        .s2 .done i>svg {
            color: #00ab40
        }

        .s2 .yt>svg,
        .s2 .ytl>svg,
        .s2 .ytc>svg {
            color: #ff2b2b
        }

        .s2 .ad>svg {
            color: #0007e0
        }

        .s2 .thumbyt>.lazy {
            box-shadow: 0 0 3px 1px rgba(0, 0, 0, .2);
            transition: all 0.4s
        }

        .drK .s2 .thumbyt>.lazy {
            box-shadow: 0 0 3px 1px rgb(255 255 255 / 20%)
        }

        .s2 .thumbyt>.lazy:hover {
            transform: scale(1.01)
        }

        .s2 #stuBar {
            background-color: #2563eb
        }

        @media screen and (max-width:498px) {
            .s2 .stu-btn span {
                font-size: 14px
            }

            .stu-box-wrap.s2 .stu-btn {
                padding: 10px 14px
            }
        }

        /*=====*/
        .s1 .thumbyt>.lazy {
            box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0, rgba(255, 255, 255, 0.8) -6px -2px 16px 0;
            border: 4px solid #fefefe;
            transition: all 0.4s
        }

        .drK .s1 .thumbyt>.lazy {
            box-shadow: 0 5px 35px rgb(0 0 0 / 7%) !important;
            background-color: #2d2d30 !important;
            color: #aaaaad !important
        }

        .s1 .thumbyt>.lazy:hover {
            transform: scale(1.05)
        }

        .stuLock {
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #fff;
            border-radius: 6px;
            border: 7px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .stuLock button {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #195afe;
            color: white;
            outline: none;
            border: none;
            border-radius: 7px;
            padding: 10px 15px;
            cursor: pointer;
            user-select: none;
            white-space: nowrap;
            transition: all .4s
        }

        .stuLock button:hover {
            opacity: 0.8
        }

        .stuLock button:before {
            content: '';
            padding: 10px;
            margin-right: 5px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='line' viewBox='0 0 24 24' fill='none'%3E%3Cpath d='M19.79 14.9299C17.73 16.9799 14.78 17.6099 12.19 16.7999L7.48002 21.4999C7.14002 21.8499 6.47002 22.0599 5.99002 21.9899L3.81002 21.6899C3.09002 21.5899 2.42002 20.9099 2.31002 20.1899L2.01002 18.0099C1.94002 17.5299 2.17002 16.8599 2.50002 16.5199L7.20002 11.8199C6.40002 9.21995 7.02002 6.26995 9.08002 4.21995C12.03 1.26995 16.82 1.26995 19.78 4.21995C22.74 7.16995 22.74 11.9799 19.79 14.9299Z' stroke-miterlimit='10' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.25'%3E%3C/path%3E%3Cpath d='M6.89001 17.49L9.19001 19.79' stroke-miterlimit='10' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.25'%3E%3C/path%3E%3Cpath d='M14.5 11C15.3284 11 16 10.3284 16 9.5C16 8.67157 15.3284 8 14.5 8C13.6716 8 13 8.67157 13 9.5C13 10.3284 13.6716 11 14.5 11Z' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.25'%3E%3C/path%3E%3C/svg%3E%0A")
        }

        .stu-progs {
            position: relative;
            background-color: #ddd;
            border-radius: 5px;
            overflow: hidden
        }

        #stuBar {
            background-color: #ff2b2b;
            box-shadow: inset 0 2px 9px rgba(255, 255, 255, 0.3), inset 0 -2px 6px rgba(0, 0, 0, 0.4);
            height: 10px;
            width: 0%
        }

        #stuBar.s {
            background-color: #00dd00
        }

        #stuBar::after {
            animation: moveProgs 2s linear infinite;
            background-image: linear-gradient(-45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent);
            background-size: 50px 50px;
            bottom: 0;
            content: "";
            left: 0;
            overflow: hidden;
            position: absolute;
            right: 0;
            top: 0
        }

        /*.cADstu > *{border:1px solid currentColor;padding:20px 0}*/
        [mark-ad] {
            animation: brdCol 1s 0s infinite;
            border-width: 3px !important;
            color: red;
            border-style: dashed !important;
            margin: 0 -3px;
            z-index: 9999 !important;
            position: sticky
        }

        .ft {
            display: flex;
            width: max-content;
            font-size: 14px;
            border-radius: 10px;
            margin: 20px auto 15px;
            padding: 9px 20px;
            align-items: center;
            border: 1px solid #e4e3e1;
            opacity: .7;
            font-weight: 700
        }

        .ft a {
            display: flex;
            text-decoration: none;
            align-items: center;
            color: #ff2b2b
        }

        .ft a:hover {
            text-decoration: none;
            transition: 1.5s
        }

        .ft img {
            display: block !important;
            width: 20px;
            border-radius: 0;
            margin: 0 8px
        }

        .inL {
            display: flex;
            align-items: center;
            height: 100%;
            padding-inline-start: calc((var(--sideWidth) - var(--iconWidth)) /2)
        }

        .inL a {
            font-weight: 700;
            font-size: 18px
        }

        .s-AD.last {
            display: none !important
        }

        #link4sub-1.s-AD.last {
            display: flex !important
        }

        .s-AD.last[href] {
            display: flex !important;
            animation: opaC0 0.5s 0s, nudge 0.5s 0.5s
        }

        .bg_stu .note {
            text-align: left;
            margin: 15px auto 15px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid #e4e3e1;
            padding: 20px
        }

        #msgWr {
            margin: 20px auto;
            /*animation:nudge 0.7s infinite;*/
            padding-block: 18px;
            padding-inline: 40px 20px;
            border-radius: 8px;
            color: #ff4e8d;
            background-color: #fff3f3;
            border: 1px solid #ff4e8d
        }

        .bg_stu .note:not(.wr):after {
            content: '' !important
        }

        .adStu {
            display: block;
            width: 100%;
            height: 300px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e4e3e1
        }

        /* Keyframes Animation */
        @-webkit-keyframes bounce {
            30% {
                -webkit-transform: scale(1.2);
                transform: scale(1.2)
            }

            40%,
            60% {
                -webkit-transform: rotate(-20deg) scale(1.2);
                transform: rotate(-20deg) scale(1.2)
            }

            50% {
                -webkit-transform: rotate(20deg) scale(1.2);
                transform: rotate(20deg) scale(1.2)
            }

            70% {
                -webkit-transform: rotate(0) scale(1.2);
                transform: rotate(0) scale(1.2)
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }

        @keyframes bounce {
            30% {
                transform: scale(1.2)
            }

            40%,
            60% {
                transform: rotate(-20deg) scale(1.2)
            }

            50% {
                transform: rotate(20deg) scale(1.2)
            }

            70% {
                transform: rotate(0) scale(1.2)
            }

            100% {
                transform: scale(1)
            }
        }

        @keyframes nudge {

            0%,
            100% {
                transform: translateX(0)
            }

            30% {
                transform: translateX(-5px)
            }

            50% {
                transform: translateX(5px)
            }

            70% {
                transform: translateX(-2px)
            }
        }

        @-webkit-keyframes nudge {

            0%,
            100% {
                transform: translateX(0)
            }

            30% {
                transform: translateX(-5px)
            }

            50% {
                transform: translateX(5px)
            }

            70% {
                transform: translateX(-2px)
            }
        }

        @keyframes elRot {
            0% {
                transform: rotate(0)
            }

            100% {
                transform: rotate(720deg)
            }
        }

        @keyframes opaC0 {

            0%,
            100% {
                opacity: 0
            }
        }

        @keyframes opaCity {
            0% {
                opacity: 0
            }

            100% {
                opacity: 1
            }
        }

        @keyframes moveProgs {
            0% {
                background-position: 0 0
            }

            100% {
                background-position: 50px 50px
            }
        }

        @-webkit-keyframes moveProgs {
            0% {
                background-position: 0 0
            }

            100% {
                background-position: 50px 50px
            }
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0)
            }

            to {
                -webkit-transform: rotate(1turn);
                transform: rotate(1turn)
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0)
            }

            to {
                -webkit-transform: rotate(1turn);
                transform: rotate(1turn)
            }
        }

        .stu-box-wrap>.d.p .cl {
            display: none
        }

        .stu-box-wrap>.d .cp {
            display: none
        }

        .stu-box-wrap>.d.p .cp {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            background: #f1f3ff;
            height: 120px;
            width: 100%;
            border-radius: 10px;
            margin: 15px auto
        }

        .stu-box-wrap>.d.p .cp::before {
            content: 'Enter Password:'
        }

        .stu-box-wrap>.d.p .cp form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px
        }

        .stu-box-wrap>.d .cp input {
            width: 32px;
            height: 32px;
            font-size: 20px;
            text-align: center;
            border: 2px solid #e4e3e1;
            outline: 0;
            border-radius: 5px;
            transition: 0.3s
        }

        .stu-box-wrap>.d input.ok {
            border-color: green
        }

        .stu-box-wrap>.d input.er {
            border-color: red
        }

        .stu-box-wrap>.d .cp button {
            display: none
        }

        .loading-stu {
            width: 100%;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .loading-stu::after {
            content: "";
            display: block;
            width: 30px;
            height: 30px;
            box-sizing: border-box;
            margin: 0;
            border: 2.5px solid rgba(0, 0, 0, .05);
            border-left-color: #204ecf;
            border-radius: 100%;
            animation: spinner 0.4s infinite linear;
            transform-origin: center
        }

        #topAd,
        #botAd {
            display: flex !important;
            justify-content: center;
            align-content: center
        }

        .qknetwork {
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-content: center
        }

        .stu-alert {
            width: 100%;
            border: 1px solid var(--headerBd-color);
            border-radius: 8px;
            padding: 16px;
            margin: 15px auto;
            text-align: left;
            background-color: #fcfcfc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
        }

        /* Sticky Ad */
        .sticky-ads {
            bottom: 0;
            left: 0;
            width: 100%;
            box-shadow: 0 -6px 18px 0 rgba(9, 32, 76, .1);
            -webkit-transition: all .1s ease-in;
            transition: all .1s ease-in;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fefefe;
            z-index: 20;
        }

        .sticky-ads-close {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px 0 0;
            position: absolute;
            right: 0;
            top: -25px;
            background-color: #fefefe;
            box-shadow: 0 -6px 18px 0 rgba(9, 32, 76, .08);
            cursor: pointer;
        }

        .sticky-ads .sticky-ads-close svg {
            width: 22px;
            height: 22px;
            fill: #000;
        }

        .sticky-ads .sticky-ads-content {
            overflow: hidden;
            display: block;
            position: relative;
            width: 100%;
            margin-right: 10px;
            margin-left: 10px;
            padding: 0px;
        }

        /* animation stu */
        @keyframes brdCol {
            0% {
                border-color: currentColor
            }

            50% {
                border-color: transparent
            }

            100% {
                border-color: currentColor
            }
        }

        @-webkit-keyframes brdCol {
            0% {
                border-color: currentColor
            }

            50% {
                border-color: transparent
            }

            100% {
                border-color: currentColor
            }
        }
    </style>
</head>

<body>
    <div class="bg_stu">
        <div id="topAd"></div>
        {{-- <div class="adStu" id="topAd">
			<ins class='adsbygoogle' data-ad-client='ca-pub-7690117028047118' data-ad-slot='2105802205' data-ad-status='filled' style='display:inline-block;width:100%;height:300px'></ins>
		</div> --}}
        <div class="stu-container" id="stuC">
            <div class='stu-box-wrap'>
                <div class="loading-stu"></div>
            </div>
        </div>
        <div id="botAd"></div>
        <div id="tickyAd">
            <div class="stu-ticky">
                <div class="stu-ticky-header">
                    <div class="stu-ticky-header__close" id="stuTickyC"> Đóng
                    </div>
                </div>
                <div class="stu-ticky-content">
                    <div>
                        <a href="https://hazeabrasiverule.com/p13uxv8ky5?key=ea729f0445f1450f400c71986213e2b1"
                            target="_blank" rel="noopener, noreferrer"
                            style="display: inline-block;max-width: 100%;height: auto;"> <img class="noLb"
                                src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgMnVWeXdzg05gYlhyLBTzcvq8Sq7oUxH1f-qK2JVgpyayaLU270vuQFWzKiSiJS0mSOFK3fTJFO10xWVeN6NO_AvqNzIuedD6wabkUea-pvsOAJfm54Cp7ZfhtfAIR60auqgNZUWQXusumpeZnjaKaU1afZyF9eSgNbYATnqQtoJkIY-_buYPDZ5cwYvCP/s0/1880ed5a29bc71e599a66ac3675c64aa_6415.gif">
                        </a>
                    </div>
                </div>
                <div class="stu-ticky-footer">

                </div>
            </div>
        </div>
    </div>
    <style>
        .stu-ticky {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
        }

        .stu-ticky-header,
        .stu-ticky-content {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .stu-ticky-header__close {
            width: auto;
            border: 1px solid #e4e3e1;
            border-bottom: 0;
            padding: 5px;
            border-radius: 7px 7px 0 0;
            background: #fff;
            cursor: pointer;
        }

        .stu-ticky-header__close:before {
            content: "\2715";
            line-height: 18px;
        }
    </style>

</body>

</html>

<script>
    /*<![CDATA[*/
    var stSTU_ = {
        'txt': {
            'ft': {
                'created_with': 'Created with',
                'i_url': 'https://link4sub.com/images/favicon.png',
                'url': 'https://link4sub.com/',
                'name': 'Link4Sub'
            },
            'unlock_progress': 'Unlock Progress',
            'load': 'Please wait...',
            'done': 'Completed'
        },
        'aApi': {
            'userId': [40, 'user'],
            'lAPI': [
                'https://yeumoney.com/QL_api.php?token=5b539c82581a36409cab82695111565f5df92ee284414b49d4d22ff7990efefb&url='
            ]
        },
    }

    const xQK = {
        gC: (t) => {
            return (t = document.cookie.match(new RegExp('(?:^|; )' + t.replace(/([.$?*|{}()[]\/+^])/g, '$1') +
                '=([^;]*)'))) ? decodeURIComponent(t[1]) : void 0
        },
        sC: (t, n, e = {}) => {
            (e = {
                path: '/',
                ...e,
            }).expires instanceof Date && (e.expires = e.expires.toUTCString());
            let o = unescape(encodeURIComponent(t)) + '=' + unescape(encodeURIComponent(n));
            for (var u in e) {
                o += '; ' + u;
                var c = e[u];
                !0 !== c && (o += '=' + c)
            }
            document.cookie = o;
        },
        dC: (t) => {
                var n = {};
                (n['max-age'] = -1), xQK.sC(t, '', n)
            }

            ,
        sSS: (t, n) => {
            sessionStorage.setItem(t, n)
        },
        gSS: (t) => {
            return sessionStorage.getItem(t)
        }
    }
    const iconSTU = {
        "bpm": "<svg fill=\"currentColor\" viewBox=\"0 0 448 512\"><path d=\"M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z\"/><path d=\"M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z\"/></svg>",
        "ttl": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\"><path d=\"M5,4V7H10.5V19H13.5V7H19V4H5Z\"></path></svg>",
        "sttl": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\"><path d=\"M2 4V7H7V19H10V7H15V4H2M21 9H12V12H15V19H18V12H21V9Z\"></path></svg>",
        "yt": "<svg fill=\"currentColor\" viewBox=\"0 0 576 512\"><path d=\"M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z\"/></svg>",
        "ytl": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M2 8.996h3v12H2a1 1 0 0 1-1-1v-10a1 1 0 0 1 1-1Zm5.293-1.293 6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 7.996H21a2 2 0 0 1 2 2V12.1a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.62H8a1 1 0 0 1-1-1V8.41a1 1 0 0 1 .293-.707Z\"></path></svg>",
        "ytc": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M2 6a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-4.172a1 1 0 0 0-.707.293l-1.867 1.867C11.054 22.361 9 21.51 9 19.812A.812.812 0 0 0 8.188 19H5a3 3 0 0 1-3-3V6Zm5 0a1 1 0 0 0 0 2h10a1 1 0 1 0 0-2H7Zm0 4a1 1 0 1 0 0 2h10a1 1 0 1 0 0-2H7Zm0 4a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2H7Z\"></path></svg>",
        "ig": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\"><path d=\"M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z\"></path></svg>",
        "igl": "<svg fill=\"currentColor\" viewBox=\"0 0 512 512\"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class=\"fa-primary\" d=\"M379.5 280.3l-110.6 114.2c-7.125 7.375-18.69 7.395-25.94 .0199L132.5 280.3C100.4 247.1 102.3 192.1 138.3 161.5C169.5 134.8 216.2 139.6 244.8 169.2l11.3 11.55l11.2-11.55c28.75-29.62 75.54-34.44 106.8-7.687C409.8 192.2 411.7 247.1 379.5 280.3z\"/><path class=\"fa-secondary\" d=\"M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM379.5 280.3l-110.6 114.2c-7.125 7.375-18.69 7.395-25.94 .0199L132.5 280.3C100.4 247.1 102.3 192.1 138.3 161.5C169.5 134.8 216.2 139.6 244.8 169.2l11.3 11.55l11.2-11.55c28.75-29.62 75.54-34.44 106.8-7.687C409.8 192.2 411.7 247.1 379.5 280.3z\"/></svg>",
        "wa": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\"><path d=\"M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 15 3.8 13.47 3.8 11.91C3.81 7.37 7.5 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7 8.5 7 9.71C7 10.93 7.89 12.1 8 12.27C8.14 12.44 9.76 14.94 12.25 16C12.84 16.27 13.3 16.42 13.66 16.53C14.25 16.72 14.79 16.69 15.22 16.63C15.7 16.56 16.68 16.03 16.89 15.45C17.1 14.87 17.1 14.38 17.04 14.27C16.97 14.17 16.81 14.11 16.56 14C16.31 13.86 15.09 13.26 14.87 13.18C14.64 13.1 14.5 13.06 14.31 13.3C14.15 13.55 13.67 14.11 13.53 14.27C13.38 14.44 13.24 14.46 13 14.34C12.74 14.21 11.94 13.95 11 13.11C10.26 12.45 9.77 11.64 9.62 11.39C9.5 11.15 9.61 11 9.73 10.89C9.84 10.78 10 10.6 10.1 10.45C10.23 10.31 10.27 10.2 10.35 10.04C10.43 9.87 10.39 9.73 10.33 9.61C10.27 9.5 9.77 8.26 9.56 7.77C9.36 7.29 9.16 7.35 9 7.34C8.86 7.34 8.7 7.33 8.53 7.33Z\"/></svg>",
        "tg": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"m20.665 3.72-17.73 6.837c-1.21.486-1.203 1.16-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.7H9.84l.002.002-.314 4.692c.46 0 .663-.211.92-.46l2.212-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.24-.473-1.8-1.282-1.434Z\"></path></svg>",
        "tk": "<svg fill=\"currentColor\" viewBox=\"0 0 448 512\"><path d=\"M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z\"/></svg>",
        "fileT": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\"><path d=\"M5,4V7H10.5V19H13.5V7H19V4H5Z\"></path></svg>",
        "fileL": "<svg fill=\"currentColor\" viewBox=\"0 0 640 512\"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class=\"fa-primary\" d=\"M41.41 270.7l133.3-133.3C202.3 109.8 238.5 96 274.6 96s72.36 13.8 99.96 41.41C402.2 165 415.1 201.2 416 237.4c.0004 36.18-13.8 72.36-41.41 99.97l-14.18 14.18c-18.78-1.197-36.33-8.753-49.75-22.18c-3.154-3.154-5.855-6.626-8.382-10.19l27.06-27.06c14.61-14.61 22.66-34.04 22.66-54.71s-8.049-40.1-22.66-54.71C314.7 168 295.3 160 274.6 160C253.1 160 234.5 168 219.9 182.7L86.66 315.9c-14.62 14.61-22.66 34.04-22.66 54.71s8.047 40.1 22.66 54.71C101.3 439.1 120.7 448 141.4 448c20.67 0 40.1-8.047 54.71-22.66l60.59-60.59c2.779 3.355 5.584 6.7 8.731 9.846c12.72 12.72 27.39 22.17 42.91 29.02l-66.98 66.98C213.7 498.2 177.6 512 141.4 512c-36.18 0-72.36-13.8-99.97-41.41C-13.8 415.4-13.8 325.9 41.41 270.7z\"/><path class=\"fa-secondary\" d=\"M598.6 241.3l-133.3 133.3C437.7 402.2 401.6 416 365.4 416s-72.36-13.8-99.96-41.41c-26.63-26.63-40.42-61.25-41.36-96.15C223 241 236.8 203.2 265.4 174.7L279.6 160.5c18.78 1.197 36.33 8.753 49.75 22.18c3.154 3.154 5.854 6.626 8.382 10.19L310.7 219.9c-14.61 14.61-22.66 34.04-22.66 54.71s8.049 40.1 22.66 54.71C325.3 343.1 344.7 352 365.4 352c20.67 0 40.1-8.049 54.71-22.66l133.3-133.3c14.62-14.61 22.66-34.04 22.66-54.71S567.1 101.3 553.3 86.66C538.7 72.05 519.3 64 498.6 64c-20.67 0-40.1 8.047-54.71 22.66l-60.59 60.59c-2.779-3.355-5.584-6.7-8.73-9.846c-12.72-12.72-27.39-22.17-42.91-29.02l66.98-66.98C426.3 13.8 462.4 0 498.6 0c36.18 0 72.36 13.8 99.96 41.41c27.11 27.11 40.9 62.48 41.39 98C640.5 176.2 626.7 213.2 598.6 241.3z\"/></svg>",
        "link": "<svg fill=\"currentColor\" viewBox=\"0 0 640 512\"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class=\"fa-primary\" d=\"M41.41 270.7l133.3-133.3C202.3 109.8 238.5 96 274.6 96s72.36 13.8 99.96 41.41C402.2 165 415.1 201.2 416 237.4c.0004 36.18-13.8 72.36-41.41 99.97l-14.18 14.18c-18.78-1.197-36.33-8.753-49.75-22.18c-3.154-3.154-5.855-6.626-8.382-10.19l27.06-27.06c14.61-14.61 22.66-34.04 22.66-54.71s-8.049-40.1-22.66-54.71C314.7 168 295.3 160 274.6 160C253.1 160 234.5 168 219.9 182.7L86.66 315.9c-14.62 14.61-22.66 34.04-22.66 54.71s8.047 40.1 22.66 54.71C101.3 439.1 120.7 448 141.4 448c20.67 0 40.1-8.047 54.71-22.66l60.59-60.59c2.779 3.355 5.584 6.7 8.731 9.846c12.72 12.72 27.39 22.17 42.91 29.02l-66.98 66.98C213.7 498.2 177.6 512 141.4 512c-36.18 0-72.36-13.8-99.97-41.41C-13.8 415.4-13.8 325.9 41.41 270.7z\"/><path class=\"fa-secondary\" d=\"M598.6 241.3l-133.3 133.3C437.7 402.2 401.6 416 365.4 416s-72.36-13.8-99.96-41.41c-26.63-26.63-40.42-61.25-41.36-96.15C223 241 236.8 203.2 265.4 174.7L279.6 160.5c18.78 1.197 36.33 8.753 49.75 22.18c3.154 3.154 5.854 6.626 8.382 10.19L310.7 219.9c-14.61 14.61-22.66 34.04-22.66 54.71s8.049 40.1 22.66 54.71C325.3 343.1 344.7 352 365.4 352c20.67 0 40.1-8.049 54.71-22.66l133.3-133.3c14.62-14.61 22.66-34.04 22.66-54.71S567.1 101.3 553.3 86.66C538.7 72.05 519.3 64 498.6 64c-20.67 0-40.1 8.047-54.71 22.66l-60.59 60.59c-2.779-3.355-5.584-6.7-8.73-9.846c-12.72-12.72-27.39-22.17-42.91-29.02l66.98-66.98C426.3 13.8 462.4 0 498.6 0c36.18 0 72.36 13.8 99.96 41.41c27.11 27.11 40.9 62.48 41.39 98C640.5 176.2 626.7 213.2 598.6 241.3z\"/></svg>",
        "pass": "<svg fill=\"currentColor\" viewBox=\"0 0 512 512\"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class=\"fa-primary\" d=\"M336 0c-97.2 0-176 78.8-176 176c0 14.71 2.004 28.93 5.406 42.59l128 127.1C307.1 349.1 321.3 351.1 336 351.1c97.2 0 176-78.8 176-176S433.2 0 336 0zM376 176c-22.09 0-40-17.91-40-40S353.9 96 376 96S416 113.9 416 136S398.1 176 376 176z\"/><path class=\"fa-secondary\" d=\"M165.4 218.6l-156 156C3.371 380.6 0 388.8 0 397.3V496C0 504.8 7.164 512 16 512l96 0c8.836 0 16-7.164 16-16v-48h48c8.836 0 16-7.164 16-16v-48h57.37c4.242 0 8.312-1.688 11.31-4.688l32.72-32.72L165.4 218.6z\"/></svg>",
        "note": "<svg fill=\"currentColor\" viewBox=\"0 0 448 512\"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class=\"fa-primary\" d=\"M448 320v5.49c0 16.97-6.742 33.25-18.75 45.25l-90.51 90.51C326.7 473.3 310.5 480 293.5 480H288v-128c0-17.67 14.33-32 32-32H448z\"/><path class=\"fa-secondary\" d=\"M448 80V320h-64L384 96H64v320h224v64H48C21.49 480 0 458.5 0 432v-352C0 53.49 21.49 32 48 32h352C426.5 32 448 53.49 448 80z\"/></svg>",
        "tw": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\"><path d=\"M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z\"></path></svg>",
        "exp": "<svg fill=\"currentColor\" viewBox=\"0 0 512 512\"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class=\"fa-primary\" d=\"M239 272.1c4.688 4.688 10.83 7.031 16.97 7.031c6.141 0 12.28-2.344 16.97-7.031c9.375-9.375 9.375-24.56 0-33.94l-79.1-80c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94L239 272.1z\"/><path class=\"fa-secondary\" d=\"M389.8 56.49c-41.56-28.35-92.1-40.48-142.4-40.49C234.5 15.1 223.1 26.41 223.1 39.26l0 71.05c0 15.95 10.9 30.72 26.64 33.28c20.06 3.261 37.39-12.13 37.39-31.57V83.14c48.13 8.809 91.06 36.96 118.7 81.6c35.56 57.32 34.37 130.7-2.792 187c-63.63 96.38-195.3 106-272.5 28.81C69.43 318.5 63.47 221.3 113.6 152.4c9.276-12.73 8.662-30.08-2.477-41.22C96.12 96.21 73.86 98.17 61.41 115.4c-67.92 93.8-59.65 226 24.8 310.5c46.8 46.79 108.3 70.21 169.8 70.18c61.49 0 122.1-23.38 169.8-70.18C530.2 321.4 518.2 144.1 389.8 56.49z\"/></svg>",
        "thumb": "<svg fill=\"currentColor\" viewBox=\"0 0 512 512\"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class=\"fa-primary\" d=\"M446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z\"/><path class=\"fa-secondary\" d=\"M464 32h-416C21.49 32 0 53.49 0 80v352C0 458.5 21.49 480 48 480h416c26.51 0 48-21.49 48-48v-352C512 53.49 490.5 32 464 32zM111.1 96c26.51 0 48 21.49 48 48S138.5 192 111.1 192s-48-21.49-48-48S85.48 96 111.1 96zM446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z\"/></svg>",
        "df": "<svg fill=\"currentColor\" viewBox=\"0 0 448 512\"><path d=\"M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z\"/><path d=\"M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z\"/></svg>",
        "rst": "<svg fill=\"currentColor\" viewBox=\"0 0 640 512\"><path d=\"M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z\"/></svg>",
        "load": "<svg fill=\"currentColor\" viewBox=\"0 0 512 512\"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class=\"fa-primary\" d=\"M283.2 65.92C267.6 63.69 256 50.32 256 34.52c0-19.38 17.19-34.69 36.38-31.95C416.4 20.29 512 127.2 512 256c0 33.38-6.544 65.26-18.27 94.49c-7.162 17.86-28.85 24.87-45.56 15.32c-13.74-7.854-19.62-24.53-13.75-39.23C443.2 304.7 448 280.9 448 256C448 159.4 376.3 79.18 283.2 65.92z\"/><path class=\"fa-secondary\" d=\"M493.7 350.5C456 444.9 363.7 512 256 512c-141.2 0-256-114.8-256-256s114.8-256 256-256c11.91 0 23.54 1.104 35.03 2.686C272.4 .8672 256 15.62 256 34.52c0 15.8 11.58 29.17 27.23 31.4c.9648 .1367 1.844 .5116 2.805 .6639C276.2 65.04 266.2 64 256 64C150.1 64 64 150.1 64 256s86.13 192 192 192c81.67 0 151.4-51.34 179.1-123.4c-.248 .6406-.4215 1.317-.6754 1.954c-5.869 14.7 .0045 31.38 13.75 39.23C464.8 375.3 486.5 368.2 493.7 350.5z\"/></svg>",
        "chevr": "<svg fill=\"currentColor\" viewBox=\"0 0 448 512\"><defs><style>.fa-secondary{opacity:.4}</style></defs><path class=\"fa-primary\" d=\"M224 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L370.8 256L201.4 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C240.4 476.9 232.2 480 224 480z\"/><path class=\"fa-secondary\" d=\"M32 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L9.375 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C48.38 476.9 40.19 480 32 480z\"/></svg>",
        "check": "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><title>check-decagram</title><path d=\"M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z\" /></svg>",
        "fb": "<svg fill=\"currentColor\" viewBox=\"0 0 512 512\"><path d=\"M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z\"/></svg>",
        "dc": "<svg fill=\"currentColor\" viewBox=\"0 0 640 512\"><path d=\"M524.531,69.836a1.5,1.5,0,0,0-.764-.7A485.065,485.065,0,0,0,404.081,32.03a1.816,1.816,0,0,0-1.923.91,337.461,337.461,0,0,0-14.9,30.6,447.848,447.848,0,0,0-134.426,0,309.541,309.541,0,0,0-15.135-30.6,1.89,1.89,0,0,0-1.924-.91A483.689,483.689,0,0,0,116.085,69.137a1.712,1.712,0,0,0-.788.676C39.068,183.651,18.186,294.69,28.43,404.354a2.016,2.016,0,0,0,.765,1.375A487.666,487.666,0,0,0,176.02,479.918a1.9,1.9,0,0,0,2.063-.676A348.2,348.2,0,0,0,208.12,430.4a1.86,1.86,0,0,0-1.019-2.588,321.173,321.173,0,0,1-45.868-21.853,1.885,1.885,0,0,1-.185-3.126c3.082-2.309,6.166-4.711,9.109-7.137a1.819,1.819,0,0,1,1.9-.256c96.229,43.917,200.41,43.917,295.5,0a1.812,1.812,0,0,1,1.924.233c2.944,2.426,6.027,4.851,9.132,7.16a1.884,1.884,0,0,1-.162,3.126,301.407,301.407,0,0,1-45.89,21.83,1.875,1.875,0,0,0-1,2.611,391.055,391.055,0,0,0,30.014,48.815,1.864,1.864,0,0,0,2.063.7A486.048,486.048,0,0,0,610.7,405.729a1.882,1.882,0,0,0,.765-1.352C623.729,277.594,590.933,167.465,524.531,69.836ZM222.491,337.58c-28.972,0-52.844-26.587-52.844-59.239S193.056,219.1,222.491,219.1c29.665,0,53.306,26.82,52.843,59.239C275.334,310.993,251.924,337.58,222.491,337.58Zm195.38,0c-28.971,0-52.843-26.587-52.843-59.239S388.437,219.1,417.871,219.1c29.667,0,53.307,26.82,52.844,59.239C470.715,310.993,447.538,337.58,417.871,337.58Z\"/></svg>",
        "lock": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5ZM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9V7Zm4 10.723V20h-2v-2.277a1.994 1.994 0 0 1 1.454-3.672 2 2 0 0 1 1.277 2.945 1.99 1.99 0 0 1-.731.727Z\"></path></svg>",
        "ads": "<svg viewBox=\"0 0 24 24\"><path d=\"M19 7C17.9 7 17 7.9 17 9V11C17 12.1 17.9 13 19 13H21V15H17V17H21C22.1 17 23 16.1 23 15V13C23 11.9 22.1 11 21 11H19V9H23V7H19M9 7V17H13C14.1 17 15 16.1 15 15V9C15 7.9 14.1 7 13 7H9M11 9H13V15H11V9M3 7C1.9 7 1 7.9 1 9V17H3V13H5V17H7V9C7 7.9 6.1 7 5 7H3M3 9H5V11H3V9Z\"></path></svg>",
        "unlock": "<svg fill=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M18 10H9V7c0-1.654 1.346-3 3-3s3 1.346 3 3h2c0-2.757-2.243-5-5-5S7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2Zm-7.939 5.499A2.002 2.002 0 0 1 14 16a1.99 1.99 0 0 1-1 1.723V20h-2v-2.277a1.992 1.992 0 0 1-.939-2.224Z\"></path></svg>",
        "loader": "<svg xmlns='http://www.w3.org/2000/svg' fill='#fefefe' viewBox='0 0 32 32'><path d='M6 16c0-0.381 0.022-0.756 0.063-1.126l-5.781-1.878c-0.185 0.973-0.283 1.977-0.283 3.004 0 4.601 1.943 8.748 5.052 11.666l3.571-4.916c-1.629-1.779-2.623-4.149-2.623-6.751zM26 16c0 2.602-0.994 4.972-2.623 6.751l3.571 4.916c3.109-2.919 5.052-7.065 5.052-11.666 0-1.027-0.098-2.031-0.283-3.004l-5.781 1.878c0.041 0.37 0.063 0.745 0.063 1.126zM18 6.2c2.873 0.583 5.298 2.398 6.702 4.87l5.781-1.878c-2.287-4.857-6.945-8.377-12.482-9.067v6.076zM7.298 11.070c1.403-2.471 3.829-4.286 6.702-4.87v-6.076c-5.537 0.691-10.195 4.21-12.482 9.067l5.78 1.878zM20.142 25.104c-1.262 0.575-2.665 0.896-4.142 0.896s-2.88-0.321-4.142-0.896l-3.572 4.916c2.288 1.261 4.917 1.98 7.714 1.98s5.426-0.719 7.714-1.98l-3.572-4.916z'></path></svg>",
        "ct": '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M399.034,265.919l-54.092,54.073h-28.602c2.373-6.678,3.666-13.859,3.666-21.333c0-35.249-28.751-64-64-64H152.798 L128,226.4V192c0-11.782-9.551-21.333-21.333-21.333H21.333C9.551,170.667,0,180.218,0,192v298.667 C0,502.449,9.551,512,21.333,512h85.333c11.782,0,21.333-9.551,21.333-21.333v-21.342h127.068 c60.397,0,119.538-17.22,170.512-49.648l3.637-2.917l60.331-60.352c24.927-24.895,24.927-65.568-0.003-90.498 C464.615,240.979,423.942,240.979,399.034,265.919z M85.333,469.333H42.667v-256h42.667V469.333z M459.384,326.23l-58.654,58.674 c-43.686,27.281-94.146,41.754-145.663,41.754H128.006V271.372l14.593,4.86c2.173,0.724,4.449,1.093,6.74,1.093h106.667 c11.685,0,21.333,9.649,21.333,21.333c0,11.685-9.649,21.333-21.333,21.333c-28.444,0-28.444,42.667,0,42.667h97.771 c5.657,0,11.082-2.247,15.082-6.246l60.352-60.331c8.257-8.267,21.899-8.267,30.163-0.003S467.639,317.986,459.384,326.23z"></path> <path d="M256,192c35.355,0,64-28.645,64-64s-28.645-64-64-64s-64,28.645-64,64S220.645,192,256,192z M256,106.667 c11.791,0,21.333,9.542,21.333,21.333s-9.542,21.333-21.333,21.333c-11.791,0-21.333-9.542-21.333-21.333 S244.209,106.667,256,106.667z"></path> <path d="M448,128c35.355,0,64-28.645,64-64S483.355,0,448,0s-64,28.645-64,64S412.645,128,448,128z M448,42.667 c11.791,0,21.333,9.542,21.333,21.333S459.791,85.333,448,85.333S426.667,75.791,426.667,64S436.209,42.667,448,42.667z"></path> </g> </g> </g> </g></svg>'
    };

    function dcSTU(str) {
        return decodeURIComponent(atob(str))
    }

    const dtLnk = JSON.parse(xQK.gC('_STU') || '{}');
    const info = dtLnk.data?.info || {};
    const STTKey = '__status#' + info.alias;

    const objStt = JSON.parse(xQK.gSS(STTKey) || '{}');
    const other = dtLnk.data?.oth;
    var stSTU = {
        ...stSTU_,
        ...dtLnk.config
    };

    if (dtLnk && info && objStt) {
        const s_txt = stSTU.txt;
        const s_cfLv = stSTU;

        (function(e) {
            let n = document.querySelector('link[rel="icon"]');
            if (null !== n) n.href = e;
            else {
                let l = document.createElement("link");
                l.rel = "icon", l.href = e, document.head.appendChild(l)
            }
        })("https://link4sub.com/images/favicon.png");

        function rdmV(per) {
            const rdNum = Math.random() * 100;
            const objRAd = JSON.parse(xQK.gC('__RD') || '{}');
            const currT = new Date().getTime();
            const config = s_cfLv['ad-1'];

            if (objRAd[other.lv]) {
                if (objRAd[other.lv][1] && currT - objRAd[other.lv][0] < config['reset-time'] * 1000) {
                    return true
                }
            }
            if (rdNum <= per) {
                objRAd[other.lv] = [currT, true];
                xQK.sC('__RD', JSON.stringify(objRAd), {
                    secure: 1,
                    'max-age': 86400000
                });
                return true
            } else {
                objRAd[other.lv] = [currT, false];
                xQK.sC('__RD', JSON.stringify(objRAd), {
                    secure: 1,
                    'max-age': 86400000
                });
                return false
            }
        }

        function sSTT(d, n) {
            d[n] = !0;
            xQK.sSS(STTKey, JSON.stringify(d));
            return true;
        }

        function __CLICK(level, act) {
            const obj = JSON.parse(xQK.gC('__CLICK') || '{}');
            const currT = new Date().getTime();
            const config = stSTU['ad-1'];

            if (act == 'c') {
                if (objStt.ad1 || Object.keys(obj).length == 0 || !obj[level] || currT - obj[level][1] >= config[
                        'exist-time'] * 1000) {
                    return true
                } else {
                    return false
                }
            } else if (act == 'u') {
                obj[level] = [1, currT]
                xQK.sC('__CLICK', JSON.stringify(obj), {
                    secure: 1,
                    'max-age': 86400 * 5
                })
            }
        }

        function _rd(arr) {
            return arr[Math.floor(Math.random() * arr.length)];
        }

        function createBtn(obj) {
            let res = '';
            let cnt = 0;
            let currPage = objStt && objStt['page'] ? objStt['page'] + 1 : 1;
            console.log('page now', currPage);
            if (currPage == 1) {
                for (var key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        cnt += 1;
                        var value = obj[key];

                        res += `<a class='stu-btn ${dcSTU(value['ic'])}' data-id='${(key)}' href='${dcSTU(value['url'])}' data-name='${dcSTU(value['name'])}' target='_blank'>
									${iconSTU[dcSTU(value['ic'])]}
									<span>${dcSTU(value['name'])}</span>
									<i class='icon'>${(iconSTU['chevr'])}</i>
								</a>`;
                    }
                }
            }

            const _cfAd2 = stSTU['ad-2'];
            if (_cfAd2.show == true && res != '') {
                if (currPage == _cfAd2.page) {
                    const html = `<a class='stu-btn ad a' data-id='ad2' href='${_rd(_cfAd2.adUnits[window.location.host])}' target='_blank' no-req='true'>
						${_cfAd2.icon} 

						<span>${_cfAd2.name}</span>
						<i class='icon'>${(iconSTU['chevr'])}</i>
						</a>`;
                    if (_cfAd2.position == 'last') {
                        res += html;
                    } else if (_cfAd2.position == 'first') {
                        res = html + res;
                    }
                }
            }

            const _cfClickAd1 = stSTU['ad-1'];
            if (_cfClickAd1.show == true && currPage == _cfClickAd1.page && rdmV(_cfClickAd1['display-ratio']) &&
                __CLICK(other.lv, 'c')) {
                let _eltAd = `<a class='stu-btn Ad-C ${_cfClickAd1.icon}' data-id='ad1'>
							${iconSTU['ads']} 
							<span>${_cfClickAd1.name}</span>
							<i class='icon'>${(iconSTU['chevr'])}</i>

						</a>`;
                if (_cfClickAd1.position == 'last') {
                    res += _eltAd;
                } else if (_cfClickAd1.position == 'first') {
                    res = _eltAd + res;
                }
            }

            return res
        }

        function createDest(obj) {
            let res = `<div class='cl'>`;
            let pwdF =
                `<form><input type="text" name="p0" data-id="0" maxlength="1" placeholder="?" required=""><input type="text" name="p1" data-id="1" maxlength="1" placeholder="?" required=""><input type="text" name="p2" data-id="2" maxlength="1" placeholder="?" required=""><input type="text" name="p3" data-id="3" maxlength="1" placeholder="?" required=""><input type="text" name="p4" data-id="4" maxlength="1" placeholder="?" required=""><input type="text" name="p5" data-id="5" maxlength="1" placeholder="?" required=""><button type="submit">submit</button></form>`;
            let currPage = objStt && objStt['page'] ? objStt['page'] + 1 : 1;
            let x = "";
            if (other.pwd) {
                let w = dcSTU(other.pwd).split("");
                x += "<form>", w.forEach((t, e) => {
                    x += '<input type="text" name="p' + e + '" data-id="' + e +
                        '" maxlength="1" placeholder="?" required/>'
                }), x += '<button type="submit">submit</button></form>'
            }

            if (stSTU['next-step']) {
                if (stSTU['next-step'].show === true) {
                    res += `<a class='stu-btn link' data-href='rdm'>
								${iconSTU['lock']}
								<span>Next Step</span>
								<i class='icon'>${(iconSTU['link'])}</i>
							</a>`;

                } else {
                    for (var key in obj) {
                        if (obj.hasOwnProperty(key)) {
                            var value = obj[key];

                            if (stSTU.aApi && (stSTU.aApi.userId).includes(info.userId)) {
                                res +=
                                    `<a class='stu-btn ${dcSTU(value['ic'])}' data-href='${_rd(stSTU.aApi.lAPI) + dcSTU(value['url'])}' target='_blank'>${dcSTU(value['name'])}</a>`;
                            } else {
                                res += `<a class='stu-btn ${dcSTU(value['ic'])}' data-href='${value['url']}' target='_blank'>
									${iconSTU['lock']}

									<span>${dcSTU(value['name'])}</span>
									<i class='icon'>${(iconSTU['link'])}</i>

									</a>`;
                            }
                        }
                    }
                }
            }
            res += `</div><div class='cp'>${other.pwd ? x : ''}</div>`;
            return res
        }

        if (other.exp && Date.parse(new Date(dcSTU(other.exp))) > Date.parse(new Date().toISOString().slice(0, 16))) {
            alert('The link has expired..');
            location.href = 'https://link4sub.com/';
        }
        document.title = dcSTU(other.ttl);

        const eltThumb = (objStt && (objStt['page'] + 1) == 2) ? '' : other.thmb ?
            "<div class='thumbyt'><div class='lazy' style='background-image:url(" + dcSTU(other.thmb) +
            ")'></div><br></div>" : '';

        const htmlSTU = `<div class='note'>${dcSTU(other.note)}</div>
			<div class='stu-box-wrap s${other.sty ? other.sty : 2}'>
				<div class='t'>
					<h2 class='t-title'>${dcSTU(other.ttl)}</h2>
					<h3 class='t-s-title'>${dcSTU(other.sttl)}</h3>
				</div>
				<div class='i'>${eltThumb}</div>
				<div class='b'>${createBtn(dtLnk['data']['btn'])}</div>
				<div class='p' id='pg'></div>
				<div class='d ${other.pwd ? 'p' : ''}'>${createDest(dtLnk['data']['lnk'])}</div>
				<div class='f'>
					<div class="ft">
						<span>${stSTU.txt.ft.created_with} </span> <img src="${stSTU.txt.ft.i_url}"> <a href='${stSTU.txt.ft.url}'> ${stSTU.txt.ft.name}</a>
					</div>
				</div>
			</div>`;

        document.getElementById('stuC').innerHTML = htmlSTU;
        if (other.pwd) {
            const pwdForm = document.querySelector(".stu-box-wrap>.d .cp form");

            pwdForm.addEventListener("submit", (event) => {
                event.preventDefault();
                let passwordInput = pwdForm.querySelector("input.er");
                if (passwordInput) {
                    passwordInput.focus();
                } else {
                    let pSection = document.querySelector(".stu-box-wrap>.d");
                    if (pSection) {
                        pSection.classList.remove("p");
                    }
                }
            });

            document.querySelectorAll(".stu-box-wrap>.d .cp input").forEach((input) => {
                input.addEventListener("input", () => {
                    let passwordChars = dcSTU(other.pwd).split("");
                    if (input.value) {
                        let charIndex = parseInt(input.dataset.id);
                        if (input.value == passwordChars[charIndex]) {
                            input.classList.remove("er");
                            input.classList.add("ok");
                        } else {
                            input.classList.remove("ok");
                            input.classList.add("er");
                        }
                    } else {
                        input.classList.remove("er");
                        input.classList.remove("ok");
                    }
                });

                input.addEventListener("change", () => {
                    if (input.value) {
                        document.querySelector(".stu-box-wrap>.d .cp form button").click();
                    }
                });
            });
        }
        for (const key in objStt) {
            if (objStt.hasOwnProperty(key)) {
                var item = objStt[key];
                if (item) {
                    const button = document.querySelector('[data-id="' + key + '"]');
                    if (button) {

                        button.classList.add('done');
                        button.querySelector('i').innerHTML = iconSTU['check'];
                        button.querySelector('span').innerHTML = stSTU.txt.done;

                        let buttonTotals = document.querySelectorAll('.stu-box-wrap .b > a.stu-btn');
                        let buttonTotalDones = document.querySelectorAll('.stu-box-wrap .b > a.stu-btn.done');

                        if (buttonTotals.length == buttonTotalDones.length) {
                            const destButtons = document.querySelectorAll('.stu-box-wrap .d a');
                            destButtons.forEach(destButton => {
                                const destDtHref = destButton.getAttribute('data-href');
                                destButton.classList.remove('lock');
                                destButton.classList.add('unlock');
                                if (destButton.firstElementChild.tagName === 'svg') {
                                    destButton.removeChild(destButton.firstElementChild);
                                }
                                destButton.innerHTML = iconSTU['unlock'] + destButton.innerHTML;

                                if (destDtHref == 'rdm') {
                                    let rdLnk = _rd(stSTU['next-step'].arrPost[window.location.host])
                                    destButton.setAttribute('href', rdLnk);
                                } else {
                                    destButton.setAttribute('href', dcSTU(destDtHref));
                                }
                            });
                        }
                    }
                }
            }
        }

        const totalBtn = document.querySelectorAll('.stu-box-wrap .b > a').length;
        const totalBtnD = document.querySelectorAll('.stu-box-wrap .b > a.done').length;
        const perProgs = Math.floor(100 / totalBtn);
        const perWidthProgs = totalBtnD < totalBtn ? (perProgs * totalBtnD) + '%' : '100%';

        if (totalBtn > 0) {
            const progressHTML = `
				<div>${stSTU.txt.unlock_progress} <span id='prog01'>${totalBtnD}</span>/<span>${totalBtn}</span></div>
				<div class='stu-progs'><div id='stuBar' class='${perWidthProgs === '100%' ? 's' : ''}' style='width:${perWidthProgs}'></div></div>
			`;

            document.getElementById('pg').innerHTML = progressHTML;
        } else {
            const destButtons = document.querySelectorAll('.stu-box-wrap .d a');
            destButtons.forEach(destButton => {
                const destDtHref = destButton.getAttribute('data-href');
                destButton.classList.remove('lock');
                destButton.classList.add('unlock');
                if (destButton.firstElementChild.tagName === 'svg') {
                    destButton.removeChild(destButton.firstElementChild);
                }
                destButton.innerHTML = iconSTU['unlock'] + destButton.innerHTML;

                if (destDtHref == 'rdm') {
                    let rdLnk = _rd(stSTU['next-step'].arrPost[window.location.host])
                    destButton.setAttribute('href', rdLnk);
                } else {
                    destButton.setAttribute('href', dcSTU(destDtHref));
                }
            });
        }

        function moveProgs(totalBtn, perProgs) {
            let totalBtnD = document.querySelectorAll('.stu-box-wrap .b > a.done').length;
            let perWidthProgs = totalBtnD < totalBtn ? (perProgs * totalBtnD) : 100;
            let time = 500 / perProgs;
            let curWidth = perProgs * (totalBtnD - 1);

            let elmPr01 = document.getElementById('prog01');
            let elmBar = document.getElementById('stuBar');

            elmPr01.innerText = totalBtnD;

            if (perWidthProgs == 100) {
                elmBar.classList.add('s');
            }

            let move = setInterval(() => {
                if (curWidth >= perWidthProgs) {
                    clearInterval(move);
                } else {
                    curWidth += 1;
                    elmBar.style.width = curWidth + '%';
                }
            }, time);

        }

        function dcSTU(s) {
            return decodeURIComponent(atob(s)) != null ? decodeURIComponent(atob(s)) : false
        }

        var gbStu = document.querySelectorAll('.stu-box-wrap .b > a');

        if (gbStu.length == 0) {
            var nbStu = document.querySelectorAll('.stu-box-wrap .b > a');
            for (var i = 0; i < nbStu.length; i++) {
                nbStu[i].classList.remove('lock');
                nbStu[i].classList.add('unlock');
                let dtHref = nbStu[i].getAttribute("data-href");
                nbStu[i].setAttribute("href", dcSTU(dtHref));
            }
        }

        const processButtonClick = (button) => {
            button.querySelector('i').classList.remove('load');
            button.querySelector('i').innerHTML = iconSTU['check'];
            button.classList.add('done');
            button.querySelector('span').innerText = stSTU.txt.done;
            moveProgs(totalBtn, perProgs)

            let buttonTotals = document.querySelectorAll('.stu-box-wrap .b > a.stu-btn');
            let buttonTotalDones = document.querySelectorAll('.stu-box-wrap .b > a.stu-btn.done');

            if (buttonTotals.length == buttonTotalDones.length) {
                unlockDestButtons();
            }

            const msg = document.getElementById('msgWr');
            if (msg) msg.remove();
        };

        function isAdVisible(config) {
            let position = config.select;
            let type = config['type-ad'];

            while (position.length > 0) {
                const rdId = Math.floor(Math.random() * position.length);
                const rdPos = position[rdId];
                position.splice(rdId, 1);
                const adE = document.querySelector(`#${rdPos} .${type}`);
                if (adE && adE.getAttribute('data-ad-status') == 'filled') {
                    return rdPos
                }
            }
            return false;
        }

        const unlockDestButtons = () => {
            const destButtons = document.querySelectorAll('.stu-box-wrap .d a');

            setTimeout(() => {
                destButtons.forEach(destButton => {
                    const destDtHref = destButton.getAttribute('data-href');
                    if (destDtHref == 'rdm') {
                        let rdLnk = _rd(stSTU['next-step'].arrPost[window.location.host])
                        destButton.setAttribute('href', rdLnk);
                    } else {
                        destButton.setAttribute('href', dcSTU(destDtHref));
                    }
                    destButton.classList.remove('lock');
                    destButton.classList.add('unlock');
                    if (destButton.firstElementChild.tagName === 'svg') {
                        destButton.removeChild(destButton.firstElementChild);
                    }
                    destButton.innerHTML = iconSTU['unlock'] + destButton.innerHTML;
                });
            }, 1500);
        };

        document.querySelectorAll('.stu-box-wrap .b > a').forEach(button => {
            button.addEventListener('click', () => {
                if (button.classList.contains('done') || button.classList.contains('loader')) {
                    return;
                }

                const iconElmt = button.querySelector('i');
                const spanElmt = button.querySelector('span');
                const nameBtn = button.getAttribute('data-name');

                iconElmt.innerHTML = iconSTU['loader'];
                iconElmt.classList.add('load');

                if (!button.classList.contains('Ad-C')) {
                    spanElmt.innerText = stSTU.txt.load;

                    if (true) {
                        const alertElmt = button.nextElementSibling;
                        if (alertElmt && alertElmt.classList.contains('stu-alert')) alertElmt.remove();

                        let leaveTime, returnTime, timeAway;

                        const listenerBlur = () => {
                            leaveTime = Date.now();
                        };
                        const listenerFocus = () => {
                            returnTime = Date.now();
                            timeAway = returnTime - leaveTime;
                            console.log(timeAway + 'ms');
                            if (timeAway < 1000) {
                                iconElmt.innerHTML = iconSTU['chevr'];
                                iconElmt.classList.remove('load');
                                spanElmt.innerText = nameBtn;
                                button.insertAdjacentHTML('afterend',
                                    '<div class="stu-alert">☝️ Bạn thực hiện bước <strong>' +
                                    nameBtn +
                                    '</strong> quá nhanh, hãy thực hiện lại một lần nữa!</div>');
                                clearTimeout(processButtonClickTimeout);
                            }
                            window.removeEventListener('blur', listenerBlur);
                            window.removeEventListener('focus', listenerFocus);
                        }

                        window.addEventListener('blur', listenerBlur);
                        window.addEventListener('focus', listenerFocus);
                    } else {
                        sSTT(objStt, button.getAttribute('data-id'));
                    }

                    const processButtonClickTimeout = setTimeout(() => {
                        sSTT(objStt, button.getAttribute('data-id'));
                        processButtonClick(button);
                    }, 6000);

                } else {
                    spanElmt.innerText = 'Đang xác minh...';
                    let configCAd = stSTU['ad-1'];

                    const sAd = isAdVisible(configCAd);

                    if (sAd) {
                        const gAd = document.getElementById(sAd);
                        button.insertAdjacentHTML('afterend', `<p id="notif-ad" class="note">Bước 1: Bấm vào cáo được đánh dấu (sẽ tự động chuyển đến sau vài giây).</br>
																							Bước 2: Ở lại trang quảng cáo đó 10 giây.</br>
																							Bước 3: Quay về và tiếp tục.</p>`);

                        setTimeout(() => {
                            gAd.scrollIntoView({
                                behavior: "smooth",
                                block: "center"
                            });
                            gAd.setAttribute('mark-ad', 'true');
                        }, 5000);

                        const rmAd = () => {
                            sSTT(objStt, button.getAttribute('data-id'));
                            __CLICK(other.lv, 'u');

                            gAd.removeAttribute('mark-ad');

                            console.log('clicked..');

                            setTimeout(() => {
                                document.getElementById('notif-ad').remove();
                                button.scrollIntoView({
                                    behavior: "smooth",
                                    block: "center"
                                });
                                processButtonClick(button);
                            }, 5000);

                        }
                        document.querySelector(`#${sAd} .${configCAd['type-ad']}`).addEventListener(
                            'click', () => {
                                rmAd()
                            }, {
                                once: true
                            });

                        const gAdI = document.querySelector(`#${sAd} ins.adsbygoogle iframe`);
                        if (gAdI != null) {
                            window.addEventListener("blur", () => {
                                if (document.activeElement == gAdI) rmAd();
                            });
                        }

                    } else {
                        setTimeout(() => {
                            processButtonClick(button)
                        }, 1500);
                    }

                }

            });
        })

        if (stSTU && stSTU['direct-ad'].show === true) {
            let cfObj = stSTU['direct-ad'];
            if (cfObj.arrUnit && cfObj.arrUnit[window.location.host]) {
                document.querySelectorAll('.lnk, .unlock').forEach(button => {
                    button.addEventListener('click', () => {
                        if (button.getAttribute('href')) {
                            setTimeout(() => {
                                window.location.href = _rd(cfObj.arrUnit[window.location.host]);
                            }, cfObj.time);
                        }
                    })
                });
            } else {
                console.log('direct-ad không hoạt động vì thiếu target')
            }
        }

        document.querySelectorAll('.stu-box-wrap .d a').forEach(button => {
            button.addEventListener('click', () => {
                if (button.getAttribute('href')) {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var response = this.responseText;
                            console.log(response)
                        }
                    };
                    xhr.open('GET', info.url_count);
                    xhr.send();
                }
            })
        });
        if (stSTU['ad-2'].show == true) {
            let elt = document.querySelector('.stu-box-wrap .b > a[data-id="ad2"]');
            if (elt) {
                elt.addEventListener('click', () => {
                    setTimeout(() => {
                        elt.style.display = 'none';
                    }, 1500);
                });
            }
        }
        const handleNS = () => {
            let obj = objStt;
            if (obj && obj['page'] == 1) {
                obj['page'] += 1
            } else {
                obj['page'] = 1
            }
            xQK.sSS(STTKey, JSON.stringify(obj));
        }
        document.querySelectorAll('.link[data-href="rdm"]').forEach(button => {
            button.addEventListener('click', () => {
                if (button.getAttribute('href')) {
                    handleNS();
                }
            })
        });

        /* add bannerAd */
        if (s_cfLv['banner-ad'] && s_cfLv['banner-ad'].show == true) {
            let cfAd = s_cfLv['banner-ad'];

            if (cfAd['type-ad'] == 'qknetwork') {
                (cfAd.unit).forEach(objST => {
                    let _e = document.getElementById(objST.id);
                    if (_e) {
                        let _h = `<div class="adStu">
									<a class="qknetwork" href='${_rd(objST.links)}' target="_blank" rel="noopener, noreferrer" data-ad-status="filled">
										<img src="${_rd(objST.images)}" alt="Ads by QKNetwork"/>
									</a>
								</div>`;
                        _e.innerHTML = _h;
                    }
                });
            }
        }

    }

    setTimeout(function() {
        let _elmt = document.querySelector('#stuC .stu-box-wrap');
        if (_elmt.querySelector('.loading-stu')) _elmt.innerHTML = 'Đã có lỗi xảy ra : (';
    }, 5000)
    /*]]>*/
</script>
