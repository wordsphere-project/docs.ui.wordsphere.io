<div class="sticky top-0 z-10">
    <header class="dark:bg-gray-900 backdrop-blur-2xl border-gray-700/40 border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-6 h-[--header-height]">
            <div class="flex items-center gap-2 xl:gap-10 flex-1">
                <a wire:navigate href="/" class="text-xl font-semibold">WordSphere UI</a>
            </div>
            <ul class="flex items-center gap-x-4">
                <li>
                    <a wire:navigate href="{{ route('documentation.index') }}" class="font-semibold">Documentation</a>
                </li>
                <li>
                    <a wire:navigate href="/" class="font-semibold">Releases</a>
                </li>
            </ul>
            <div class="flex justify-end gap-4 flex-1">
                <div>Github</div>
            </div>
        </div>
    </header>
</div>


