
<div class="section" id="top-widget">
    <div class="widget FeaturedPost" data-version="2" id="FeaturedPost1">
        <h2 class="title">Pinned Post</h2>
        <div class="itemFt" role="feed">
            <article class="itm">
                <div class="iThmb pThmb">
                    <a class="thmb" href="/blog/{{ $pinned['slug'] }}">
                        <img alt="{{ $pinned['title'] }}" class="imgThm lazy loaded"
                            data-src="{{ $pinned['image'] }}"
                            src="{{ $pinned['image'] }}">
                        <noscript><img alt='{{ $pinned['title'] }}' class='imgThm'
                                src='{{ $pinned['image'] }}' /></noscript>
                    </a>
                    <div class="iFxd">
                        <a aria-label="Comments" class="cmnt" data-text="13"
                            href="/blog/{{ $pinned['slug'] }}#comment" role="button">
                            <svg class="line" viewBox="0 0 24 24">
                                <g transform="translate(2.000000, 2.000000)">
                                    <path
                                        d="M17.0710351,17.0698449 C14.0159481,20.1263505 9.48959549,20.7867004 5.78630747,19.074012 C5.23960769,18.8538953 1.70113357,19.8338667 0.933341969,19.0669763 C0.165550368,18.2990808 1.14639409,14.7601278 0.926307229,14.213354 C-0.787154393,10.5105699 -0.125888852,5.98259958 2.93020311,2.9270991 C6.83146881,-0.9756997 13.1697694,-0.9756997 17.0710351,2.9270991 C20.9803405,6.8359285 20.9723008,13.1680512 17.0710351,17.0698449 Z">
                                    </path>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="iCtnt">
                    @if (isset($pinned['category']) && !empty($pinned['category']))
                    <div class="pHdr pSml">
                        <div class="aNm">
                            <div class="pLbls" data-text="in">
                                <a aria-label="{{ $pinned['category']->name }}" data-text="{{ $pinned['category']->name }}" href="{{ route('blog.categories', $pinned['category']->slug) }}"
                                    rel="category">
                                </a>
                            </div>
                        </div>
                    </div> 
                    @endif
                    <h3 class="pTtl aTtl"><a href="/blog/{{ $pinned['slug'] }}">{{ $pinned['title'] }}</a></h3>
                    <div class="pSnpt">{{ $pinned['content'] }}</div>
                    <div class="pInf pSml">
                        <time class="aTtmp pbl timeAgo" datetime="{{ $pinned['created_at'] }}"></time>
                        <a aria-label="Read more" class="pJmp" data-text="Keep reading" href="/blog/{{ $pinned['slug'] }}"></a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>