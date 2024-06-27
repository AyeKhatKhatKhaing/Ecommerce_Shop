    <div class="pt-10 flex items-center justify-between flex-wrap">
        <p class="rem-text-16 montserrat text-[#1C1D1D]">{{ __('frontend.member.show_result') }}</p>
        <div class="table-pagination flex items-center xl:gap-[5px]">
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="#" class="page-active montserrat-medium rem-text-16 text-remDF py-1 px-[10px] mr-1 xl:mr-0 border border-remDF" >{{ $page }} </a>
                        @else
                        <a href="{{ $url }}" class="montserrat-medium rem-text-16 text-remDF py-1 px-[10px] mr-1 xl:mr-0 border border-remDF" >{{ $page }} </a>
                        @endif
                    @endforeach
                @endif   
            @endforeach
        </div>
    </div>