@props(['disabled' => false])

<div class="mb-4">
    <label
        for="{{ $id }}"
        class="{{ $success ? 'dark:text-green-500 text-green-700' : '' }} {{ $error ? 'text-red-700 dark:text-red-500' : '' }} block mb-2 text-sm font-medium"
    >{{ $label }}</label>
    <input
        type="text"
        id="{{ $id }}"
        class="{{ $success ? 'bg-green-50 border border-green-500 text-green-900 placeholder-green-700' : '' }} {{ $error ? 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700' : '' }} text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-green-100 dark:border-green-400"
        placeholder="Bonnie Green"
        />
    @if($error)
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
    @endif
</div>
