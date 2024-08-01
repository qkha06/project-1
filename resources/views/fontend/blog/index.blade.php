@extends('layouts.blog')

@section('title', 'Blog')

@section('content')

@include('fontend.blog.home.components.pinned-post')
						
@include('fontend.blog.home.components.latest-post')

@endsection

@section('sidebar')
    @include('partials.blog.sidebar')
@endsection
