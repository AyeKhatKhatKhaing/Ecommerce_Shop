@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($commonproblem) && isset($commonproblem->meta_titles) ? $commonproblem->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($commonproblem) && isset($commonproblem->meta_titles) ? $commonproblem->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($commonproblem) && isset($commonproblem->meta_descriptions) ? $commonproblem->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($commonproblem) && isset($commonproblem->meta_descriptions) ? $commonproblem->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.common-problem') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($commonproblem) ? asset($commonproblem->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($commonproblem) ? $commonproblem->meta_image_alt : '' }}">
@endsection
@section('content')
@php
    $common_problem_title        = "title_".lngKey();
    $common_problem_description  = "description_".lngKey();
@endphp
<div component-name="rem-common-problem" class="para para-container my-24">
    <h1>{{ isset($commonproblem->$common_problem_title) ? $commonproblem->$common_problem_title : '' }}</h1>
    <br />
    {!! isset($commonproblem->$common_problem_description) ? $commonproblem->$common_problem_description : '' !!}
</div>
@endsection