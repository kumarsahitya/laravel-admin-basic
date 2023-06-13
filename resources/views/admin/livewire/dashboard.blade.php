<div class="row">
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{!! __('messages.dashboard.welcome_message', ['name' => $full_name]) !!}</h5>
                        <p class="mb-4">{{ __('messages.dashboard.header') }}</p>

                        <x-admin::buttons.primary :link="route('admin.settings.index')"
                                                  class="btn btn-sm btn-outline-primary">
                            <span class="align-middle">{{ __('words.settings') }}</span>
                        </x-admin::buttons.primary>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}"
                             style="height: 140px;"
                             alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                             data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="p-1 rounded flex-shrink-0 bg-success-500/10">
                                <i class="bx bx-group bx-md text-success"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">{{ __('layout.sidebar.customers') }}</span>
                        <h3 class="card-title mb-1">{{ $total_customers }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="p-1 rounded flex-shrink-0 bg-primary-50">
                                <i class="bx bx-cube bx-md text-primary"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">{{ __('layout.sidebar.products') }}</span>
                        <h3 class="card-title mb-1">{{ $total_products }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8 col-lg-12 order-2 order-md-2">
        <div class="row">
            <div class="col-lg-2 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="p-1 rounded flex-shrink-0 bg-secondary-50">
                                <i class="bx bx-cart-alt bx-md text-secondary"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">{{ __('layout.sidebar.orders') }}</span>
                        <h3 class="card-title mb-1">{{ $total_orders }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="p-1 rounded flex-shrink-0 bg-yellow-50">
                                <i class="bx bx-star bx-md text-yellow-600"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">{{ __('layout.sidebar.reviews') }}</span>
                        <h3 class="card-title mb-1">{{ $total_reviews }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
