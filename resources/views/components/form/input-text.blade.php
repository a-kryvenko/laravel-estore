@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'placeholder' => '',
    'success' => false,
    'error' => false
])

@isset($label)
    <x-form.input-label
        :name="$name"
        :label="$label"
    />
@endisset
<input
    type="text"
    id="{{ $name }}"
    name="{{ $name }}"
    class="{{ $success ? 'bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-green-100 dark:border-green-400' : ($error ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700' : 'bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500') }} text-sm rounded-lg block w-full p-2.5"
    placeholder="{{ $placeholder }}"
    value="{{ $value }}"
/>
@if($error)
    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
@endif
