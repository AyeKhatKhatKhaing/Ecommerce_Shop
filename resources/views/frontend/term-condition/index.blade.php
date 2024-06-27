@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($termcondition) && isset($termcondition->meta_titles) ? $termcondition->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($termcondition) && isset($termcondition->meta_titles) ? $termcondition->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($termcondition) && isset($termcondition->meta_descriptions) ? $termcondition->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($termcondition) && isset($termcondition->meta_descriptions) ? $termcondition->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.term-condition') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($termcondition) ? asset($termcondition->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($termcondition) ? $termcondition->meta_image_alt : '' }}">
@endsection
@section('content')
@php
    $term_condition_title        = "title_".lngKey();
    $term_condition_description  = "description_".lngKey();
@endphp
<div component-name="rem-terms-and-contitions" class="para para-container my-24">
    <h1>{{ isset($termcondition->$term_condition_title) ? $termcondition->$term_condition_title : '' }}</h1>
    <br />
    {!! isset($termcondition->$term_condition_description) ? $termcondition->$term_condition_description : '' !!}
</div>

@endsection