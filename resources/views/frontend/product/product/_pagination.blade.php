{{-- @if ($paginator->hasPages()) --}}
    <div
        class="product-pagination py-10 md:pb-20 flex items-center xl:gap-[10px] justify-center lg:justify-end">
        @if ($paginator->onFirstPage())
            <a href=""><img src="{{ asset('frontend/img/arrow-left.svg') }}" alt="arrow right" class="rotate-180 opacity-30"></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><img src="{{ asset('frontend/img/arrow-left.svg') }}" alt="arrow right" class="rotate-180 opacity-30"></a>
        @endif
        <div class="flex flex-row items-center mx-2 3xs:mx-[29px]">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <button class="disabled"><span>{{ $element }}</span></button>
                @endif
                <p class="montserrat text-[#1C1D1D] rem-text-16">
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                Page {{ $page }} 
                            @endif
                        @endforeach
                    @endif
                    of {{ count($element) }}
                </p>
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><img src="{{ asset('frontend/img/arrow-left.svg') }}" alt="arrow right"></a>
        @else
            <a href="{{ $paginator->nextPageUrl() }}"><img src="{{ asset('frontend/img/arrow-left.svg') }}" alt="arrow right"></a>
        @endif
    </div>
{{-- @endif --}}
