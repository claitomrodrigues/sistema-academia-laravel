<section {{ $attributes->class(['rounded-xl border border-slate-200 bg-white shadow-sm']) }}>
    @if (isset($title) || isset($actions))
        <header class="flex items-center justify-between gap-4 border-b border-slate-100 px-5 py-4 sm:px-6">
            @isset($title)
                <div class="font-semibold text-slate-900">{{ $title }}</div>
            @endisset
            @isset($actions)
                <div>{{ $actions }}</div>
            @endisset
        </header>
    @endif
    <div class="p-5 sm:p-6">
        {{ $slot }}
    </div>
</section>
