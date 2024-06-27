@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($blog_detail) && isset($blog_detail->meta_titles) ? $blog_detail->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($blog_detail) && isset($blog_detail->meta_titles) ? $blog_detail->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($blog_detail) && isset($blog_detail->meta_descriptions) ? $blog_detail->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($blog_detail) && isset($blog_detail->meta_descriptions) ? $blog_detail->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.blog.detail', $blog_detail->slug) }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($blog_detail) ? asset($blog_detail->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($blog_detail) ? $blog_detail->meta_image_alt : '' }}">
@endsection
@section('content')
    <div component-name="rem-bloginner" class="pt-10 pb-20 md:pt-60 md:pb-100 rem-container160">
        <div class="text-center pb-10">
            <p class="montserrat rem-text-18 text-rembrown pb-4">{{ isset($blog_detail) && isset($blog_detail->blog_category) ? $blog_detail->blog_category->names[lngKey()] : '' }}</p>
            <p class="montserrat-bold rem-text-24 text-remdark pb-4">{{ isset($blog_detail) && isset($blog_detail->titles) ? $blog_detail->titles[lngKey()] : '' }}</p>
            <p class="montserrat rem-text-18 text-rembrown pb-10">{{ isset($blog_detail) && isset($blog_detail->published_date) ? date('M d, Y', strtotime($blog_detail->published_date)) : '' }}</p>
            <div class="flex items-center justify-center">
                <p class="montserrat rem-text-18 text-rembrown pr-10">Share</p>
                <div class="flex items-center xl:gap-[30px]">
                    <img src="{{ asset('frontend/img/inner-fb.svg') }}" alt="facebook">
                    <img src="{{ asset('frontend/img/inner-twitter.svg') }}" alt="twitter">
                    <img src="{{ asset('frontend/img/ig.svg') }}" alt="instagram">
                </div>
            </div>
        </div>
        {!! isset($blog_detail) && isset($blog_detail->descriptions) ? $blog_detail->descriptions[lngKey()] : '' !!}
        {{-- <img src="./img/blog-inner.png" alt="blog inner" class="pb-60">
        <p class="montserrat rem-text-18 text-rembrown pb-60">Lorem Ipsum is simply dummy text of the printing and
            typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially
            unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of
            Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
            been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book. </p>
        <div class="md:flex xl:gap-[60px] pb-6 md:pb-60 imgtext-container">
            <p class="md:flex-[none] md:w-1/2">
                <img src="./img/blog-inner1.png" alt="item image">
            </p>
            <div class="md:flex-[none] md:w-1/2 imgtext-content">
                <p class="montserrat rem-text-18 text-remdark">Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                    1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                    book.<br /><br />It has survived not only five centuries, but also the leap into electronic
                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
                    of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                    software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy
                    text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                    dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                    to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry.</p>
            </div>
        </div>
        <div class="md:flex xl:gap-[60px] flex-row-reverse pb-6 md:pb-60 imgtext-container">
            <p class="md:flex-[none] md:w-1/2">
                <img src="./img/blog-inner2.png" alt="item image">
            </p>
            <div class="md:flex-[none] md:w-1/2 imgtext-content">
                <p class="montserrat rem-text-18 text-remdark">Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                    1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                    book.<br /><br />It has survived not only five centuries, but also the leap into electronic
                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
                    of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                    software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy
                    text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                    dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                    to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry.</p>
            </div>
        </div>
        <div class="md:flex xl:gap-[60px]  imgtext-container">
            <p class="md:flex-[none] md:w-1/2">
                <img src="./img/blog-inner3.png" alt="item image">
            </p>
            <div class="md:flex-[none] md:w-1/2 imgtext-content">
                <p class="montserrat rem-text-18 text-remdark">Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                    1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                    book.<br /><br />It has survived not only five centuries, but also the leap into electronic
                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
                    of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                    software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy
                    text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                    dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                    to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry.</p>
            </div>
        </div> --}}
    </div>
@endsection