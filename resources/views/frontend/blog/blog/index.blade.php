@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($blog_seo) && isset($blog_seo->meta_titles) ? $blog_seo->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($blog_seo) && isset($blog_seo->meta_titles) ? $blog_seo->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($blog_seo) && isset($blog_seo->meta_descriptions) ? $blog_seo->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($blog_seo) && isset($blog_seo->meta_descriptions) ? $blog_seo->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.blog') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($blog_seo) ? asset($blog_seo->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($blog_seo) ? $blog_seo->meta_image_alt : '' }}">
@endsection
@section('content')
    <div component-name="rem-banner">
        <div class="relative">
            <img src="{{ asset('frontend/img/blog-banner.png') }}" class="min-h-[200px] object-cover lg:min-h-auto w-full"
                alt="banner image">
        </div>
    </div>
    <div component-name="rem-blog" class="rem-container160 pt-10 md:pt-20 pb-20 md:pb-100">
        <h2 class="montserrat-semibold rem-text-40 text-blackcustom pb-9 lg:pb-60 text-center">{{__('frontend.blog.blog')}}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:gap-[35px]">
            @if (isset($blogs))
                @foreach ($blogs as $blog)
                    <a href="{{ route('front.blog.detail', $blog->slug) }}" class="blog-card pb-3 sm:p-3 xl:p-0 xl:pb-0 last-of-type:pb-0">
                        <div>
                            <img src="{{ asset($blog->blog_image) }}" alt="{{ isset($blog) ? $blog->blog_image_alt : '' }}">
                            <p class="pt-[30px] montserrat rem-text-18 text-remdark">{{ isset($blog->blog_category) ? $blog->blog_category->names[lngKey()] : '' }}</p>
                            <p class="pt-4 montserrat-bold rem-text-24 text-remdark">{{ isset($blog) && isset($blog->titles) ? $blog->titles[lngKey()] : '' }}</p>
                        </div>
                        {!! isset($blog) && isset($blog->short_descriptions) ? $blog->short_descriptions[lngKey()] : '' !!}
                        <p class="pt-4 montserrat rem-text-18 text-rembrown">{{ isset($blog) && isset($blog->published_date) ? date('M d, Y', strtotime($blog->published_date)) : '' }}</p>
                    </a>
                @endforeach 
            @endif
        </div>
        <div class="pt-10 md:pt-60 justify-center flex items-center xl:gap-[5px]">
            <a href="#"
                class="page-active montserrat-medium rem-text-16 text-remDF py-1 px-[10px] mr-1 xl:mr-0 border border-remDF">1</a>
            <a href="#"
                class="montserrat-medium rem-text-16 text-remDF py-1 px-[10px] mr-1 xl:mr-0 border border-remDF">2</a>
            <a href="#"
                class="montserrat-medium rem-text-16 text-remDF py-1 px-[10px] mr-1 xl:mr-0 border border-remDF">3</a>
            <a href="#" class="montserrat-medium rem-text-16 text-remDF py-1 px-[10px] mr-1 xl:mr-0">.</a>
            <a href="#" class="montserrat-medium rem-text-16 text-remDF py-1 px-[10px] mr-1 xl:mr-0">.</a>
            <a href="#" class="montserrat-medium rem-text-16 text-remDF py-1 px-[10px]">.</a>
        </div>
    </div>
@endsection