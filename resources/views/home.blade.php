@extends('app')

@section('page.title', 'Simple')
@section('content')
    <!-- slider-banner here-->
    @include('layout.home.slider-banner')

    <!-- category here-->
    @include('layout.home.categories__banner')

    <!-- new arrival here-->
    @include('layout.home.new-arrival')

    <!-- weekly product-->
    @include('layout.home.weekly-best')

    <!-- blog -->
    @include('layout.home.blog')
@endsection

