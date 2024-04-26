<div class="relative">
    <select
        wire:model="selectedOption"
        class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none white:bg-slate-900 dark:border-gray-700 dark:text-gray-800 dark:focus:ring-gray-600"
    >
        @foreach($options as $value => $optionLabel)
            <option value="{{ $value }}">{{ $optionLabel }}</option>
        @endforeach
    </select>
    <label
        class="absolute left-4 -top-1/2 transform -translate-y-1/2 text-sm text-dark-400 pointer-events-none mt-4 my-2"
    >
        {{ $label }}
    </label>
</div>
