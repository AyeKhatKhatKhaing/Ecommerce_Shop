@if (isset($offer_products) && count($offer_products) > 0)
    <div component-name="rem-checkout-guest-progress">
        <div class="rem-checkout-guest-progress mt-[60px]">
            <div class="py-[13px] px-[30px] mesg mb-[20px]">
                <p>Get discount price with buying more than $300 with any products </p>
            </div>
            <div class="progress flex w-full h-[7px] md:h-[45px] bg-gray-200 rounded-full overflow-hidden">
                <div class="flex flex-col justify-center overflow-hidden rounded-full bg-[#FFC425]"
                    role="progressbar" style="width: 21%" aria-valuenow="75" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="hidden md:flex items-center progress-text absolute">
                        <p class="font-bold pr-[10px] md:pr-[32px]">Ongoing:</p>
                        <div class="flex items-center pr-[10px]">
                            <img src="{{ asset('frontend/img/clarity_date-line.svg') }}" class="object-contain" alt="date" />
                            <p class="px-[10px]">Start In:</p>
                            <p class="font-bold">
                                {{ date('d M, Y', strtotime($start_date)) }}
                            </p>
                        </div>
                        <div class="flex items-center">
                            <img src="{{ asset('frontend/img/clarity_date-line.svg') }}" class="object-contain" alt="date" />
                            <p class="px-[10px]">End In:</p>
                            <p class="font-bold">
                                {{ date('d M, Y', strtotime($end_date)) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex  md:hidden items-center progress-text mt-4">
                <p class="font-bold pr-[10px] md:pr-[32px]">Ongoing:</p>
                <div class="ml-2">
                    <div class="flex items-center pr-[10px]">
                        <img src="{{ asset('frontend/img/clarity_date-line.svg') }}" class="object-contain" alt="date" />
                        <p class="px-[10px]">Start In:</p>
                        <p class="font-bold">
                            {{ date('d M, Y', strtotime($start_date)) }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('frontend/img/clarity_date-line.svg') }}" class="object-contain" alt="date" />
                        <p class="px-[10px]">End In:</p>
                        <p class="font-bold">
                            {{ date('d M, Y', strtotime($end_date)) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif