<div>
    @php
        $label_name = "name_".lngKey();
    @endphp
    @if(strtolower($label->name_en) == 'new season' || strtolower($label->name_en) == 'newseason')
        <p
            class="rem-text-9 md:rem-text-13 new-season min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] w-fit rem-btn-polygon absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
            {{ $label->$label_name }}</p>
    @elseif(strtolower($label->name_en) == 'new star' || strtolower($label->name_en) == 'newstar')
        <p
            class="rem-text-9 md:rem-text-13 new-star min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] w-fit rem-btn-polygon absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
            {{ $label->$label_name }}</p>
    @elseif(strtolower($label->name_en) == 'hot')
        <p
            class="rem-text-9 md:rem-text-13 hot-banner min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] w-fit rem-btn-polygon absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
            {{ $label->$label_name }}</p>
    @else
        <p
            class="rem-text-9 md:rem-text-13 hot-banner min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] w-fit rem-btn-polygon absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
            {{ $label->$label_name }}</p>
    @endif

</div>