@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($aboutremfly) && isset($aboutremfly->meta_titles) ? $aboutremfly->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($aboutremfly) && isset($aboutremfly->meta_titles) ? $aboutremfly->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($aboutremfly) && isset($aboutremfly->meta_descriptions) ? $aboutremfly->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($aboutremfly) && isset($aboutremfly->meta_descriptions) ? $aboutremfly->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.about-remfly') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($aboutremfly) ? asset($aboutremfly->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($aboutremfly) ? $aboutremfly->meta_image_alt : '' }}">
@endsection
@section('content')
@php
    $about_remfly_description      = "description_".lngKey();
    $about_remfly_key_operation    = "key_operation_".lngKey();
@endphp
<div component-name="rem-banner">
    <div class="relative">
        <img src="{{ isset($aboutremfly) && isset($aboutremfly->banner_image) ? asset($aboutremfly->banner_image) : '' }}" class="min-h-[200px] object-cover lg:min-h-auto w-full" alt="{{ isset($aboutremfly) && isset($aboutremfly->banner_image_alt) ? $aboutremfly->banner_image_alt : '' }}">
        <p class="banner-text text-whitez montserrat-bold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">{{ isset($aboutremfly) && isset($aboutremfly->banner_titles[lngKey()]) ? $aboutremfly->banner_titles[lngKey()] : '' }}</p>
    </div>
</div>
<div component-name="rem-about" class="container200 py-9 md:pt-20 md:pb-60">
    {!! isset($aboutremfly->$about_remfly_description) ? $aboutremfly->$about_remfly_description : '' !!}
</div>
<div component-name="rem-aboutkey" class="container200 pb-20 md:pb-100">
   {!!  isset($aboutremfly->$about_remfly_key_operation) ? $aboutremfly->$about_remfly_key_operation : '' !!}
</div>
@endsection