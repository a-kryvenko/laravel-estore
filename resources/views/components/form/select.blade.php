@props([
    'name' => '',
    'label' => '',
    'multiple' => false,
    'success' => false,
    'error' => false
])

<div class="mb-4">
    @isset($label)
        <x-form.input-label
            :name="$name"
            :label="$label"
        />
    @endisset
    <select
        {{ $multiple ? 'multiple' : '' }}
        id="{{ $name }}"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    >
        {{ $slot }}
    </select>
</div>
