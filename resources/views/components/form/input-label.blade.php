@props([
    'name' => '',
    'label' => '',
    'success' => false,
    'error' => false
])
<label
    for="{{ $name }}"
    class="{{ $success ? 'dark:text-green-500 text-green-700' : ($error ? 'text-red-700 dark:text-red-500' : 'text-gray-900 dark:text-white') }} block mb-2 text-sm font-medium"
>{{ $label }}</label>
