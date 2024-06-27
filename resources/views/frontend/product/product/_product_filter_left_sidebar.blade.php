<div class="w-full lg:w-auto lg:flex-[0_1_25%] lg:max-w-[25%]">
    <div component-name="rem-productsidebar" class="rem-productsidebar ">
        <div>
            <div class="flex lg:block items-center justify-between">
                <div class="flex items-center justify-between">
                    <p class="montserrat-semibold text-blackcustom">{{__('frontend.product.filter')}}</p>
                    <button type="button" onclick="window.location.href='{{ url($breadcrumb['url'] ?? '/product') }}'"
                        class="montserrat text-blackcustom underline ml-5 lg:ml-0"
                        id="filter-clearall">{{__('frontend.product.clear_all')}}</button>
                </div>
                <p class="lg:hidden" onclick="hideSidebar()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                        fill="none">
                        <path
                            d="M15.2502 4.75828C15.1731 4.68102 15.0815 4.61973 14.9807 4.57792C14.8799 4.5361 14.7718 4.51457 14.6627 4.51457C14.5535 4.51457 14.4455 4.5361 14.3447 4.57792C14.2439 4.61973 14.1523 4.68102 14.0752 4.75828L10.0002 8.82494L5.92519 4.74994C5.84803 4.67279 5.75644 4.61159 5.65564 4.56984C5.55484 4.52808 5.4468 4.50659 5.33769 4.50659C5.22858 4.50659 5.12054 4.52808 5.01973 4.56984C4.91893 4.61159 4.82734 4.67279 4.75019 4.74994C4.67303 4.82709 4.61183 4.91869 4.57008 5.01949C4.52833 5.12029 4.50684 5.22833 4.50684 5.33744C4.50684 5.44655 4.52833 5.55459 4.57008 5.6554C4.61183 5.7562 4.67303 5.84779 4.75019 5.92494L8.82519 9.99994L4.75019 14.0749C4.67303 14.1521 4.61183 14.2437 4.57008 14.3445C4.52833 14.4453 4.50684 14.5533 4.50684 14.6624C4.50684 14.7716 4.52833 14.8796 4.57008 14.9804C4.61183 15.0812 4.67303 15.1728 4.75019 15.2499C4.82734 15.3271 4.91893 15.3883 5.01973 15.43C5.12054 15.4718 5.22858 15.4933 5.33769 15.4933C5.4468 15.4933 5.55484 15.4718 5.65564 15.43C5.75644 15.3883 5.84803 15.3271 5.92519 15.2499L10.0002 11.1749L14.0752 15.2499C14.1523 15.3271 14.2439 15.3883 14.3447 15.43C14.4455 15.4718 14.5536 15.4933 14.6627 15.4933C14.7718 15.4933 14.8798 15.4718 14.9806 15.43C15.0814 15.3883 15.173 15.3271 15.2502 15.2499C15.3273 15.1728 15.3885 15.0812 15.4303 14.9804C15.472 14.8796 15.4935 14.7716 15.4935 14.6624C15.4935 14.5533 15.472 14.4453 15.4303 14.3445C15.3885 14.2437 15.3273 14.1521 15.2502 14.0749L11.1752 9.99994L15.2502 5.92494C15.5669 5.60828 15.5669 5.07494 15.2502 4.75828Z"
                            fill="black" />
                    </svg>
                </p>
            </div>

            <div class="productsidebar-content pt-10">
                <div class="collapse-container">
                    <p
                        class="montserrat-bold collapse-btn rem-text-18 text-blackcustom flex items-center justify-between pb-5">
                        {{__('frontend.product.promotion')}}</p>
                    <div class="collapse-content">

                        <div class="max-h-[200px] overflow-y-auto collapse-content-item">

                            <div
                                class="flex items-center justify-between pb-4 last-of-type:pb-0 xl:gap-[10px] checkbox-list">
                                <div>
                                    <input type="checkbox" id="promotion-all" class="adminAllPromotion rem-checkbox align-middle">
                                    <label for="All"
                                        class="montserrat-medium text-dolphin rem-text-16 align-middle">
                                        All
                                    </label>
                                </div>
                                <p class="montserrat-medium text-remlight rem-text-16">
                                    ({{ isset($promotions) ? $promotions->sum('product_count') : 0 }})
                                </p>
                            </div>
                            @if (isset($promotions) && count($promotions) > 0)
                                @foreach ($promotions as $promotion)
                                    <div
                                        class="flex items-center justify-between pb-4 last-of-type:pb-0 xl:gap-[10px] checkbox-list">
                                        <div>
                                            <input type="checkbox" id="{{ 'pro-'.$promotion->id }}"
                                                {{ in_array($promotion->id, $selected_promotions) ? 'checked' : '' }}
                                                class="adminPromotion rem-checkbox align-middle" value="{{ $promotion->id }}">
                                            <label for="{{ $promotion->$name }}"
                                                class="montserrat-medium text-dolphin rem-text-16 align-middle">
                                                {{ $promotion->$name }}
                                            </label>
                                        </div>
                                        <p class="montserrat-medium text-remlight rem-text-16">
                                            ({{ $promotion->product_count }})
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>


                <div class="collapse-container py-5 border-b border-remDF">
                    <input type="hidden" name="categories[]" value="{{ count($selected_categories) > 0 ? implode(',', $selected_categories) : '' }}">
                    <p
                        class="montserrat-bold collapse-btn rem-text-18 text-blackcustom flex items-center justify-between pb-5">
                        {{__('frontend.product.product_categories')}}</p>
                    <div class="collapse-content">
                        @if (isset($categories) && count($categories) > 0)
                            <div class="flex flex-wrap categories-container">
                                @foreach ($categories as $category)
                                    <p class="cursor-pointer {{ in_array($category->id, $selected_categories) ? 'filter-categories-selected' : '' }}" id="{{ 'cat-'.$category->id }}" data-id="{{ $category->id }}">{{ $category->$locale_name }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>


                <div class="collapse-container py-5 border-b border-remDF">
                    <p
                        class="montserrat-bold collapse-btn rem-text-18 text-blackcustom flex items-center justify-between pb-5">
                        {{__('frontend.product.exclusive_product')}}</p>
                    <div class="collapse-content">
                        <div class="flex items-center xl:gap-[100px]">
                            <div class="pr-10 xl:pr-0">
                                <input type="radio" name="exclusive" class="adminExclusive rem-radio align-middle" value="yes" {{ $exclusive == 'yes' ? 'checked' : '' }}>
                                <label for=""
                                    class="montserrat-medium text-remlight rem-text-16 align-middle">{{__('frontend.product.yes')}}</label>
                            </div>
                            <div>
                                <input type="radio" name="exclusive" class="adminExclusive rem-radio align-middle" value="no" {{ $exclusive == 'no' ? 'checked' : '' }}>
                                <label for=""
                                    class="montserrat-medium text-remlight rem-text-16 align-middle">{{__('frontend.product.no')}}</label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="collapse-container py-5 border-b border-remDF">
                    <p
                        class="montserrat-bold collapse-btn rem-text-18 text-blackcustom flex items-center justify-between pb-5">
                        {{__('frontend.product.country')}}</p>
                    <div class="collapse-content">

                        <div
                            class="flex items-center justify-between py-[14px] px-4 border border-remDF bg-[#FEFCFA] mb-5 rem-text-16 montserrat">
                            <input type="text"
                                class="w-full bg-transparent focus-visible:outline-none search-input"
                                placeholder="{{__('frontend.product.search_country')}}">
                            <img src="{{ asset('frontend/img/search.svg') }}" alt="search" />
                        </div>
                        @if (isset($countries) && count($countries) > 0)
                            <div class="max-h-[200px] overflow-y-auto collapse-content-item">
                                @foreach ($countries as $country)
                                    <div
                                        class="flex items-center justify-between pb-4 last-of-type:pb-0 xl:gap-[10px] checkbox-list">
                                        <div>
                                            <input type="checkbox" id="{{ 'cou-'.$country->id }}"
                                                {{ in_array($country->id, $selected_countries) ? 'checked' : '' }}
                                                class="adminCountry rem-checkbox align-middle" value="{{ $country->id }}">
                                            <label for="{{ $country->$name }}"
                                                class="montserrat-medium text-dolphin rem-text-16 align-middle">
                                                {{ $country->$name }}
                                            </label>
                                        </div>
                                        <p class="montserrat-medium text-remlight rem-text-16">
                                            ({{ $country->product_count }})
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="collapse-container py-5 border-b border-remDF">
                    <p
                        class="montserrat-bold collapse-btn rem-text-18 text-blackcustom flex items-center justify-between pb-5">
                        {{__('frontend.product.regions')}}</p>
                    <div class="collapse-content">

                        <div
                            class="flex items-center justify-between py-[14px] px-4 border border-remDF bg-[#FEFCFA] mb-5 rem-text-16 montserrat">
                            <input type="text"
                                class="w-full bg-transparent focus-visible:outline-none search-input"
                                placeholder="{{__('frontend.product.search_regions')}}">
                            <img src="{{ asset('frontend/img/search.svg') }}" alt="search" />
                        </div>
                        @if (isset($regions) && count($regions) > 0)
                            <div class="max-h-[200px] overflow-y-auto collapse-content-item">
                                @foreach ($regions as $region)
                                    <div
                                        class="flex items-center justify-between pb-4 last-of-type:pb-0 xl:gap-[10px] checkbox-list">
                                        <div>
                                            <input type="checkbox" id="{{ 'reg-'.$region->id }}"
                                                {{ in_array($region->id, $selected_regions) ? 'checked' : '' }}
                                                class="adminRegion rem-checkbox align-middle" value="{{ $region->id }}">
                                            <label for="{{ $region->$locale_name }}"
                                                class="montserrat-medium text-dolphin rem-text-16 align-middle">
                                                {{ $region->$locale_name }}
                                            </label>
                                        </div>
                                        <p class="montserrat-medium text-remlight rem-text-16">
                                            ({{ $region->product_count }})
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="collapse-container py-5 border-b border-remDF">
                    <p
                        class="montserrat-bold collapse-btn rem-text-18 text-blackcustom flex items-center justify-between pb-5">
                        {{__('frontend.product.classification')}}</p>
                    <div class="collapse-content">

                        <div
                            class="flex items-center justify-between py-[14px] px-4 border border-remDF bg-[#FEFCFA] mb-5 rem-text-16 montserrat">
                            <input type="text"
                                class="w-full bg-transparent focus-visible:outline-none search-input"
                                placeholder="{{__('frontend.product.search_classification')}}">
                            <img src="{{ asset('frontend/img/search.svg') }}" alt="search" />
                        </div>
                        @if (isset($classifications) && count($classifications) > 0)
                            <div class="max-h-[200px] overflow-y-auto collapse-content-item">
                                @foreach ($classifications as $classification)
                                    <div
                                        class="flex items-center justify-between pb-4 last-of-type:pb-0 xl:gap-[10px] checkbox-list">
                                        <div>
                                            <input type="checkbox" id="{{ 'cla-'.$classification->id }}"
                                                {{ in_array($classification->id, $selected_classifications) ? 'checked' : '' }}
                                                class="adminClassification rem-checkbox align-middle" value="{{ $classification->id }}">
                                            <label for="{{ $classification->$name }}"
                                                class="montserrat-medium text-dolphin rem-text-16 align-middle">
                                                {{ $classification->$name }}
                                            </label>
                                        </div>
                                        <p class="montserrat-medium text-remlight rem-text-16">
                                            ({{ $classification->product_count }})
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                @if (isset($attribute_terms) && count($attribute_terms) > 0)
                    @foreach ($attribute_terms as $attribute_term)
                        <div class="collapse-container py-5 border-b border-remDF">
                            <p
                                class="montserrat-bold collapse-btn rem-text-18 text-blackcustom flex items-center justify-between pb-5">
                                {{ $attribute_term->$locale_name }}</p>
                            <div class="collapse-content">

                                <div class="max-h-[200px] overflow-y-auto collapse-content-item">
                                    @if (isset($attribute_term->attributes) && count($attribute_term->attributes) > 0)
                                        @foreach ($attribute_term->attributes as $attribute)
                                            <div
                                                class="flex items-center justify-between pb-4 last-of-type:pb-0 xl:gap-[10px] checkbox-list">
                                                <div>
                                                    <input type="checkbox" id="{{ 'att-'.$attribute->id }}"
                                                        {{ in_array($attribute->id, $selected_attributes) ? 'checked' : '' }}
                                                        class="adminAttribute rem-checkbox align-middle" value="{{ $attribute->id }}">
                                                    <label for="{{ $attribute->name }}"
                                                        class="montserrat-medium text-dolphin rem-text-16 align-middle">
                                                        {{ $attribute->name }}
                                                    </label>
                                                </div>
                                                <p class="montserrat-medium text-remlight rem-text-16">
                                                    ({{ $attribute->product_count }})
                                                </p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="collapse-container py-5 border-b border-remDF">
                    <p
                        class="montserrat-bold collapse-btn rem-text-18 text-blackcustom flex items-center justify-between pb-5">
                        {{__('frontend.product.rating')}}</p>
                    <div class="collapse-content pr-4">

                        <div
                            class="flex items-center xl:gap-4 rating-rangecontainer pb-5 last-of-type:pb-0"
                            id="rp">
                            <p
                                class="montserrat text-blackcustom rem-text-16 flex-[0_1_9%] max-w-[9%] lg:flex-[0_1_10%] lg:max-w-[10%]">
                                RP</p>
                            <input name="rp_low" type="text" value="0" id="low-rate" hidden>
                            <input name="rp_high" type="text" value="100" id="high-rate" hidden>
                            <div class="rating-range relative"></div>
                        </div>

                        <div
                            class="flex items-center xl:gap-4 rating-rangecontainer pb-5 last-of-type:pb-0"
                            id="ws">
                            <p
                                class="montserrat text-blackcustom rem-text-16 flex-[0_1_9%] max-w-[9%] lg:flex-[0_1_10%] lg:max-w-[10%]">
                                WS</p>
                            <input name="ws_low" type="text" value="0" id="low-rate" hidden>
                            <input name="ws_high" type="text" value="100" id="high-rate" hidden>
                            <div class="rating-range relative"></div>
                        </div>

                        <div
                            class="flex items-center xl:gap-4 rating-rangecontainer pb-5 last-of-type:pb-0"
                            id="jh">
                            <p
                                class="montserrat text-blackcustom rem-text-16 flex-[0_1_9%] max-w-[9%] lg:flex-[0_1_10%] lg:max-w-[10%]">
                                JH</p>
                            <input name="jh_low" type="text" value="0" id="low-rate" hidden>
                            <input name="jh_high" type="text" value="100" id="high-rate" hidden>
                            <div class="rating-range relative"></div>
                        </div>

                        <div
                            class="flex items-center xl:gap-4 rating-rangecontainer pb-5 last-of-type:pb-0"
                            id="bc">
                            <p
                                class="montserrat text-blackcustom rem-text-16 flex-[0_1_9%] max-w-[9%] lg:flex-[0_1_10%] lg:max-w-[10%]">
                                BC</p>
                            <input name="bc_low" type="text" value="0" id="low-rate" hidden>
                            <input name="bc_high" type="text" value="100" id="high-rate" hidden>
                            <div class="rating-range relative"></div>
                        </div>

                        <div
                            class="flex items-center xl:gap-4 rating-rangecontainer pb-5 last-of-type:pb-0"
                            id="js">
                            <p
                                class="montserrat text-blackcustom rem-text-16 flex-[0_1_9%] max-w-[9%] lg:flex-[0_1_10%] lg:max-w-[10%]">
                                JS</p>
                            <input name="js_low" type="text" value="0" id="low-rate" hidden>
                            <input name="js_high" type="text" value="100" id="high-rate" hidden>
                            <div class="rating-range relative"></div>
                        </div>

                        <div
                            class="flex items-center xl:gap-4 rating-rangecontainer pb-5 last-of-type:pb-0"
                            id="bh">
                            <p
                                class="montserrat text-blackcustom rem-text-16 flex-[0_1_9%] max-w-[9%] lg:flex-[0_1_10%] lg:max-w-[10%]">
                                BH</p>
                            <input name="bh_low" type="text" value="0" id="low-rate" hidden>
                            <input name="bh_high" type="text" value="100" id="high-rate" hidden>
                            <div class="rating-range relative"></div>
                        </div>

                    </div>
                </div>

                @if(!$is_other)
                    <div class="collapse-container py-5 border-b border-remDF">
                        <p
                            class="montserrat-bold collapse-btn rem-text-18 text-blackcustom flex items-center justify-between pb-5">
                            {{__('frontend.product.price_range')}}</p>
                        <div class="collapse-content">
                            <div class="flex items-center pb-4 xl:gap-2 px-4 price-rangecontainer">
                                <div>

                                    <div
                                        class="flex items-center px-3 py-2 montserrat border border-rembrown lowest-price">
                                        <span>{{ currency() }}</span>
                                        <input type="number" name="price_from"
                                            class="adminPriceRange rem-text-14 bg-transparent w-full outline-none"
                                            id="lowest-price" value="0" min="0">
                                    </div>
                                </div>
                                <span class=" mx-1 xl:mx-0">-</span>
                                <div>

                                    <div
                                        class="flex items-center px-3 py-2 montserrat border border-rembrown highest-price">
                                        <span>{{ currency() }}</span>
                                        <input type="number" name="price_to"
                                            class="adminPriceRange rem-text-14 bg-transparent w-full outline-none"
                                            id="highest-price" value="100000" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="pb-6 px-4" id="sidebar_pricerange">
                                <div class="price-filterslider"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <button type="button"
            class="bg-rembrown py-3 px-6 w-full text-whitez montserrat-semibold rem-text-14 text-center mt-8 lg:hidden"
            onclick="hideSidebar()">Apply</button>
    </div>
</div>