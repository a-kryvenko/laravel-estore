@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'checked' => false,
    'success' => false,
    'error' => false
])

<div class="flex items-center">
    <input
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        checked="{{ $checked ? 'checked' : '' }}"
        value="1"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
    />
    @isset($label)
        <label
            for="{{ $name }}"
            class="{{ $success ? 'dark:text-green-500 text-green-700' : ($error ? 'text-red-700 dark:text-red-500' : 'text-gray-900 dark:text-white') }} ml-2 text-sm font-medium"
        >{{ $label }}</label>
    @endisset
</div>
@if($error)
    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
@endif
