@props([
    'title',
    'content',
    'button' => false,
    'permission' => false,
    'url' => false,
])

<div {{ $attributes->merge(['class' => 'relative w-full md:flex md:items-center py-12 lg:py-16']) }}>
    <div class="w-full md:w-1/2 relative flex justify-center md:block">
        {{ $slot }}
    </div>

    <div class="mt-10 w-full md:mt-0 md:w-1/2 relative lg:py-20 flex items-center justify-center">
        <div class="w-full text-center sm:max-w-md md:text-left">
            <h3>
                {{ $title }}
            </h3>
            <p class="mt-4 text-secondary-500 text-base">{{ $content }}</p>
            @if($permission)
                @can($permission)
                    @if($button && $url)
                        <x-admin::buttons.primary :link="$url" class="mt-5">
                            {{ $button }}
                        </x-admin::buttons.primary>
                    @endif
                @endcan
            @endif
        </div>
    </div>
</div>
