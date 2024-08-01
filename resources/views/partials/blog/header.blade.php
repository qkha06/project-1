<div class="headCn">
    <div class="headIn secIn">

        <div class="headD headL">
            <!--[ Header widget ]-->
            <div class="headN section" id="header-title">
                <div class="widget Header" id="Header1">
                    <div class="headInnr">
                        <h1 class="headH hasSub">
                            @if (str_contains(request()->url(), '/blog/'))
                                <a class="headTtl"
                                    href="{{ $_settings['web_blog_url'] ?? route('blog.index') }}">{{ $_settings['web_name'] ?? env('APP_NAME') }}</a>
                            @else
                                <span class="headTtl">{{ $_settings['web_name'] ?? env('APP_NAME') }}</span>
                            @endif
                            <span class="headSub" data-text="blog"></span>
                        </h1>
                    </div>
                    <div class="headDsc hidden">Link4Sub is Sub to Unlock service, you can create a link at any time
                        without having to create an account.</div>
                </div>
            </div>
        </div>

        <div class="headD headR">
            <div class="headI">
                <!--[ Header menu ]-->
                <div class="headM">
                    <div class="mnBr">
                        <div class="mnBrs">
                            <div class="mnH">
                                <label aria-label="Close" class="c" data-text="Close" for="offNav"></label>
                            </div>
                            <div class="mnMen section" id="header-Menu">

                                <ul class="mnMn">
                    
                                    <li>
                                        <a class="a" href="{{ route('home.index') }}">
                                            <span class="n">Go to Link4Sub.com</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="button" href="https://t.me/qckha06" target="_blank">
                                            <i class="icon demo"></i>
                                            <span class="n">Liên hệ</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <label class="fCls" for="offNav"></label>
                </div>

                <!--[ Header icon ]-->
                <div class="headP section" id="header-icon">
                    <ul class="headIc">
                        <li class="isMn">
                            <label class="tNav tIc bIc" for="offNav">
                                <svg class="line" viewBox="0 0 24 24">
                                    <line x1="3" x2="21" y1="12" y2="12"></line>
                                    <line x1="3" x2="21" y1="5" y2="5"></line>
                                    <line x1="3" x2="21" y1="19" y2="19"></line>
                                </svg>
                            </label>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>
