@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($privacypolicy) && isset($privacypolicy->meta_titles) ? $privacypolicy->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($privacypolicy) && isset($privacypolicy->meta_titles) ? $privacypolicy->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($privacypolicy) && isset($privacypolicy->meta_descriptions) ? $privacypolicy->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($privacypolicy) && isset($privacypolicy->meta_descriptions) ? $privacypolicy->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.privacy-policy') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($privacypolicy) ? asset($privacypolicy->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($privacypolicy) ? $privacypolicy->meta_image_alt : '' }}">
@endsection
@section('content')
@php
    $privacy_title        = "title_".lngKey();
    $privacy_description  = "description_".lngKey();
@endphp
<div component-name="rem-privacy-policy" class="para para-container my-24">
    <h1>{{ isset($privacypolicy->$privacy_title) ? $privacypolicy->$privacy_title : '' }}</h1>
    <br />
    {!! isset($privacypolicy->$privacy_description) ? $privacypolicy->$privacy_description : '' !!}
</div>
@endsection