@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder' => '',
    'success' => false,
    'error' => false
])

@isset($label)
    <label
        for="{{ $name }}"
        class="{{ $success ? 'dark:text-green-500 text-green-700' : ($error ? 'text-red-700 dark:text-red-500' : 'text-gray-900 dark:text-white') }} block mb-2 text-sm font-medium"
    >{{ $label }}</label>
@endisset
<input
    type="text"
    id="{{ $name }}"
    name="{{ $name }}"
    class="{{ $success ? 'bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-green-100 dark:border-green-400' : '' }} {{ $error ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700' : '' }} text-sm rounded-lg block w-full p-2.5"
    placeholder="{{ $placeholder }}"
    value="{{ $value }}"
/>
@if($error)
    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
@endif
