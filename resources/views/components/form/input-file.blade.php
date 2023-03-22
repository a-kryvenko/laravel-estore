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
    type="file"
    id="{{ $name }}"
    name="{{ $name }}"
    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
    value="{{ $value }}"
/>
@if($error)
    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
@endif
