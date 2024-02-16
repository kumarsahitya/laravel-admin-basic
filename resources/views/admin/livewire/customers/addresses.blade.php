<div>
    <div class="row">
        @forelse($addresses as $address)
            <div class="col-md-4 mb-3">
                <div class="card shadow-md">
                    <div class="card-body">
                        <div class="flex-1 min-w-0">
                            <div class="focus:outline-none">
                                <span class="absolute inset-0"
                                      aria-hidden="true"></span>
                                <div class="flex items-center justify-between space-x-2">
                                    <span
                                          class="inline-flex text-xs leading-4 text-secondary-500 dark:text-secondary-400">
                                        {{ $address->type === 'shipping' ? __('pages/customers.addresses.shipping') : __('pages/customers.addresses.billing') }}
                                    </span>
                                    @if ($address->is_default)
                                        <span
                                              class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ __('pages/customers.addresses.default') }}
                                        </span>
                                    @endif
                                </div>
                                <h4 class="mt-3 mb-0 block text-sm font-medium text-secondary-900 dark:text-white">
                                    {{ $address->last_name . ' ' . $address->first_name }}
                                </h4>
                                <div class="mt-1 text-sm leading-5">
                                    <p class="text-secondary-500 dark:text-secondary-400">
                                        {{ $address->street_address }}, {{ $address->street_address_plus }},
                                        {{ $address->city }}
                                    </p>
                                    <div class="text-sm text-secondary-500 truncate dark:text-secondary-400">
                                        <span>{{ $address->phone_number }}</span> <br />
                                        <span>{{ $address->zipcode }}</span>,
                                        <span>{{ $address->country->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12 mb-3">
                <div class="card shadow-md">
                    <div class="card-body flex flex-col items-center">
                        <div class="shrink-0 mx-auto text-secondary-400">
                            <i class='bx bx-map-alt bx-lg'></i>
                        </div>
                        <div class="mt-3 w-full sm:max-w-md space-y-2 text-center">
                            <p class="text-base leading-6 text-secondary-900 font-medium dark:text-white">
                                {{ __('pages/customers.addresses.customer') }}
                            </p>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">
                                {{ __('pages/customers.addresses.empty_text') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse

    </div>
</div>
