<div class="flex items-center pl-[10px]">
    @php
        $productRating = $product->product_rating;
    @endphp
    @if($productRating)
        @if($productRating->score_rp)
            <p
                class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16">
                RP</p>
            <p class="montserrat-medium rem-text-16 text-remdark px-[10px]">{{ $productRating->score_rp }} </p>
        @endif
        @if($productRating->score_ws)
            <p
                class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16">
                WS</p>
            <p class="montserrat-medium rem-text-16 text-remdark px-[10px]">{{ $productRating->score_ws }} </p>
        @endif
        @if($productRating->score_jh)
            <p
                class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16">
                JH</p>
            <p class="montserrat-medium rem-text-16 text-remdark px-[10px]">{{ $productRating->score_jh }} </p>
        @endif
        @if($productRating->score_ja)
            <p
                class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16">
                JA</p>
            <p class="montserrat-medium rem-text-16 text-remdark px-[10px]">{{ $productRating->score_ja }} </p>
        @endif
        @if($productRating->score_js)
            <p
                class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16">
                JS</p>
            <p class="montserrat-medium rem-text-16 text-remdark px-[10px]">{{ $productRating->score_js }} </p>
        @endif
        @if($productRating->score_jr)
            <p
                class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16">
                JR</p>
            <p class="montserrat-medium rem-text-16 text-remdark px-[10px]">{{ $productRating->score_jr }} </p>
        @endif
    @endif
</div>