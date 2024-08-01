@extends('layouts.clients.home_layout')

@section('content')

<div class="mainIn">
	<div class="secIn">
		<!--[ Blog content ]-->
		<div class="blogCont">
			<div class="blogIn">
				<!--[ Ad content ]-->
				<div class="blogAd">
					<div class="section" id="horizontal-ad">
						<div class="widget HTML" data-version="2" id="HTML91">
							<div class="adB" data-text="Iklan ada di sini"></div>
						</div>
					</div>
				</div>
				<div class="blogM">
					<!--[ Main content ]-->
					<main class="blogItm mainbar">
						<div class="section" id="main-widget">
							<div class="widget Blog" data-version="2" id="Blog1">
								<div class="blogPts">
									<article class="ntry ps post">
										<div class="brdCmb" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">
											<div class="hm" itemprop="itemListElement" itemscope="itemscope" itemtype="https://schema.org/ListItem">
												<a href="{{ URL('/') }}" itemprop="item"><span itemprop="name">Trang chủ</span></a>
												<meta content="1" itemprop="position">
											</div>
											<div class="tl" data-text="{{ $pageData->title }}"></div>
										</div>
										<h1 class="pTtl aTtl itm">
											<span> {{ $pageData->title }} </span>
										</h1>
										<div class="pInr">
											<div class="pEnt" id="postID-4486362289971269830">
												<div class="pS post-body postBody" id="postBody">{!! $pageData->content !!}</div>
											</div>

										</div>
									</article>
								</div>
							</div>
						</div>
					</main>
				</div>
			</div>
		</div>
	</div>
</div>

    @endsection