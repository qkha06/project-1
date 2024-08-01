<div class="secIn">
    <!--[ Credit ]-->
    <div class="cdtIn section" id="credit-widget">
        <div class="widget">
            <div class="fotCd">
                <span class="credit">© <span id="getYear">{{ date('Y') }}</span><bdi> ‧ <a
                            href="https://www.link4sub.com/">LINK4SUB</a></bdi>
                </span>
                <span class="creator pSml">Distributed By <a href="https://www.quockhablog.com/">NGÔ QUỐC KHA</a></span>
            </div>
        </div>
        <div class="widget PageList" data-version="2" id="PageList88">
            <input class="ftI hidden" id="offFot" type="checkbox">
            <label class="ftL" for="offFot">
                <svg class="line" viewBox="0 0 24 24">
                    <path d="M15 7h3a5 5 0 0 1 5 5 5 5 0 0 1-5 5h-3m-6 0H6a5 5 0 0 1-5-5 5 5 0 0 1 5-5h3"></path>
                    <line x1="8" x2="16" y1="12" y2="12"></line>
                </svg>
                <svg class="line u" viewBox="0 0 24 24">
                    <g
                        transform="translate(12.000000, 12.000000) rotate(-180.000000) translate(-12.000000, -12.000000) translate(5.000000, 8.500000)">
                        <path d="M14,0 C14,0 9.856,7 7,7 C4.145,7 0,0 0,0"></path>
                    </g>
                </svg>
            </label>
            <ul class="ftMn">
                <li>
                    <span>
                        Terms of Use
                    </span>
                </li>
                <li>
                    <span>
                        Disclaimer
                    </span>
                </li>
                <li>
                    <span>
                        Privacy
                    </span>
                </li>
                <li>
                    <span>
                        Contact
                    </span>
                </li>
                <li>
                    <span>
                        About
                    </span>
                </li>
            </ul>
            <label class="fCls" for="offFot"></label>
        </div>
        <div class="widget LinkList footR" id="LinkList88">
            <div class="fLang fontM">
                <input class="cbLang hidden" id="pLang" type="checkbox">

                <label for="pLang" class="language fc-ovl">
                    <svg class="line" viewBox="0 0 24 24">
                        <path d="M19.06 18.6699L16.92 14.3999L14.78 18.6699"></path>
                        <path d="M15.1699 17.9099H18.6899"></path>
                        <path
                            d="M16.9201 22.0001C14.1201 22.0001 11.8401 19.73 11.8401 16.92C11.8401 14.12 14.1101 11.8401 16.9201 11.8401C19.7201 11.8401 22.0001 14.11 22.0001 16.92C22.0001 19.73 19.7301 22.0001 16.9201 22.0001Z">
                        </path>
                        <path
                            d="M5.02 2H8.94C11.01 2 12.01 3.00002 11.96 5.02002V8.94C12.01 11.01 11.01 12.01 8.94 11.96H5.02C3 12 2 11 2 8.92999V5.01001C2 3.00001 3 2 5.02 2Z">
                        </path>
                        <path d="M9.00995 5.84985H4.94995"></path>
                        <path d="M6.96997 5.16992V5.84991"></path>
                        <path d="M7.98994 5.83984C7.98994 7.58984 6.61994 9.00983 4.93994 9.00983"></path>
                        <path d="M9.0099 9.01001C8.2799 9.01001 7.61991 8.62 7.15991 8"></path>
                        <path d="M2 15C2 18.87 5.13 22 9 22L7.95 20.25"></path>
                        <path d="M22 9C22 5.13 18.87 2 15 2L16.05 3.75"></path>
                    </svg>
                </label>

                <div class="Ilang iPu">
                    <div class="ipopUp-lang">
                        @php
                            $availableLanguages = [
                                'en' => 'English',
                                'vi' => 'VietNam',
                            ];

                            foreach ($availableLanguages as $code => $language) {
                                $mark = App::currentLocale() == $code ? 'nLang a' : 'nLang';
                                echo "<a class='$mark' href='" . URL('/') . "/lang/$code'>$language</a>";
                            }
                        @endphp
                    </div>
                </div>
            </div>
            <span>|</span>
            <ul class="mSoc">
                <li>
                    <a aria-label="Facebook" class="a tIc bIc" href="https://www.facebook.com/nqckha.06" rel="noopener"
                        role="button" target="_blank">
                        <svg viewBox="0 0 32 32">
                            <path
                                d="M24,3H8A5,5,0,0,0,3,8V24a5,5,0,0,0,5,5H24a5,5,0,0,0,5-5V8A5,5,0,0,0,24,3Zm3,21a3,3,0,0,1-3,3H17V18h4a1,1,0,0,0,0-2H17V14a2,2,0,0,1,2-2h2a1,1,0,0,0,0-2H19a4,4,0,0,0-4,4v2H12a1,1,0,0,0,0,2h3v9H8a3,3,0,0,1-3-3V8A3,3,0,0,1,8,5H24a3,3,0,0,1,3,3Z">
                            </path>
                        </svg>
                    </a>
                </li>
                <li>
                    <a aria-label="Telegram" class="a tIc bIc" href="https://t.me/nqkhadz" rel="noopener" role="button"
                        target="_blank">
                        <svg viewBox="0 0 32 32">
                            <path
                                d="M24,28a1,1,0,0,1-.62-.22l-6.54-5.23a1.83,1.83,0,0,1-.13.16l-4,4a1,1,0,0,1-1.65-.36L8.2,18.72,2.55,15.89a1,1,0,0,1,.09-1.82l26-10a1,1,0,0,1,1,.17,1,1,0,0,1,.33,1l-5,22a1,1,0,0,1-.65.72A1,1,0,0,1,24,28Zm-8.43-9,7.81,6.25L27.61,6.61,5.47,15.12l4,2a1,1,0,0,1,.49.54l2.45,6.54,2.89-2.88-1.9-1.53A1,1,0,0,1,13,19a1,1,0,0,1,.35-.78l7-6a1,1,0,1,1,1.3,1.52Z">
                            </path>
                        </svg>
                    </a>
                </li>
                <li>
                    <a aria-label="Youtube" class="a tIc bIc" href="https://www.youtube.com/@Link4SubOfficial"
                        rel="noopener" role="button" target="_blank">
                        <svg viewBox="0 0 32 32">
                            <path
                                d="M29.73,9.9A5,5,0,0,0,25.1,5.36a115.19,115.19,0,0,0-18.2,0A5,5,0,0,0,2.27,9.9a69,69,0,0,0,0,12.2A5,5,0,0,0,6.9,26.64c3,.24,6.06.36,9.1.36s6.08-.12,9.1-.36a5,5,0,0,0,4.63-4.54A69,69,0,0,0,29.73,9.9Zm-2,12A3,3,0,0,1,25,24.65a113.8,113.8,0,0,1-17.9,0,3,3,0,0,1-2.78-2.72,65.26,65.26,0,0,1,0-11.86A3,3,0,0,1,7.05,7.35C10,7.12,13,7,16,7s6,.12,9,.35a3,3,0,0,1,2.78,2.72A65.26,65.26,0,0,1,27.73,21.93Z">
                            </path>
                            <path
                                d="M21.45,15.11l-8-4A1,1,0,0,0,12,12v8a1,1,0,0,0,.47.85A1,1,0,0,0,13,21a1,1,0,0,0,.45-.11l8-4a1,1,0,0,0,0-1.78ZM14,18.38V13.62L18.76,16Z">
                            </path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
