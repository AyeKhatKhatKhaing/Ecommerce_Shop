<div id="kt_header" style="" class="header align-items-stretch">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                id="kt_aside_mobile_toggle">
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                            fill="currentColor" />
                        <path opacity="0.3"
                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                            fill="currentColor" />
                    </svg>
                </span>
            </div>
        </div>
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ url('/admin') }}" class="d-lg-none">
                <img alt="Logo" src="{{ asset('backend/media/remfly/images/Remfly-sidebar-logo.svg') }}" class="h-30px" />
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            {{-- <div class="d-flex align-items-stretch" id="kt_header_nav">
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end"
                    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                        id="#kt_header_menu" data-kt-menu="true">
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1
                                {{ active_class((
                                    Active::checkUriPattern('admin') || Active::checkUriPattern('admin/dashboard') ||
                                    Active::checkUriPattern('admin/activitylogs') || Active::checkUriPattern('admin/activitylogs/*')
                                ), 'here show')
                            }}">
                            <span class="menu-link py-3">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D29868" class="bi bi-grid" viewBox="0 0 16 16">
                                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Dashboards</span>
                            </span>
                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px" style="">
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin') || Active::checkUriPattern('admin/dashboard')), 'active') }}" href="{{ url('/admin') }}">
                                        <span class="menu-bullet">

                                        </span>
                                        <span class="menu-title">Dashboard</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/activitylogs') || Active::checkUriPattern('admin/activitylogs/*')), 'active') }}" href="{{ url('admin/activitylogs') }}">
                                        <span class="menu-bullet">

                                        </span>
                                        <span class="menu-title">Log</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1 
                                {{ active_class((
                                    Active::checkUriPattern('admin/member') || Active::checkUriPattern('admin/member/*') ||
                                    Active::checkUriPattern('admin/member-type') || Active::checkUriPattern('admin/member-type/*') 
                                ), 'here show')
                            }}">
                            <span class="menu-link py-3">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D29868" class="bi bi-people" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">User Management</span>

                            </span>
                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px"
                                style="">
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/member') || Active::checkUriPattern('admin/member/*')), 'active') }}" href="{{ url('admin/member') }}">
                                        <span class="menu-bullet">

                                        </span>
                                        <span class="menu-title">Member List</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/member-type') || Active::checkUriPattern('admin/member-type/*')), 'active') }}" href="{{ url('admin/member-type') }}">
                                        <span class="menu-bullet">

                                        </span>
                                        <span class="menu-title">Member Type</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1 @isset($type) @if($type == 'hk' || $type == 'ma')  here show @endif @endisset">
                            <span class="menu-link py-3">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D29868" class="bi bi-box" viewBox="0 0 16 16">
                                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Products</span>

                            </span>
                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px"
                                style="">
                                <div class="menu-item">
                                    <a class="menu-link @isset($type) @if($type == 'hk') active @endif @endisset" href="{{ url('admin/product?type=hk') }}">
                                        <span class="menu-bullet">

                                        </span>
                                        <span class="menu-title">Hong Kong Product</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link @isset($type) @if($type == 'ma') active @endif @endisset" href="{{ url('admin/product?type=ma') }}">
                                        <span class="menu-bullet">

                                        </span>
                                        <span class="menu-title">Macau Product</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1
                                {{ active_class((
                                    Active::checkUriPattern('admin/page') || Active::checkUriPattern('admin/page/*')
                                ), 'here show')
                            }}">
                            <span class="menu-link py-3">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D29868" class="bi bi-layout-text-sidebar-reverse" viewBox="0 0 16 16">
                                        <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5z"/>
                                        <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h2zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5V1z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Pages</span>

                            </span>
                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px"
                                style="">
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/page') || Active::checkUriPattern('admin/page/*')), 'active') }}" href="{{ url('admin/page') }}">
                                        <span class="menu-bullet">

                                        </span>
                                        <span class="menu-title">Page</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="menu-item menu-accordion {{ active_class((Active::checkUriPattern('admin/filemanager') || Active::checkUriPattern('admin/filemanager/*')), 'here show') }}">
                            <a class=" menu-link" href="{{ url('admin/filemanager') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D29868" class="bi bi-images" viewBox="0 0 16 16">
                                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Media</span>
                            </a>
                        </div>
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1">
                            <span class="menu-link py-3">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D29868" class="bi bi-distribute-horizontal" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 1 0v-13a.5.5 0 0 0-.5-.5zm-13 0a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 1 0v-13a.5.5 0 0 0-.5-.5z"/>
                                        <path d="M6 13a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v10z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">Module Setting</span>

                            </span>
                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px"
                                style="">
                                <div class="menu-item">
                                    <a class="menu-link " href="#">
                                        <span class="menu-bullet">
                                        </span>
                                        <span class="menu-title">Order</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link " href="#">
                                        <span class="menu-bullet">
                                        </span>
                                        <span class="menu-title">Coupon</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link " href="#">
                                        <span class="menu-bullet">
                                        </span>
                                        <span class="menu-title">Shipping</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link " href="#">
                                        <span class="menu-bullet">
                                        </span>
                                        <span class="menu-title">Store Pickups</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link " href="#">
                                        <span class="menu-bullet">
                                        </span>
                                        <span class="menu-title">Report</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link " href="#">
                                        <span class="menu-bullet">
                                        </span>
                                        <span class="menu-title">Subscription</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                            class="menu-item menu-lg-down-accordion me-lg-1
                                {{ active_class((
                                    Active::checkUriPattern('admin/users') || Active::checkUriPattern('admin/users/*') ||
                                    Active::checkUriPattern('admin/roles') || Active::checkUriPattern('admin/roles/*') ||
                                    Active::checkUriPattern('admin/permissions') || Active::checkUriPattern('admin/permissions/*') 
                                ), 'here show')
                            }}">
                            <span class="menu-link py-3">
                                <span class="menu-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D29868" class="bi bi-gear" viewBox="0 0 16 16">
                                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                    </svg>
                                </span>
                                <span class="menu-title">General Setting</span>

                            </span>
                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px"
                                style="">
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/users') || Active::checkUriPattern('admin/users/*')), 'active') }}" href="{{ url('admin/users') }}">
                                        <span class="menu-bullet">

                                        </span>
                                        <span class="menu-title">Users</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/roles') || Active::checkUriPattern('admin/roles/*')), 'active') }}" href="{{ url('admin/roles') }}">
                                        <span class="menu-bullet">

                                        </span>
                                        <span class="menu-title">Roles</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{ active_class((Active::checkUriPattern('admin/permissions') || Active::checkUriPattern('admin/permissions/*')), 'active') }}" href="{{ url('admin/permissions') }}">
                                        <span class="menu-bullet">
                                        </span>
                                        <span class="menu-title">Permissions</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end"
                    data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                        id="#kt_header_menu" data-kt-menu="true">
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center ms-1 ms-lg-3 mt-3" id="kt_header_user_menu_toggle">
                <div class="symbol symbol-30px symbol-md-40px">
                    <h3 style="text-transform: uppercase;">{{ auth()->user()->name }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
