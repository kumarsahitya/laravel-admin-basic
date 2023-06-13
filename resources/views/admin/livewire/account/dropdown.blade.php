<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item selected" href="javascript:void(0);" data-language="en">
                            <i class="fi fi-us fis rounded-circle fs-4 me-1"></i>
                            <span class="align-middle">English</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="fr">
                            <i class="fi fi-fr fis rounded-circle fs-4 me-1"></i>
                            <span class="align-middle">France</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                   data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img class="w-px-40 h-auto rounded-circle" src="{{ $picture }}"
                             alt="{{ $email }}"/>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img class="w-px-40 h-auto rounded-circle" src="{{ $picture }}"
                                             alt="{{ $email }}"/>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ $full_name }}</span>
                                    <small class="text-muted">{{ $email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    @can('add_products')
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <x-admin::dropdown-link :href="route('admin.products.create')">
                                <i class="bx bx-plus-circle me-2"></i>
                                <span class="align-middle">{{ __('layout.account_dropdown.add_product') }}</span>
                            </x-admin::dropdown-link>
                        </li>
                    @endcan
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <x-admin::dropdown-link :href="route('admin.profile')">
                            <i class="bx bxs-user-account me-2"></i>
                            <span class="align-middle">{{ __('layout.account_dropdown.personal_account') }}</span>
                        </x-admin::dropdown-link>
                    </li>
                    @can('view_users')
                        <li>
                            <x-admin::dropdown-link :href="route('admin.settings.users')">
                                <i class="bx bx-group me-2"></i>
                                {{ __('layout.account_dropdown.manage_users') }}
                            </x-admin::dropdown-link>
                        </li>
                    @endcan
                    @can('access_setting')
                        <li>
                            <x-admin::dropdown-link :href="route('admin.settings.index')">
                                <i class='bx bx-cog me-2'></i>
                                <span class="align-middle">{{ __('layout.account_dropdown.settings') }}</span>
                            </x-admin::dropdown-link>
                        </li>
                    @endcan
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <x-admin::dropdown-link
                            :href="route('admin.logout')"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        >
                            <i class='bx bx-power-off me-2'></i>
                            {{ __('layout.account_dropdown.sign_out') }}
                        </x-admin::dropdown-link>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>

