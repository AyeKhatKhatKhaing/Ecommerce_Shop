<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <a href="#">
            <img alt="Logo" src="{{ asset('backend/media/remfly/images/Remfly-sidebar-logo.svg') }}" class="logo" style="width: 100%; height: 50px;" />
        </a>
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="{{ asset('bootstrap-icons') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                </svg>
            </span>
        </div>
    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                @if (auth()->user()->email == 'laramaster@visibleone.com' && auth()->user()->hasRole('Admin') || auth()->user()->hasRole(strtolower('Admin')) || auth()->user()->hasRole(strtoupper('Admin')))
                    @can('can_access_dashboard')
                        <div class="menu-item">
                            <div class="menu-content pt-8 pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('backend.sidebar.main') }}</span>
                            </div>
                        </div>
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin') || Active::checkUriPattern('admin')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('admin') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-grid" viewBox="0 0 16 16">
                                            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.dashboard') }}</span>
                            </a>
                        </div>
                    @endcan
                @endif
                @canany(['can_access_member_list', 'can_access_member_type', 'can_access_business_type', 'can_access_member_country'])
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('backend.sidebar.user_management') }}</span>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                            {{ active_class((
                                    Active::checkUriPattern('admin/member') || Active::checkUriPattern('admin/member/*') ||
                                    Active::checkUriPattern('admin/member-type') || Active::checkUriPattern('admin/member-type/*') ||
                                    Active::checkUriPattern('admin/business-types') || Active::checkUriPattern('admin/business-types/*') ||
                                    Active::checkUriPattern('admin/member-country') || Active::checkUriPattern('admin/member-country/*')
                                ), 'here show')
                            }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-people" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('backend.sidebar.member') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can('can_access_member_list')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/member') || Active::checkUriPattern('admin/member/*')), 'active') }}" href="{{ url('admin/member') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.member_list') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('can_access_member_type')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/member-type') || Active::checkUriPattern('admin/member-type/*')), 'active') }}" href="{{ url('admin/member-type') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.member_type') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('can_access_business_type')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/business-types') || Active::checkUriPattern('admin/business-types/*')), 'active') }}" href="{{ url('admin/business-types') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.business_type') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('can_access_member_country')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/member-country') || Active::checkUriPattern('admin/member-country/*')), 'active') }}" href="{{ url('admin/member-country') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.countries') }}</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endcan
                @canany(['can_access_hk_product', 'can_access_ma_product', 'can_access_other_product', 'can_access_category', 'can_access_attribute', 'can_access_product_label', 'can_access_promotion', 'can_access_offer_promotion', 
                         'can_access_country', 'can_access_region', 'can_access_classification'])
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('backend.sidebar.products') }}</span>
                        </div>
                    </div>
                    @canany(['can_access_hk_product', 'can_access_ma_product', 'can_access_other_product', 'can_access_category', 'can_access_attribute', 'can_access_product_label'])
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion @isset($type) @if($type == 'hk' || $type == 'ma')  here show @endif @endisset
                                {{ active_class((
                                    Active::checkUriPattern('admin/product?type=hk') || Active::checkUriPattern('admin/product/*?type=hk')||
                                    Active::checkUriPattern('admin/product?type=ma') || Active::checkUriPattern('admin/product/*type=ma')||
                                    Active::checkUriPattern('admin/other-product') || Active::checkUriPattern('admin/other-product/*')||
                                    Active::checkUriPattern('admin/product-label') || Active::checkUriPattern('admin/product-label/*')||
                                    Active::checkUriPattern('admin/category') || Active::checkUriPattern('admin/category/*') ||
                                    Active::checkUriPattern('admin/product-attribute') || Active::checkUriPattern('admin/product-attribute/*')
                                ), 'here show')
                            }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-box" viewBox="0 0 16 16">
                                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.products') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @can('can_access_hk_product')
                                    <div class="menu-item">
                                        <a class="menu-link @isset($type) @if($type == 'hk') active @endif @endisset" href="{{ url('admin/product?type=hk') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.hong_kong_product') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_ma_product')
                                    <div class="menu-item">
                                        <a class="menu-link @isset($type) @if($type == 'ma') active @endif @endisset" href="{{ url('admin/product?type=ma') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.macau_product') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_other_product')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/other-product') || Active::checkUriPattern('admin/other-product/*')), 'active') }}" href="{{ url('admin/other-product') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.other_product') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_category')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/category') || Active::checkUriPattern('admin/category/*')), 'active') }}" href="{{ url('admin/category') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.categories') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_attribute')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/product-attribute') || Active::checkUriPattern('admin/product-attribute/*')), 'active') }}" href="{{ url('admin/product-attribute') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.attributes') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_product_label')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/product-label') || Active::checkUriPattern('admin/product-label/*')), 'active') }}" href="{{ url('admin/product-label') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.product_label') }}</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endcan
                    @canany(['can_access_promotion', 'can_access_offer_promotion'])
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                                {{ active_class((
                                    Active::checkUriPattern('admin/promotion') || Active::checkUriPattern('admin/promotion/*')  ||
                                    Active::checkUriPattern('admin/offer-promotion') || Active::checkUriPattern('admin/offer-promotion/*') 
                                ), 'here show')
                            }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-postcard-heart" viewBox="0 0 16 16">
                                            <path d="M8 4.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7Zm3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622ZM2.5 5a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Z" />
                                            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H2Z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.promotion') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @can('can_access_promotion')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/promotion') || Active::checkUriPattern('admin/promotion/*')), 'active') }}" href="{{ url('admin/promotion') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.product_promotion') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_offer_promotion')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/offer-promotion') || Active::checkUriPattern('admin/offer-promotion/*')), 'active') }}" href="{{ url('admin/offer-promotion') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.offer_promotion') }}</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endcan
                    @canany(['can_access_country', 'can_access_region'])
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                                {{ active_class((
                                        Active::checkUriPattern('admin/countries') || Active::checkUriPattern('admin/countries/*') ||
                                        Active::checkUriPattern('admin/regions') || Active::checkUriPattern('admin/regions/*') 
                                    ), 'here show')
                                }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-globe-asia-australia" viewBox="0 0 16 16">
                                            <path d="m10.495 6.92 1.278-.619a.483.483 0 0 0 .126-.782c-.252-.244-.682-.139-.932.107-.23.226-.513.373-.816.53l-.102.054c-.338.178-.264.626.1.736a.476.476 0 0 0 .346-.027ZM7.741 9.808V9.78a.413.413 0 1 1 .783.183l-.22.443a.602.602 0 0 1-.12.167l-.193.185a.36.36 0 1 1-.5-.516l.112-.108a.453.453 0 0 0 .138-.326ZM5.672 12.5l.482.233A.386.386 0 1 0 6.32 12h-.416a.702.702 0 0 1-.419-.139l-.277-.206a.302.302 0 1 0-.298.52l.761.325Z" />
                                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM1.612 10.867l.756-1.288a1 1 0 0 1 1.545-.225l1.074 1.005a.986.986 0 0 0 1.36-.011l.038-.037a.882.882 0 0 0 .26-.755c-.075-.548.37-1.033.92-1.099.728-.086 1.587-.324 1.728-.957.086-.386-.114-.83-.361-1.2-.207-.312 0-.8.374-.8.123 0 .24-.055.318-.15l.393-.474c.196-.237.491-.368.797-.403.554-.064 1.407-.277 1.583-.973.098-.391-.192-.634-.484-.88-.254-.212-.51-.426-.515-.741a6.998 6.998 0 0 1 3.425 7.692 1.015 1.015 0 0 0-.087-.063l-.316-.204a1 1 0 0 0-.977-.06l-.169.082a1 1 0 0 1-.741.051l-1.021-.329A1 1 0 0 0 11.205 9h-.165a1 1 0 0 0-.945.674l-.172.499a1 1 0 0 1-.404.514l-.802.518a1 1 0 0 0-.458.84v.455a1 1 0 0 0 1 1h.257a1 1 0 0 1 .542.16l.762.49a.998.998 0 0 0 .283.126 7.001 7.001 0 0 1-9.49-3.409Z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.country_and_region') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @can('can_access_country')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/countries') || Active::checkUriPattern('admin/countries/*')), 'active') }}" href="{{ url('admin/countries') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.countries') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_region')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/regions') || Active::checkUriPattern('admin/regions/*')), 'active') }}" href="{{ url('admin/regions') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.regions') }}</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endcan
                    @can('can_access_classification')
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                                {{ active_class((
                                    Active::checkUriPattern('admin/classification') || Active::checkUriPattern('admin/classification/*')
                                ), 'here show')
                            }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="{{ asset('bootstrap-icons') }}">
                                            <path d="M6.49355 20.1127C6.47107 20.1601 6.44724 20.2067 6.41701 20.2659C6.4125 20.2748 6.40784 20.2839 6.40302 20.2933C6.40842 20.3026 6.41383 20.3118 6.41924 20.321L6.37609 20.3463L6.33149 20.3237C6.33651 20.3138 6.34136 20.3042 6.34606 20.295C6.07032 19.8244 5.80976 19.3854 5.54919 18.9463L5.54918 18.9463C5.36287 18.6358 5.3028 18.6108 4.95786 18.6702C4.57994 18.7348 4.20167 18.7962 3.80502 18.8607C3.67391 18.8819 3.5408 18.9036 3.40502 18.9257L3.39048 18.9567L3.34521 18.9355L3.33715 18.8861C3.34843 18.8843 3.3597 18.8825 3.37095 18.8806L6.49355 20.1127ZM6.49355 20.1127C6.99577 19.0444 7.49776 17.9747 7.99953 16.9037L6.49355 20.1127ZM7.83946 16.3979L7.83954 16.3977L7.83528 16.3964C7.74305 16.3667 7.64617 16.3542 7.54945 16.3595C7.39509 16.3542 7.24627 16.3775 7.10178 16.408C7.04193 16.4207 6.98399 16.4343 6.9267 16.4477C6.84209 16.4676 6.75887 16.4871 6.67289 16.5028L6.68188 16.552L6.67294 16.5028C6.30824 16.5691 6.02305 16.5407 5.79606 16.4162C5.56915 16.2918 5.39224 16.067 5.25337 15.7234C5.22156 15.6428 5.19326 15.5633 5.16231 15.4763C5.14153 15.4179 5.11956 15.3562 5.09453 15.2885L5.05309 15.1765L5.00237 15.2846L3.29995 18.9143L3.25966 19.0001L3.35328 18.9848C3.50971 18.9593 3.66257 18.9344 3.81283 18.91C4.20956 18.8456 4.58814 18.7841 4.96628 18.7195L4.96634 18.7195C5.14174 18.6893 5.22704 18.6849 5.29203 18.7149C5.35721 18.745 5.41167 18.8143 5.50623 18.9719C5.77624 19.4268 6.04616 19.8817 6.33294 20.3716L6.37926 20.4507L6.42069 20.3689C6.43541 20.3398 6.44881 20.3136 6.46119 20.2894C6.4916 20.2298 6.51591 20.1822 6.53872 20.1342L6.5388 20.134C7.04103 19.0656 7.54303 17.9959 8.04481 16.9249C8.07775 16.8548 8.10254 16.795 8.1154 16.7433C8.12839 16.691 8.13047 16.642 8.11247 16.5963C8.09451 16.5506 8.05961 16.516 8.01465 16.486C7.97004 16.4562 7.91124 16.4283 7.83946 16.3979Z" stroke="#D29868" stroke-width="0.1" />
                                            <path d="M11.4046 15.7543L11.4046 15.7539C10.9872 15.7109 10.6497 15.9217 10.324 16.201C10.1457 16.3696 9.95821 16.5282 9.76248 16.6762L9.76075 16.6775L9.76073 16.6775C9.66419 16.7441 9.56357 16.7815 9.46132 16.7819C9.35859 16.7822 9.25932 16.7453 9.16619 16.6723C8.99431 16.5377 8.82278 16.3975 8.66314 16.246C8.21079 15.8181 7.70207 15.646 7.08994 15.7944C7.0897 15.7945 7.08947 15.7945 7.08923 15.7946L11.4046 15.7543ZM11.4046 15.7543L11.4111 15.7541M11.4046 15.7543L11.4111 15.7541M11.4111 15.7541C11.6062 15.7489 11.801 15.7711 11.9899 15.82L11.9907 15.8202M11.4111 15.7541L11.9907 15.8202M11.9907 15.8202C12.2108 15.8733 12.3839 15.9123 12.5223 15.9263C12.661 15.9404 12.7725 15.9302 12.8654 15.8776C12.9584 15.8249 13.0242 15.7345 13.0825 15.6074C13.1407 15.4805 13.1942 15.3102 13.2587 15.0904C13.3618 14.739 13.5189 14.4567 13.7378 14.2394C13.9566 14.0221 14.2396 13.8674 14.5983 13.7747L14.5984 13.7747M11.9907 15.8202L14.5984 13.7747M14.5984 13.7747C14.8033 13.7211 14.9654 13.6709 15.0887 13.6122C15.2126 13.5532 15.302 13.4835 15.3559 13.3883C15.4097 13.2932 15.4241 13.1798 15.4128 13.042C15.4015 12.9045 15.364 12.7374 15.3091 12.5314L15.3091 12.5313M14.5984 13.7747L15.3091 12.5313M15.3091 12.5313C15.214 12.179 15.2056 11.8593 15.2834 11.5641C15.3612 11.2689 15.5261 10.9949 15.783 10.7353L15.783 10.7353L15.3091 12.5313ZM15.3051 7.47267L15.3051 7.4728C15.2131 7.82066 15.2066 8.13704 15.2847 8.429C15.3628 8.72094 15.5264 8.9918 15.7796 9.24731C15.7796 9.24734 15.7796 9.24736 15.7796 9.24739L15.7441 9.28259L15.3051 7.47267ZM15.3051 7.47267C15.3615 7.25735 15.4007 7.0848 15.4132 6.94425C15.4258 6.80331 15.4121 6.68857 15.357 6.59266C15.3018 6.49672 15.2095 6.42725 15.0812 6.36746C14.9532 6.30786 14.7839 6.25545 14.5686 6.19672L14.5685 6.19671M15.3051 7.47267L14.5685 6.19671M14.5685 6.19671C14.2166 6.10104 13.9364 5.94608 13.7203 5.72953C13.5043 5.51299 13.35 5.23242 13.2536 4.88179M14.5685 6.19671L13.2536 4.88179M4.39096 6.19138C4.16717 6.25323 3.99278 6.30619 3.86216 6.36538C3.73123 6.42472 3.63786 6.49308 3.5832 6.58945C3.52862 6.68567 3.51735 6.80152 3.53195 6.94526C3.54654 7.08877 3.58778 7.26716 3.64506 7.49258L3.64507 7.4926C3.7311 7.83044 3.73629 8.14074 3.65981 8.42682C3.58336 8.71282 3.42445 8.97769 3.17762 9.22354L3.17761 9.22353L3.17694 9.22423C3.04129 9.36467 2.91408 9.51302 2.79599 9.66851M4.39096 6.19138L5.87178 15.6394C5.8717 15.6392 5.87161 15.6391 5.87153 15.6389C5.78186 15.4294 5.704 15.2151 5.63833 14.9969L5.638 14.9958L5.63801 14.9958C5.46019 14.3521 5.04055 13.97 4.40572 13.7927L4.40565 13.7927C4.24738 13.7482 4.09289 13.69 3.94055 13.6326C3.91239 13.622 3.8843 13.6115 3.85627 13.601L3.87375 13.5542L3.85657 13.6011C3.72762 13.5539 3.63235 13.4812 3.57672 13.3817C3.5212 13.2824 3.5089 13.163 3.53293 13.0296L3.53301 13.0291C3.54453 12.9684 3.55576 12.9073 3.56702 12.8461C3.59839 12.6756 3.62994 12.5041 3.66839 12.3348L3.66848 12.3344C3.81045 11.7312 3.62951 11.2295 3.20847 10.7887L3.2084 10.7886C3.06235 10.6351 2.92819 10.4702 2.79663 10.3069L2.7966 10.3069C2.71476 10.2051 2.67208 10.0974 2.67266 9.9868C2.67324 9.87646 2.7168 9.76941 2.79599 9.66851M4.39096 6.19138C4.7393 6.09478 5.01391 5.93879 5.22436 5.72278M4.39096 6.19138L5.22436 5.72278M2.79599 9.66851C2.79607 9.6684 2.79616 9.6683 2.79624 9.66819L2.83556 9.69908L2.79574 9.66884C2.79582 9.66873 2.79591 9.66862 2.79599 9.66851ZM14.5858 13.7263C13.854 13.9153 13.4207 14.3608 13.2107 15.0764C12.9522 15.9573 12.8854 15.9843 12.0024 15.7716C11.809 15.7215 11.6095 15.6988 11.4098 15.7041L14.5858 13.7263ZM14.5858 13.7263C15.4039 13.5123 15.4802 13.3672 15.2608 12.5443L14.5858 13.7263ZM10.1916 3.65935L10.1917 3.65942C10.4529 3.92165 10.7295 4.08972 11.0281 4.17016C11.3267 4.25061 11.6507 4.24433 12.0082 4.15256L10.1916 3.65935ZM10.1916 3.65935C10.0395 3.50724 9.91241 3.39049 9.79777 3.31176C9.68273 3.23275 9.57604 3.18906 9.46527 3.18906C9.35449 3.18906 9.24776 3.23274 9.13265 3.31175C9.01793 3.39048 8.89073 3.50722 8.73845 3.65933L8.73836 3.65942M10.1916 3.65935L8.73836 3.65942M13.2536 4.88179C13.2536 4.88175 13.2536 4.8817 13.2536 4.88166L13.2053 4.8949L13.2536 4.88179ZM8.73836 3.65942C8.47718 3.92159 8.2003 4.089 7.90157 4.16878C7.60277 4.24859 7.2787 4.24164 6.92181 4.14985L6.92177 4.14984M8.73836 3.65942L6.92177 4.14984M6.92177 4.14984C6.70796 4.09504 6.53808 4.05665 6.40082 4.04441C6.26316 4.03214 6.15179 4.04547 6.05914 4.10042C5.96661 4.15529 5.90068 4.24695 5.84351 4.37385C5.78645 4.50049 5.73548 4.66837 5.67648 4.88228L5.67639 4.88261M6.92177 4.14984L5.67639 4.88261M5.67639 4.88261C5.58364 5.2281 5.43489 5.50671 5.22436 5.72278M5.67639 4.88261L5.22436 5.72278M3.71715 12.3459C3.67895 12.514 3.64767 12.6841 3.61636 12.8543C3.60507 12.9157 3.59377 12.9771 3.58214 13.0384L3.71715 12.3459ZM9.55328 14.7449L9.55326 14.7449C6.95187 14.7896 4.75634 12.6835 4.71893 10.1115C4.68287 7.40595 6.74595 5.28199 9.46037 5.24056L9.4604 5.24056C11.9926 5.20049 14.1778 7.31165 14.2178 9.84163V9.84164C14.2613 12.5278 12.1933 14.7008 9.55328 14.7449Z" stroke="#D29868" stroke-width="0.1" />
                                            <path d="M9.4659 5.8453C7.12302 5.86785 5.30182 7.72241 5.32572 10.0614L9.4659 5.8453ZM5.32572 10.0614C5.34828 12.317 7.23903 14.1559 9.50997 14.1388C11.7973 14.121 13.6378 12.2323 13.6098 9.92866C13.5878 7.669 11.7139 5.82344 9.46591 5.8453L5.32572 10.0614Z" stroke="#D29868" stroke-width="0.1" />
                                            <path d="M13.7616 15.5312L13.7615 15.5313C13.6079 15.9779 13.4312 16.2507 13.1864 16.3947C12.9416 16.5387 12.6174 16.5605 12.1517 16.4764L12.1516 16.4764C12.0825 16.4641 12.0136 16.4496 11.9437 16.4349L11.9424 16.4346C11.8733 16.42 11.8033 16.4053 11.7328 16.3926C11.5909 16.3673 11.4449 16.3502 11.2937 16.3603L11.2937 16.3603L11.2933 16.3604C11.0968 16.375 10.95 16.425 10.8806 16.5341C10.8101 16.6447 10.8333 16.7928 10.9143 16.9647C11.3341 17.8602 11.7538 18.7562 12.1732 19.6526L12.1732 19.6527C12.2423 19.7998 12.3125 19.9463 12.3858 20.0991C12.4286 20.1883 12.4724 20.2797 12.5176 20.3746L12.5581 20.4595L12.6058 20.3784C12.6926 20.231 12.7782 20.0866 12.8626 19.9441C13.0663 19.6005 13.2633 19.2682 13.4534 18.9325L13.4534 18.9324C13.5131 18.8268 13.5788 18.7626 13.6543 18.7287C13.73 18.6947 13.8222 18.6881 13.9406 18.7106L13.9407 18.7106C14.3276 18.7833 14.7163 18.8458 15.1165 18.9102C15.2707 18.935 15.4266 18.9601 15.5848 18.9862L15.6784 19.0016L15.6382 18.9157L13.9385 15.2827L13.8863 15.171L13.8459 15.2875L13.7616 15.5312ZM11.9324 16.4836C11.7237 16.4396 11.5149 16.3956 11.297 16.4102L13.8088 15.5475C13.499 16.448 13.0818 16.6951 12.1428 16.5256C12.0725 16.5131 12.0025 16.4983 11.9324 16.4836Z" stroke="#D29868" stroke-width="0.1" />
                                            <path d="M14.4381 14.8178C14.3308 14.593 14.4044 14.5303 14.5914 14.4729C14.7784 14.4155 14.9599 14.3595 15.1402 14.2913C15.9273 13.9923 16.231 13.5265 16.0083 12.7239C15.8058 11.9901 15.9468 11.4521 16.4862 10.9128C17.1092 10.2891 17.1126 9.69773 16.4909 9.07468C15.9441 8.52656 15.8085 7.98181 16.0103 7.23995C16.229 6.43667 15.9131 5.9709 15.124 5.68739C14.989 5.63879 14.854 5.59761 14.719 5.56116C14.2923 5.44843 14.021 5.19057 13.9089 4.75517C13.8505 4.53455 13.7732 4.31933 13.6781 4.11187C13.4229 3.54485 12.9895 3.31399 12.3739 3.40984C12.1987 3.43121 12.0252 3.46505 11.8548 3.5111C11.3769 3.6596 10.9861 3.5435 10.6445 3.18168C10.4861 3.01868 10.3105 2.87337 10.1207 2.74831C9.70418 2.4675 9.27486 2.45738 8.84486 2.73009C8.62542 2.87157 8.42353 3.03856 8.24341 3.22758C7.93223 3.55092 7.56839 3.64003 7.13839 3.52797C6.96019 3.4814 6.77793 3.44629 6.59837 3.41524C5.94764 3.30589 5.5001 3.54485 5.24021 4.15237C5.15569 4.33463 5.08791 4.52419 5.03771 4.71872C4.93105 5.18719 4.64214 5.45383 4.18177 5.56993C3.94475 5.6251 3.71535 5.70897 3.49864 5.81969C3.0403 6.06203 2.83779 6.44207 2.88167 6.96049C2.91236 7.23619 2.96152 7.50951 3.02882 7.77863C3.09632 8.09454 3.0484 8.37805 2.82631 8.62241C2.69131 8.77227 2.5563 8.92077 2.42467 9.07603C1.87722 9.73081 1.83672 10.2911 2.43412 10.8885C2.98495 11.44 3.13615 11.9881 2.92892 12.7435C2.70818 13.5461 3.03085 14.0139 3.8186 14.296C3.99825 14.3663 4.18143 14.4271 4.3674 14.4783C4.58679 14.5309 4.58814 14.6261 4.50241 14.8111C3.8159 16.259 3.13885 17.7137 2.4591 19.1616C2.38755 19.3142 2.35042 19.4661 2.46652 19.6112C2.58263 19.7563 2.73046 19.7617 2.90057 19.7313C3.52969 19.62 4.16084 19.5207 4.79065 19.4107C4.93173 19.3857 5.0134 19.4141 5.09036 19.5511C5.39952 20.0992 5.72623 20.6379 6.04417 21.1813C6.13193 21.3312 6.22711 21.4722 6.42421 21.4675C6.63482 21.4628 6.72055 21.3089 6.79818 21.1422C7.18025 20.3204 7.56411 19.4998 7.94978 18.6803L8.67273 17.1372C9.23841 17.5422 9.6495 17.5422 10.2719 17.1487C10.309 17.2243 10.3468 17.2992 10.3826 17.3748C10.9676 18.6205 11.5511 19.8661 12.1329 21.1118C12.2133 21.2853 12.2909 21.4581 12.5123 21.4662C12.7337 21.4743 12.8242 21.3042 12.9173 21.1408C13.2271 20.6116 13.5458 20.0878 13.8482 19.5552C13.9224 19.4202 13.9987 19.3824 14.1445 19.408C14.7574 19.5153 15.3724 19.6105 15.9846 19.7178C16.1676 19.7509 16.3384 19.7773 16.47 19.6146C16.6117 19.4391 16.5307 19.271 16.4491 19.0982C15.7794 17.6705 15.1193 16.2354 14.4381 14.8178ZM7.99973 16.9037C7.49751 17.9743 6.99551 19.0446 6.49374 20.1148C6.46202 20.1823 6.42624 20.2498 6.37629 20.3483C6.0867 19.8583 5.81871 19.4033 5.54938 18.9483C5.36577 18.6378 5.30299 18.6108 4.95805 18.6722C4.43693 18.7613 3.91513 18.8444 3.34541 18.9375L5.04446 15.3052C5.10588 15.4746 5.15044 15.6096 5.20376 15.7413C5.4866 16.4419 5.93819 16.6863 6.6787 16.5513C6.96694 16.4986 7.24842 16.3981 7.54679 16.4089C7.63814 16.4036 7.72968 16.4153 7.8168 16.4433C8.10571 16.5648 8.13068 16.6249 7.99973 16.9037ZM10.2948 16.1611C10.1175 16.3287 9.93118 16.4865 9.73658 16.6336C9.55567 16.7585 9.37476 16.7687 9.20128 16.6303C9.0278 16.4919 8.85971 16.3603 8.70176 16.207C8.24206 15.7689 7.71622 15.5901 7.08169 15.7433C6.83893 15.8101 6.59025 15.8533 6.33916 15.8722C6.13665 15.8817 5.99557 15.8047 5.92199 15.6171C5.83295 15.4091 5.75565 15.1964 5.69046 14.9798C5.50753 14.3176 5.07348 13.9234 4.42343 13.7418C4.23847 13.6898 4.05891 13.6183 3.87801 13.5515C3.63635 13.463 3.54049 13.2869 3.5864 13.0357C3.62757 12.8042 3.66672 12.572 3.7214 12.3432C3.86451 11.7208 3.67617 11.2024 3.24888 10.7514C3.10443 10.5996 2.97144 10.4362 2.83981 10.2729C2.68726 10.0832 2.69131 9.88539 2.83981 9.69638C2.95621 9.54333 3.08154 9.39727 3.21513 9.25896C3.71938 8.75674 3.87126 8.16947 3.69575 7.48026C3.46624 6.5764 3.51012 6.4873 4.40655 6.23956C5.11533 6.04245 5.53588 5.59963 5.72893 4.89963C5.96519 4.04302 6.05767 3.98294 6.91361 4.20233C7.64061 4.38931 8.24544 4.23338 8.77804 3.69875C9.38556 3.09123 9.55432 3.09123 10.1605 3.69875C10.6931 4.23338 11.2966 4.39201 12.0249 4.20503C12.8815 3.98429 12.9781 4.04504 13.2096 4.89895C13.404 5.61313 13.8401 6.05325 14.5597 6.24901C15.419 6.48257 15.4844 6.60138 15.2563 7.45731C15.0673 8.16609 15.2273 8.75809 15.7437 9.27989C16.3735 9.91576 16.3762 10.0649 15.747 10.6974C15.2232 11.2267 15.0666 11.8234 15.2603 12.5416C15.4824 13.3645 15.4061 13.5096 14.5853 13.7236C13.8536 13.9153 13.4202 14.3608 13.2103 15.0737C12.9517 15.9512 12.8849 15.9816 12.002 15.7689C11.8085 15.7188 11.609 15.6961 11.4093 15.7014C10.9705 15.6589 10.6188 15.8823 10.2955 16.1638L10.2948 16.1611ZM13.9501 18.6587C13.699 18.6115 13.5343 18.6817 13.4101 18.9051C13.1401 19.3776 12.8593 19.8502 12.5629 20.3504C12.4401 20.0925 12.328 19.8616 12.2187 19.6287C11.7965 18.7346 11.3764 17.8395 10.9584 16.9435C10.8004 16.606 10.9084 16.4392 11.2959 16.4102C11.5868 16.3886 11.8616 16.4777 12.1417 16.5256C13.0807 16.693 13.4978 16.448 13.8077 15.5475L13.8921 15.3038L15.5938 18.9355C15.0241 18.843 14.4881 18.762 13.9481 18.6614L13.9501 18.6587Z" fill="#D29868" />
                                            <path d="M14.4381 14.8178C14.3308 14.593 14.4044 14.5303 14.5914 14.4729C14.7784 14.4155 14.9599 14.3595 15.1402 14.2913C15.9273 13.9923 16.231 13.5265 16.0083 12.7239C15.8058 11.9901 15.9468 11.4521 16.4862 10.9128C17.1092 10.2891 17.1126 9.69773 16.4909 9.07468C15.9441 8.52656 15.8085 7.98181 16.0103 7.23995C16.229 6.43667 15.9131 5.9709 15.124 5.68739C14.989 5.63879 14.854 5.59761 14.719 5.56116C14.2923 5.44843 14.021 5.19057 13.9089 4.75517C13.8505 4.53455 13.7732 4.31933 13.6781 4.11187C13.4229 3.54485 12.9895 3.31399 12.3739 3.40984C12.1987 3.43121 12.0252 3.46505 11.8548 3.5111C11.3769 3.6596 10.9861 3.5435 10.6445 3.18168C10.4861 3.01868 10.3105 2.87337 10.1207 2.74831C9.70418 2.4675 9.27486 2.45738 8.84486 2.73009C8.62542 2.87157 8.42353 3.03856 8.24341 3.22758C7.93223 3.55092 7.56839 3.64003 7.13839 3.52797C6.96019 3.4814 6.77793 3.44629 6.59837 3.41524C5.94764 3.30589 5.5001 3.54485 5.24021 4.15237C5.15569 4.33463 5.08791 4.52419 5.03771 4.71872C4.93105 5.18719 4.64214 5.45383 4.18177 5.56993C3.94475 5.6251 3.71535 5.70897 3.49864 5.81969C3.0403 6.06203 2.83779 6.44207 2.88167 6.96049C2.91236 7.23619 2.96152 7.50951 3.02882 7.77863C3.09632 8.09454 3.0484 8.37805 2.82631 8.62241C2.69131 8.77227 2.5563 8.92077 2.42467 9.07603C1.87722 9.73081 1.83672 10.2911 2.43412 10.8885C2.98495 11.44 3.13615 11.9881 2.92892 12.7435C2.70818 13.5461 3.03085 14.0139 3.8186 14.296C3.99825 14.3663 4.18143 14.4271 4.3674 14.4783C4.58679 14.5309 4.58814 14.6261 4.50241 14.8111C3.8159 16.259 3.13885 17.7137 2.4591 19.1616C2.38755 19.3142 2.35042 19.4661 2.46652 19.6112C2.58263 19.7563 2.73046 19.7617 2.90057 19.7313C3.52969 19.62 4.16084 19.5207 4.79065 19.4107C4.93173 19.3857 5.0134 19.4141 5.09036 19.5511C5.39952 20.0992 5.72623 20.6379 6.04417 21.1813C6.13193 21.3312 6.22711 21.4722 6.42421 21.4675C6.63482 21.4628 6.72055 21.3089 6.79818 21.1422C7.18025 20.3204 7.56411 19.4998 7.94978 18.6803L8.67273 17.1372C9.23841 17.5422 9.6495 17.5422 10.2719 17.1487C10.309 17.2243 10.3468 17.2992 10.3826 17.3748C10.9676 18.6205 11.5511 19.8661 12.1329 21.1118C12.2133 21.2853 12.2909 21.4581 12.5123 21.4662C12.7337 21.4743 12.8242 21.3042 12.9173 21.1408C13.2271 20.6116 13.5458 20.0878 13.8482 19.5552C13.9224 19.4202 13.9987 19.3824 14.1445 19.408C14.7574 19.5153 15.3724 19.6105 15.9846 19.7178C16.1676 19.7509 16.3384 19.7773 16.47 19.6146C16.6117 19.4391 16.5307 19.271 16.4491 19.0982C15.7794 17.6705 15.1193 16.2354 14.4381 14.8178ZM7.99973 16.9037C7.49751 17.9743 6.99551 19.0446 6.49374 20.1148C6.46202 20.1823 6.42624 20.2498 6.37629 20.3483C6.0867 19.8583 5.81871 19.4033 5.54938 18.9483C5.36577 18.6378 5.30299 18.6108 4.95805 18.6722C4.43693 18.7613 3.91513 18.8444 3.34541 18.9375L5.04446 15.3052C5.10588 15.4746 5.15044 15.6096 5.20376 15.7413C5.4866 16.4419 5.93819 16.6863 6.6787 16.5513C6.96694 16.4986 7.24842 16.3981 7.54679 16.4089C7.63814 16.4036 7.72968 16.4153 7.8168 16.4433C8.10571 16.5648 8.13068 16.6249 7.99973 16.9037ZM10.2948 16.1611C10.1175 16.3287 9.93118 16.4865 9.73658 16.6336C9.55567 16.7585 9.37476 16.7687 9.20128 16.6303C9.0278 16.4919 8.85971 16.3603 8.70176 16.207C8.24206 15.7689 7.71622 15.5901 7.08169 15.7433C6.83893 15.8101 6.59025 15.8533 6.33916 15.8722C6.13665 15.8817 5.99557 15.8047 5.92199 15.6171C5.83295 15.4091 5.75565 15.1964 5.69046 14.9798C5.50753 14.3176 5.07348 13.9234 4.42343 13.7418C4.23847 13.6898 4.05891 13.6183 3.87801 13.5515C3.63635 13.463 3.54049 13.2869 3.5864 13.0357C3.62757 12.8042 3.66672 12.572 3.7214 12.3432C3.86451 11.7208 3.67617 11.2024 3.24888 10.7514C3.10443 10.5996 2.97144 10.4362 2.83981 10.2729C2.68726 10.0832 2.69131 9.88539 2.83981 9.69638C2.95621 9.54333 3.08154 9.39727 3.21513 9.25896C3.71938 8.75674 3.87126 8.16947 3.69575 7.48026C3.46624 6.5764 3.51012 6.4873 4.40655 6.23956C5.11533 6.04245 5.53588 5.59963 5.72893 4.89963C5.96519 4.04302 6.05767 3.98294 6.91361 4.20233C7.64061 4.38931 8.24544 4.23338 8.77804 3.69875C9.38556 3.09123 9.55432 3.09123 10.1605 3.69875C10.6931 4.23338 11.2966 4.39201 12.0249 4.20503C12.8815 3.98429 12.9781 4.04504 13.2096 4.89895C13.404 5.61313 13.8401 6.05325 14.5597 6.24901C15.419 6.48257 15.4844 6.60138 15.2563 7.45731C15.0673 8.16609 15.2273 8.75809 15.7437 9.27989C16.3735 9.91576 16.3762 10.0649 15.747 10.6974C15.2232 11.2267 15.0666 11.8234 15.2603 12.5416C15.4824 13.3645 15.4061 13.5096 14.5853 13.7236C13.8536 13.9153 13.4202 14.3608 13.2103 15.0737C12.9517 15.9512 12.8849 15.9816 12.002 15.7689C11.8085 15.7188 11.609 15.6961 11.4093 15.7014C10.9705 15.6589 10.6188 15.8823 10.2955 16.1638L10.2948 16.1611ZM13.9501 18.6587C13.699 18.6115 13.5343 18.6817 13.4101 18.9051C13.1401 19.3776 12.8593 19.8502 12.5629 20.3504C12.4401 20.0925 12.328 19.8616 12.2187 19.6287C11.7965 18.7346 11.3764 17.8395 10.9584 16.9435C10.8004 16.606 10.9084 16.4392 11.2959 16.4102C11.5868 16.3886 11.8616 16.4777 12.1417 16.5256C13.0807 16.693 13.4978 16.448 13.8077 15.5475L13.8921 15.3038L15.5938 18.9355C15.0241 18.843 14.4881 18.762 13.9481 18.6614L13.9501 18.6587Z" stroke="#D29868" stroke-width="0.2" mask="url(#path-5-outside-1_581_2886)" />
                                            <path d="M4.61893 10.1129L4.61893 10.1129L14.3178 9.84005C14.3178 9.84004 14.3178 9.84003 14.3178 9.84003C14.2769 7.25669 12.046 5.09964 9.45881 5.14058C6.68935 5.18285 4.58211 7.35206 4.61893 10.1129ZM9.46616 5.9453L9.46616 5.9453C11.6585 5.92397 13.4877 7.72483 13.5118 9.92981L13.5118 9.92983C13.5371 12.1787 11.7405 14.0215 9.50918 14.0388C7.29186 14.0555 5.44767 12.26 5.425 10.0604C5.40166 7.77679 7.17836 5.96731 9.46616 5.9453Z" fill="#D29868" stroke="#D29868" stroke-width="0.1" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.classification') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @can('can_access_classification')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/classification') || Active::checkUriPattern('admin/classification/*')), 'active') }}" href="{{ url('admin/classification') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.classification') }}</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endcan
                @endcan
                @canany(['can_access_home', 'can_access_page', 'can_access_commmon_problem', 'can_access_term_and_condition', 'can_access_privacy_policy', 'can_access_about_remfly', 'can_access_contact_us',
                         'can_access_contact_address', 'can_access_member_exclusive_offer', 'can_exclusive_offer', 'can_access_store_distribution', 'can_access_store', 'can_access_blog', 'can_access_blog_category'])
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('backend.sidebar.pages') }}</span>
                        </div>
                    </div>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ active_class((
                        Active::checkUriPattern('admin/page') || Active::checkUriPattern('admin/page/*') ||
                        Active::checkUriPattern('admin/home') || Active::checkUriPattern('admin/home/*') ||
                        Active::checkUriPattern('admin/common-problem') || Active::checkUriPattern('admin/common-problem/*') ||
                        Active::checkUriPattern('admin/term-condition') || Active::checkUriPattern('admin/term-condition/*') ||
                        Active::checkUriPattern('admin/privacy-policy') || Active::checkUriPattern('admin/privacy-policy/*') ||
                        Active::checkUriPattern('admin/about-remfly') || Active::checkUriPattern('admin/about-remfly/*') ||
                        Active::checkUriPattern('admin/contact-page') || Active::checkUriPattern('admin/contact-page/*') ||
                        Active::checkUriPattern('admin/contact-address') || Active::checkUriPattern('admin/contact-address/*') ||
                        Active::checkUriPattern('admin/member-exclusive-offer') || Active::checkUriPattern('admin/member-exclusive-offer/*') ||
                        Active::checkUriPattern('admin/exclusive-offer') || Active::checkUriPattern('admin/exclusive-offer/*') ||
                        Active::checkUriPattern('admin/store-distribution') || Active::checkUriPattern('admin/store-distribution/*') ||
                        Active::checkUriPattern('admin/store') || Active::checkUriPattern('admin/store/*')
                            ), 'here show')
                        }} ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-layout-text-sidebar-reverse" viewBox="0 0 16 16">
                                        <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5z" />
                                        <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h2zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5V1z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('backend.sidebar.cms') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can('can_access_home')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/home') || Active::checkUriPattern('admin/home/*')), 'active') }}" href="{{ url('admin/home') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.home') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('can_access_page')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/page') || Active::checkUriPattern('admin/page/*')), 'active') }}" href="{{ url('admin/page') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.pages') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('can_access_common_problem')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/common-problem') || Active::checkUriPattern('admin/common-problem/*')), 'active') }}" href="{{ url('admin/common-problem') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.common_problem') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('can_access_term_and_condition')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/term-condition') || Active::checkUriPattern('admin/term-condition/*')), 'active') }}" href="{{ url('admin/term-condition') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.term_condition') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('can_access_privacy_policy')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/privacy-policy') || Active::checkUriPattern('admin/privacy-policy/*')), 'active') }}" href="{{ url('admin/privacy-policy') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.privacy_policy') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('can_access_about_remfly')
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/about-remfly') || Active::checkUriPattern('admin/about-remfly/*')), 'active') }}" href="{{ url('admin/about-remfly') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.about_remfly') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @canany(['can_access_contact_us', 'can_access_contact_address'])
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                                        {{ active_class((
                                            Active::checkUriPattern('admin/contact-page') || Active::checkUriPattern('admin/contact-page/*') ||
                                            Active::checkUriPattern('admin/contact-address') || Active::checkUriPattern('admin/contact-address/*')
                                        ), 'here show')
                                    }} ">
                                    <span class="menu-link">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.contact') }}</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @can('can_access_contact_us')
                                            <div class="menu-item">
                                                <a class="menu-link {{ active_class((Active::checkUriPattern('admin/contact-page') || Active::checkUriPattern('admin/contact-page/*')), 'active') }}" href="{{ url('admin/contact-page') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('backend.sidebar.contact_page') }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('can_access_contact_address')
                                            <div class="menu-item">
                                                <a class="menu-link {{ active_class((Active::checkUriPattern('admin/contact-address') || Active::checkUriPattern('admin/contact-address/*')), 'active') }}" href="{{ url('admin/contact-address') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('backend.sidebar.contact_address') }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            @endcan
                            @canany(['can_access_member_exclusive_offer', 'can_access_exclusive_offer'])
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                                        {{ active_class((
                                            Active::checkUriPattern('admin/exclusive-offer') || Active::checkUriPattern('admin/exclusive-offer/*') ||
                                            Active::checkUriPattern('admin/member-exclusive-offer') || Active::checkUriPattern('admin/member-exclusive-offer/*')
                                        ), 'here show')
                                    }} ">
                                    <span class="menu-link">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.exclusive_offer') }}</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @can('can_access_member_exclusive_offer')
                                            <div class="menu-item">
                                                <a class="menu-link {{ active_class((Active::checkUriPattern('admin/member-exclusive-offer') || Active::checkUriPattern('admin/member-exclusive-offer/*')), 'active') }}" href="{{ url('admin/member-exclusive-offer') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('backend.sidebar.member_exclusive_offer_page') }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('can_access_exclusive_offer')
                                            <div class="menu-item">
                                                <a class="menu-link {{ active_class((Active::checkUriPattern('admin/exclusive-offer') || Active::checkUriPattern('admin/exclusive-offer/*')), 'active') }}" href="{{ url('admin/exclusive-offer') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('backend.sidebar.exclusive_offer') }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            @endcan
                            @canany(['can_access_store_distribution', 'can_access_store'])
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                                        {{ active_class((
                                            Active::checkUriPattern('admin/store-distribution') || Active::checkUriPattern('admin/store-distribution/*') ||
                                            Active::checkUriPattern('admin/store') || Active::checkUriPattern('admin/store/*')
                                        ), 'here show')
                                    }} ">
                                    <span class="menu-link">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('backend.sidebar.store_distribution') }}</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @can('can_access_store')
                                            <div class="menu-item">
                                                <a class="menu-link {{ active_class((Active::checkUriPattern('admin/store') || Active::checkUriPattern('admin/store/*')), 'active') }}" href="{{ url('admin/store') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('backend.sidebar.store_lists') }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('can_access_store_distribution')
                                            <div class="menu-item">
                                                <a class="menu-link {{ active_class((Active::checkUriPattern('admin/store-distribution') || Active::checkUriPattern('admin/store-distribution/*')), 'active') }}" href="{{ url('admin/store-distribution') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('backend.sidebar.store_distribution_page') }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-calendar4-week" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z" />
                                        <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('backend.sidebar.events') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('backend.sidebar.event') }}</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                    @canany(['can_access_blog', 'can_access_blog_category'])
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                                {{ active_class((
                                    Active::checkUriPattern('admin/blog') || Active::checkUriPattern('admin/blog/*') ||
                                    Active::checkUriPattern('admin/blog-category') || Active::checkUriPattern('admin/blog-category/*')
                                ), 'here show')
                            }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-journals" viewBox="0 0 16 16">
                                            <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z" />
                                            <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.blog') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @can('can_access_blog')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/blog') || Active::checkUriPattern('admin/blog/*')), 'active') }}" href="{{ url('admin/blog') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.blog') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_blog_category')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/blog-category') || Active::checkUriPattern('admin/blog-category/*')), 'active') }}" href="{{ url('admin/blog-category') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.blog_category') }}</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endcan
                @endcan
                @can('can_access_media_library')
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('backend.sidebar.media') }}</span>
                        </div>
                    </div>
                    <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/filemanager') || Active::checkUriPattern('admin/filemanager/*')), 'here show') }}">
                        <a class=" menu-link" href="{{ url('admin/filemanager') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-images" viewBox="0 0 16 16">
                                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('backend.sidebar.media_library') }}</span>
                        </a>
                    </div>
                @endcan
                @canany(['can_access_hong_kong_order', 'can_access_ma_order', 'can_access_coupon', 'can_access_shipping', 'can_access_store_pickup', 'can_access_member_report', 'can_access_product_report', 
                          'can_access_order_report', 'can_access_subscription', 'can_access_notification', 'can_access_contact_form_submission'])
                    <div class="menu-item ">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('backend.sidebar.module_setting') }}</span>
                        </div>
                    </div>
                    @canany(['can_access_hong_kong_order', 'can_access_ma_order'])
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion @isset($order_type) @if($order_type == 'hk' || $order_type == 'ma')  here show @endif @endisset
                                {{ active_class((
                                    Active::checkUriPattern('admin/order?type=hk') || Active::checkUriPattern('admin/order/*?type=hk')||
                                    Active::checkUriPattern('admin/order?type=ma') || Active::checkUriPattern('admin/order/*type=ma')
                                ), 'here show')
                            }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-receipt" viewBox="0 0 16 16">
                                            <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.order') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @can('can_access_hong_kong_order')
                                    <div class="menu-item">
                                        <a class="menu-link @isset($order_type) @if($order_type == 'hk') active @endif @endisset" href="{{ url('admin/order?type=hk') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.hong_kong_order') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_ma_order')
                                    <div class="menu-item">
                                        <a class="menu-link @isset($order_type) @if($order_type == 'ma') active @endif @endisset" href="{{ url('admin/order?type=ma') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.macau_order') }}</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endcan
                    @can('can_access_coupon')
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/coupon') || Active::checkUriPattern('admin/coupon/*')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('admin/coupon') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="{{ asset('bootstrap-icons') }}">
                                            <path d="M0.75 0.75H18.25V3.36213C17.3175 4.27129 16.75 5.61865 16.75 7.09091C16.75 8.56317 17.3175 9.91053 18.25 10.8197V12.25H0.75V10.8197C1.68248 9.91053 2.25 8.56317 2.25 7.09091C2.25 5.61865 1.68248 4.27129 0.75 3.36213V0.75Z" stroke="#D29868" stroke-width="1.5" />
                                            <path d="M12.6836 3.5338C12.6634 3.48508 12.6338 3.44081 12.5965 3.40352C12.5592 3.36622 12.5149 3.33663 12.4662 3.31645C12.4175 3.29626 12.3652 3.28587 12.3125 3.28587C12.2598 3.28587 12.2075 3.29626 12.1588 3.31645C12.1101 3.33664 12.0658 3.36622 12.0285 3.40352C12.0285 3.40352 12.0285 3.40352 12.0285 3.40352L6.40352 9.02852C6.36623 9.06581 6.33664 9.11009 6.31646 9.15881C6.29628 9.20754 6.28589 9.25976 6.28589 9.3125C6.28589 9.36524 6.29628 9.41746 6.31646 9.46619C6.33664 9.51491 6.36623 9.55919 6.40352 9.59648C6.44081 9.63377 6.48509 9.66336 6.53381 9.68354C6.58254 9.70372 6.63476 9.71411 6.6875 9.71411C6.74024 9.71411 6.79246 9.70372 6.84119 9.68354C6.88991 9.66336 6.93419 9.63377 6.97148 9.59648L12.5965 3.97148C12.5965 3.97148 12.5965 3.97148 12.5965 3.97148C12.6338 3.93419 12.6634 3.88992 12.6836 3.8412C12.7037 3.79247 12.7141 3.74024 12.7141 3.6875C12.7141 3.63476 12.7037 3.58253 12.6836 3.5338ZM7.53125 5.325C7.32073 5.325 7.11884 5.24137 6.96998 5.09252C6.82113 4.94366 6.7375 4.74177 6.7375 4.53125C6.7375 4.32073 6.82113 4.11884 6.96998 3.96998C7.11884 3.82113 7.32073 3.7375 7.53125 3.7375C7.74177 3.7375 7.94366 3.82113 8.09252 3.96998C8.24137 4.11884 8.325 4.32073 8.325 4.53125C8.325 4.74177 8.24137 4.94366 8.09252 5.09252C7.94366 5.24137 7.74177 5.325 7.53125 5.325ZM7.53125 5.9875C7.91747 5.9875 8.28787 5.83407 8.56097 5.56097C8.83407 5.28787 8.9875 4.91747 8.9875 4.53125C8.9875 4.14503 8.83407 3.77463 8.56097 3.50153C8.28787 3.22843 7.91747 3.075 7.53125 3.075C7.14503 3.075 6.77463 3.22843 6.50153 3.50153C6.22843 3.77463 6.075 4.14503 6.075 4.53125C6.075 4.91747 6.22843 5.28787 6.50153 5.56097C6.77463 5.83407 7.14503 5.9875 7.53125 5.9875ZM11.4688 9.2625C11.2582 9.2625 11.0563 9.17887 10.9075 9.03002C10.7586 8.88116 10.675 8.67927 10.675 8.46875C10.675 8.25823 10.7586 8.05634 10.9075 7.90748C11.0563 7.75863 11.2582 7.675 11.4688 7.675C11.6793 7.675 11.8812 7.75863 12.03 7.90748C12.1789 8.05634 12.2625 8.25823 12.2625 8.46875C12.2625 8.67927 12.1789 8.88116 12.03 9.03002C11.8812 9.17887 11.6793 9.2625 11.4688 9.2625ZM11.4688 9.925C11.855 9.925 12.2254 9.77157 12.4985 9.49847C12.7716 9.22537 12.925 8.85497 12.925 8.46875C12.925 8.08253 12.7716 7.71213 12.4985 7.43903C12.2254 7.16593 11.855 7.0125 11.4688 7.0125C11.0825 7.0125 10.7121 7.16593 10.439 7.43903C10.1659 7.71213 10.0125 8.08253 10.0125 8.46875C10.0125 8.85497 10.1659 9.22537 10.439 9.49847C10.7121 9.77157 11.0825 9.925 11.4688 9.925Z" fill="#D29868" stroke="#D29868" stroke-width="0.1" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.coupon') }}</span>
                            </a>
                        </div>
                    @endcan
                    @canany(['can_access_shipping', 'can_access_store_pickup'])
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                            {{ active_class((
                                    Active::checkUriPattern('admin/shipping') || Active::checkUriPattern('admin/shipping/*') ||
                                    Active::checkUriPattern('admin/store-pickups') || Active::checkUriPattern('admin/store-pickups/*')
                                    ), 'here show')
                                }}
                            ">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-truck" viewBox="0 0 16 16">
                                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.shipping_setting') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @can('can_access_shipping')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/shipping') || Active::checkUriPattern('admin/shipping/*')), 'active') }}" href="{{ url('/admin/shipping') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.shipping') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_store_pickup')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/store-pickups') || Active::checkUriPattern('admin/store-pickups/*')), 'active') }}" href="{{ url('admin/store-pickups') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.store_pickup') }}</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endcan
                    @canany(['can_access_member_report', 'can_access_product_report', 'can_access_order_report'])
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion
                            {{ active_class((
                                Active::checkUriPattern('admin/product-report') || Active::checkUriPattern('admin/product-report/*') ||
                                Active::checkUriPattern('admin/member-report') || Active::checkUriPattern('admin/member-report/*') ||
                                Active::checkUriPattern('admin/order-report') || Active::checkUriPattern('admin/order-report/*')
                                ), 'here show')
                            }}">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
                                            <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.report') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @can('can_access_member_report')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/member-report') || Active::checkUriPattern('admin/member-report/*')), 'active') }}" href="{{ url('/admin/member-report') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.member_report') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_product_report')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/product-report') || Active::checkUriPattern('admin/product-report/*')), 'active') }}" href="{{ url('/admin/product-report') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.product_report') }}</span>
                                        </a>
                                    </div>
                                @endcan
                                @can('can_access_order_report')
                                    <div class="menu-item">
                                        <a class="menu-link {{ active_class((Active::checkUriPattern('admin/order-report') || Active::checkUriPattern('admin/order-report/*')), 'active') }}" href="{{ url('/admin/order-report') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('backend.sidebar.order_report') }}</span>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endcan
                    @can('can_access_subscription')
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/subscription') || Active::checkUriPattern('admin/subscription/*')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('/admin/subscription') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-hand-index-thumb" viewBox="0 0 16 16">
                                            <path d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 0 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 1 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.118a.5.5 0 0 1-.447-.276l-1.232-2.465-2.512-4.185a.517.517 0 0 1 .809-.631l2.41 2.41A.5.5 0 0 0 6 9.5V1.75A.75.75 0 0 1 6.75 1zM8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v6.543L3.443 6.736A1.517 1.517 0 0 0 1.07 8.588l2.491 4.153 1.215 2.43A1.5 1.5 0 0 0 6.118 16h6.302a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5.114 5.114 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.632 2.632 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046l-.048.002zm2.094 2.025z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.subscription') }}</span>
                            </a>
                        </div>
                    @endcan
                    @can('can_access_notification')
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/subscribe-notification') || Active::checkUriPattern('admin/subscribe-notification/*')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('/admin/subscribe-notification') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-bell" viewBox="0 0 16 16">
                                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.notification') }}</span>
                            </a>
                        </div>
                    @endcan
                    @can('can_access_contact_form_submission')
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/contact-form-submission') || Active::checkUriPattern('admin/contact-form-submission/*')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('/admin/contact-form-submission') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-textarea-resize" viewBox="0 0 16 16">
                                            <path d="M0 4.5A2.5 2.5 0 0 1 2.5 2h11A2.5 2.5 0 0 1 16 4.5v7a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 0 11.5v-7zM2.5 3A1.5 1.5 0 0 0 1 4.5v7A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 13.5 3h-11zm10.854 4.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708l3-3a.5.5 0 0 1 .708 0zm0 2.5a.5.5 0 0 1 0 .708l-.5.5a.5.5 0 0 1-.708-.708l.5-.5a.5.5 0 0 1 .708 0z"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.contact_form_submission') }}</span>
                            </a>
                        </div>
                    @endcan
                @endcan
                {{-- <div class="menu-item menu-accordion">
                    <a class=" menu-link" href="#">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="16" height="16" viewBox="0 0 22 22" fill="none" xmlns="{{ asset('bootstrap-icons') }}">
                                    <path d="M3 14.0728H5.7728C6.69203 14.0728 7.57362 14.4377 8.22362 15.0872C8.87362 15.7368 9.23879 16.6178 9.23879 17.5364M5.0796 17.5364H12.0116C12.747 17.5364 13.4522 17.8283 13.9722 18.348C14.4922 18.8676 14.7844 19.5724 14.7844 20.3073C14.7844 20.491 14.7113 20.6672 14.5813 20.7971C14.4513 20.927 14.275 21 14.0912 21H3M14.4378 14.0728L8.89219 8.94661C5.86984 5.91248 10.2786 0.0381779 14.4378 4.79026C18.597 0.0520323 23.0473 5.92633 19.9834 8.94661L14.4378 14.0728Z" stroke="#D29868" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">{{ __('backend.sidebar.redeem') }}</span>
                    </a>
                </div> --}}
                @canany(['can_access_site_setting', 'can_access_header_menu', 'can_access_user', 'can_access_role', 'can_access_permission', 'can_access_footer', 'can_access_slider'])
                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __('backend.sidebar.general_setting') }}</span>
                        </div>
                    </div>
                    @can('can_access_site_setting')
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/site-setting') || Active::checkUriPattern('admin/site-setting/*')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('admin/site-setting') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-globe" viewBox="0 0 16 16">
                                            <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.site_setting') }}</span>
                            </a>
                        </div>
                    @endcan
                    @can('can_access_header_menu')
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/menu') || Active::checkUriPattern('admin/menu/*')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('admin/menu') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-menu-button-wide" viewBox="0 0 16 16">
                                            <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
                                            <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.header_menu') }}</span>
                            </a>
                        </div>
                    @endcan
                    @if (auth()->user()->email == 'laramaster@visibleone.com' && auth()->user()->hasRole('Admin') || auth()->user()->hasRole(strtolower('Admin')) || auth()->user()->hasRole(strtoupper('Admin')))
                        @canany(['can_access_user', 'can_access_role', 'can_access_permission'])
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion 
                                {{ active_class((
                                        Active::checkUriPattern('admin/users') || Active::checkUriPattern('admin/users/*') ||
                                        Active::checkUriPattern('admin/roles') || Active::checkUriPattern('admin/roles/*') ||
                                        Active::checkUriPattern('admin/permissions') || Active::checkUriPattern('admin/permissions/*') 
                                    ), 'here show')
                                }}">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-gear" viewBox="0 0 16 16">
                                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">{{ __('backend.sidebar.backend_user') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    @can('can_access_user')
                                        <div class="menu-item">
                                            <a class="menu-link {{ active_class((Active::checkUriPattern('admin/users') || Active::checkUriPattern('admin/users/*')), 'active') }}" href="{{ url('admin/users') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ __('backend.sidebar.user') }}</span>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('can_access_role')
                                        <div class="menu-item">
                                            <a class="menu-link {{ active_class((Active::checkUriPattern('admin/roles') || Active::checkUriPattern('admin/roles/*')), 'active') }}" href="{{ url('/admin/roles') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ __('backend.sidebar.role') }}</span>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('can_access_permission')
                                        <div class="menu-item">
                                            <a class="menu-link {{ active_class((Active::checkUriPattern('admin/permissions') || Active::checkUriPattern('admin/permissions/*')), 'active') }}" href="{{ url('/admin/permissions') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ __('backend.sidebar.permission') }}</span>
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        @endcan
                    @endif
                    {{-- <div class="menu-item menu-accordion">
                        <a class=" menu-link" href="#">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-border-top" viewBox="0 0 16 16">
                                        <path d="M0 0v1h16V0H0zm1 2.844v-.938H0v.938h1zm6.5-.938v.938h1v-.938h-1zm7.5 0v.938h1v-.938h-1zM1 4.719V3.78H0v.938h1zm6.5-.938v.938h1V3.78h-1zm7.5 0v.938h1V3.78h-1zM1 6.594v-.938H0v.938h1zm6.5-.938v.938h1v-.938h-1zm7.5 0v.938h1v-.938h-1zM.5 8.5h.469v-.031H1V7.53H.969V7.5H.5v.031H0v.938h.5V8.5zm1.406 0h.938v-1h-.938v1zm1.875 0h.938v-1H3.78v1zm1.875 0h.938v-1h-.938v1zm2.813 0v-.031H8.5V7.53h-.031V7.5H7.53v.031H7.5v.938h.031V8.5h.938zm.937 0h.938v-1h-.938v1zm1.875 0h.938v-1h-.938v1zm1.875 0h.938v-1h-.938v1zm1.875 0h.469v-.031h.5V7.53h-.5V7.5h-.469v.031H15v.938h.031V8.5zM0 9.406v.938h1v-.938H0zm7.5 0v.938h1v-.938h-1zm8.5.938v-.938h-1v.938h1zm-16 .937v.938h1v-.938H0zm7.5 0v.938h1v-.938h-1zm8.5.938v-.938h-1v.938h1zm-16 .937v.938h1v-.938H0zm7.5 0v.938h1v-.938h-1zm8.5.938v-.938h-1v.938h1zM0 16h.969v-.5H1v-.469H.969V15H.5v.031H0V16zm1.906 0h.938v-1h-.938v1zm1.875 0h.938v-1H3.78v1zm1.875 0h.938v-1h-.938v1zm1.875-.5v.5h.938v-.5H8.5v-.469h-.031V15H7.53v.031H7.5v.469h.031zm1.875.5h.938v-1h-.938v1zm1.875 0h.938v-1h-.938v1zm1.875 0h.938v-1h-.938v1zm1.875-.5v.5H16v-.969h-.5V15h-.469v.031H15v.469h.031z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('backend.sidebar.header') }}</span>
                        </a>
                    </div> --}}
                    @can('can_access_footer')
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/footer') || Active::checkUriPattern('admin/footer/*')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('admin/footer') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-border-bottom" viewBox="0 0 16 16">
                                            <path d="M.969 0H0v.969h.5V1h.469V.969H1V.5H.969V0zm.937 1h.938V0h-.938v1zm1.875 0h.938V0H3.78v1zm1.875 0h.938V0h-.938v1zM7.531.969V1h.938V.969H8.5V.5h-.031V0H7.53v.5H7.5v.469h.031zM9.406 1h.938V0h-.938v1zm1.875 0h.938V0h-.938v1zm1.875 0h.938V0h-.938v1zm1.875 0h.469V.969h.5V0h-.969v.5H15v.469h.031V1zM1 2.844v-.938H0v.938h1zm6.5-.938v.938h1v-.938h-1zm7.5 0v.938h1v-.938h-1zM1 4.719V3.78H0v.938h1zm6.5-.938v.938h1V3.78h-1zm7.5 0v.938h1V3.78h-1zM1 6.594v-.938H0v.938h1zm6.5-.938v.938h1v-.938h-1zm7.5 0v.938h1v-.938h-1zM.5 8.5h.469v-.031H1V7.53H.969V7.5H.5v.031H0v.938h.5V8.5zm1.406 0h.938v-1h-.938v1zm1.875 0h.938v-1H3.78v1zm1.875 0h.938v-1h-.938v1zm2.813 0v-.031H8.5V7.53h-.031V7.5H7.53v.031H7.5v.938h.031V8.5h.938zm.937 0h.938v-1h-.938v1zm1.875 0h.938v-1h-.938v1zm1.875 0h.938v-1h-.938v1zm1.875 0h.469v-.031h.5V7.53h-.5V7.5h-.469v.031H15v.938h.031V8.5zM0 9.406v.938h1v-.938H0zm7.5 0v.938h1v-.938h-1zm8.5.938v-.938h-1v.938h1zm-16 .937v.938h1v-.938H0zm7.5 0v.938h1v-.938h-1zm8.5.938v-.938h-1v.938h1zm-16 .937v.938h1v-.938H0zm7.5 0v.938h1v-.938h-1zm8.5.938v-.938h-1v.938h1zM0 15h16v1H0v-1z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.footer') }}</span>
                            </a>
                        </div>
                    @endcan
                    @can('can_access_slider')
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/slider') || Active::checkUriPattern('admin/slider/*')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('admin/slider') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-sliders" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">{{ __('backend.sidebar.slider') }}</span>
                            </a>
                        </div>
                    @endcan
                @endcan
                <div class="sticky-sidebar">
                    <div class="menu-item">
                        <div class="">
                            <div class="separator mx-1 my-4"></div>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="https://visibleone.com/">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-headset" viewBox="0 0 16 16">
                                        <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('backend.sidebar.look_for_support') }}</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="https://visibleone.com/">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-telephone-outbound" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">{{ __('backend.sidebar.contact_web_developer') }}</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="{{ asset('bootstrap-icons') }}" width="16" height="16" fill="#D29868" class="bi bi-power" viewBox="0 0 16 16">
                                        <path d="M7.5 1v7h1V1h-1z" />
                                        <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title sidebar-text">{{ __('backend.sidebar.logout') }}</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>