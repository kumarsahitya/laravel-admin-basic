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
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                             style="height: 140px;"
                             alt="View Badge User"
                             data-app-dark-img="illustrations/man-with-laptop-dark.png"
                             data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Team Members -->
    <div class="col-md-12 col-lg-12 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">{{ __('pages/settings.roles_permissions.admin_accounts') }}</h5>
                <div class="dropdown">
                    <button class="btn p-0"
                            type="button"
                            id="teamMemberList"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"
                         aria-labelledby="teamMemberList">
                        <a class="dropdown-item"
                           href="{{ route('admin.settings.users') }}">{{ __('layout.forms.label.view_all') }}</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="border  bg-secondary-50 dark:bg-secondary-700">
                            <th>{{ __('layout.forms.label.name') }}</th>
                            <th>{{ __('layout.forms.label.role') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="avatar me-2">
                                            <img class="rounded-full"
                                                 src="{{ $user->picture }}"
                                                 alt="{{ $user->full_name }}">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-0 text-truncate">{{ $user->full_name }}</h6>
                                            <small class="text-truncate text-muted">{{ __('words.registered_on') }}
                                                <time datetime="{{ $user->created_at->format('Y-m-d') }}"
                                                      class="capitalize">
                                                    {{ $user->created_at->formatLocalized('%d %B %Y') }}
                                                </time>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary-100 text-secondary-800">
                                        {{ $user->roles_label }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Team Members -->
</div>
