<x-admin::layouts.base :title="$title ?? null">

    <div class="h-screen flex overflow-hidden" x-data="{ sidebarOpen: false, modalDemo: false }" @keydown.window.escape="sidebarOpen = false">
        <x-admin::layouts.app.sidebar />

        <x-admin::layouts.app.sidebar.mobile />

        <div class="flex flex-col w-0 flex-1 overflow-hidden overflow-y-auto">
            <x-admin::layouts.app.header />

            <main class="flex-1 relative z-0 py-3 lg:py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 min-h-(screen-content) 2xl:px-8 2xl:max-w-8xl">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <x-admin::wip />
    </div>

</x-admin::layouts.base>
