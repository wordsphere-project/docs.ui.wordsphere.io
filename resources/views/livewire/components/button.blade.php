<div>
    <div class="flex border border-gray-200 dark:border-gray-700 border-b-0 rounded-t-md">
        <div class="flex flex-col gap-0.5 px-2.5 py-1 dark:bg-gray-800/45 border-r border-gray-200 dark:border-gray-700">
            <label class="dark:text-gray-500 text-xs">size</label>
            <select wire:model.change="size" class="block w-full rounded-md border-0 border-gray-200 dark:border-gray-700 py-1 pl-0 pr-8 text-gray-900 dark:text-gray-200 dark:bg-gray-800/0 ring-0 ring-inset ring-gray-300 focus:ring-0 focus:ring-indigo-600 text-sm">
                @foreach($sizeOptions as $option)
                    <option value="{{$option}}">{{ $option }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="p-4 border border-b-0 border-gray-200 dark:border-gray-700 relative">
        <x-button :size="$size">{{ $label }}</x-button>
    </div>
    <div class="dark:bg-gray-800/45 border border-gray-200 dark:border-gray-700 rounded-b-md relative">
        <x-highlight lang="blade">
            @verbatim <x-button@endverbatim size="{{ $size }}">{{ $label }}@verbatim</x-button>@endverbatim
        </x-highlight>
    </div>
</div>
