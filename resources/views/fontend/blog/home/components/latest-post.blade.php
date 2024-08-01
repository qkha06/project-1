<div class="section" id="main-widget">
    <div class="widget Blog" id="Blog1">
        <div class="blogTtl hm">
            <h3 class="title">Latest Posts</h3>
        </div>
        <div class="blogPts">
            @foreach ($posts as $article)
            <article class="ntry">
                <div class="pThmb">
                    <a class="thmb" href="{{ route('blog.show', $article['slug']) }}">
                        <img alt="{{ $article['title'] }}" class="imgThm lazy" data-src="{{ $article['image'] }}"  >
                        <noscript><img alt='{{ $article['title'] }}' class='imgThm' src='{{ $article['image'] }}' /></noscript>
                    </a>
                    @if (count($article->views))
                    <div class="iFxd">
                        <a aria-label="Views" class="cmnt" data-text="{{ $article->views->sum('views') }}" role="button">
                            <svg viewBox="0 0 576 512"><path d="M288 128C217.3 128 160 185.3 160 256s57.33 128 128 128c70.64 0 128-57.32 128-127.9C416 185.4 358.7 128 288 128zM288 352c-52.93 0-96-43.06-96-96s43.07-96 96-96c52.94 0 96 43.02 96 96.01C384 308.9 340.1 352 288 352zM572.5 238.1C518.3 115.5 410.9 32 288 32S57.69 115.6 3.469 238.1C1.563 243.4 0 251 0 256c0 4.977 1.562 12.6 3.469 17.03C57.72 396.5 165.1 480 288 480s230.3-83.58 284.5-206.1C574.4 268.6 576 260.1 576 256C576 251 574.4 243.4 572.5 238.1zM543.2 260.2C492.3 376 394.5 448 288 448c-106.5 0-204.3-71.98-255-187.3C32.58 259.6 32.05 256.9 31.1 256.2c.0547-1.146 .5859-3.783 .7695-4.363C83.68 135.1 181.5 64 288 64c106.5 0 204.3 71.98 255 187.3c.3945 1.08 .9238 3.713 .9785 4.443C543.9 256.9 543.4 259.6 543.2 260.2z"></path></svg>
                        </a>
                    </div>
                    @endif
                </div>
                <div class="pCntn">
                    @if (isset($article['category']) && !empty($article['category']))
                    <div class="pHdr pSml">
                        <div class="aNm">
                            <div class="pLbls" data-text="in">
                                <a aria-label="{{ $article['category']->name }}" data-text="{{ $article['category']->name }}" href="/search/category/{{ $article['category']->name }}"
                                    rel="category">
                                </a>
                            </div>
                        </div>
                    </div> 
                    @endif

                    <h2 class="pTtl aTtl">
                        <a data-text="{{ $article['title'] }}"
                            href="{{ route('blog.show', $article['slug']) }}" rel="bookmark"> {{ $article['title'] }} </a>
                    </h2>
                    <div class="pSnpt"> {{ $article['content'] }} </div>
                    <div class="pInf pSml">
                        <time class="aTtmp pTtmp pbl timeAgo" datetime="{{ $article['created_at'] }}"></time>
                        <a aria-label="Read more" class="pJmp" data-text="Keep reading"
                            href="{{ route('blog.show', $article['slug']) }}"></a>
                    </div>
                    <script type="application/ld+json">
                        {
                            "@context": "http://schema.org"
                            , "@type": "BlogPosting"
                            , "mainEntityOfPage": {
                                "@type": "WebPage"
                                , "@id": "{{ route('blog.show', $article['slug']) }}"
                            }
                            , "headline": "{{ $article['title'] }}"
                            , "description": "Daftar semua fitur yang tersedia pada template iMagz            Kami berusaha membuat template yang memiliki fitur lengkap serta mudah untuk digunakan, setelah pengembangan yang lumayan memakan waktu a&#8230;"
                            , "datePublished": "{{ $article['created_at'] }}"
                            , "dateModified": "2021-11-30T12:22:21+08:00"
                            , "image": {
                                "@type": "ImageObject"
                                , "url": "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjWbrtF1PFgzwEn21SO6K6H0LGJi9ciauHMtP9RHwiZlScJtpRm9uc7lDa-pbDOxY0zPXXkqS6FgYtECZf121rnYTczXkl7K3I66z1oeDcMF3G9WHfF_qkvUvHhjGCY687_xUf3BFAfOUk/w1200-h630-p-k-no-nu/imagz-features.png"
                                , "height": 630
                                , "width": 1200
                            }
                            , "publisher": {
                                "@type": "Organization"
                                , "name": "iMagz"
                                , "logo": {
                                    "@type": "ImageObject"
                                    , "url": "https://1.bp.blogspot.com/-50s1RMWV7jI/X8OaYjJcMiI/AAAAAAAAQK4/sWcpbaP0Sq0hsW473Vnb8AyBvYvdSQEPwCNcBGAsYHQ/s0/jd-logo.png"
                                    , "width": 297
                                    , "height": 45
                                }
                            }
                            , "author": {
                                "@type": "Person"
                                , "name": "Maki M."
                                , "url": "https://www.blogger.com/profile/08446403296417996016"
                                , "image": "//blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgzF9AGWE18_IM-gLFtDK0JRz5yLirqNbTRIlzvV7sAYiOuPRaBqzZxvCH0qPws9Bm6fk63hcq8Ul3vzqXOL6LnCVNiEb0TdcOJPLkbo0wWjeX2weHNfOmkTFUXewBVnw/s113/AGNmyxbI5mHQwE64pM7LeEqCa574TGg6Rb_F3WRXHkgkYmw"
                            }
                        }

                    </script>
                </div>
                </article>
            @endforeach

        </div>
        <div class="blogPg" id="LoadMorePosts"><a aria-label="Tải thêm bài đăng" class="jsLd" data-text="Tải thêm bài đăng"
                href="javascript:;"></a></div>
    </div>
</div>

<script src="/fontend/js/blog/simpleAjax.js"></script>
