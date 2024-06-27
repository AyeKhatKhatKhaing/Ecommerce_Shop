<div>
    @php
        $label_name = "name_".lngKey();
    @endphp
    @if(strtolower($label->name_en) == 'new season' || strtolower($label->name_en) == 'newseason')
        <p
            class="min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] rem-text-13 w-fit new-season rem-btn-polygon absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
            {{ $label->$label_name }}</p>
    @elseif(strtolower($label->name_en) == 'new star' || strtolower($label->name_en) == 'newstar')
        <p
            class="min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] rem-text-13 w-fit new-star rem-btn-polygon absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
            {{ $label->$label_name }}</p>
    @elseif(strtolower($label->name_en) == 'hot')
        <p
            class="min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] rem-text-13 w-fit status-hot rem-btn-polygon absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
            {{ $label->$label_name }}</p>
    @else
        <p
            class="min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] rem-text-13 w-fit status-hot rem-btn-polygon absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
            {{ $label->$label_name }}</p>
    @endif

</div>