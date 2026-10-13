<div class="overflow-x-auto">
    <table {{ $attributes->class(['min-w-full divide-y divide-slate-200 text-left text-sm']) }}>
        @isset($head)
            <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>{{ $head }}</tr>
            </thead>
        @endisset
        <tbody class="divide-y divide-slate-100 bg-white">
            {{ $slot }}
        </tbody>
    </table>
</div>
