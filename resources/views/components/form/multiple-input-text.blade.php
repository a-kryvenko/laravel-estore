@props([
    'name' => '',
    'label' => '',
    'values' => [],
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
@foreach($values as $value)
    <div class="mb-2">
        <x-form.input-text
            :name="$name . '[]'"
            :value="$value"
        />
    </div>
@endforeach
@for($i = 0; $i < 4; $i ++)
    <div class="mb-2">
        <x-form.input-text
            :name="$name . '[]'"
            :value=""
        />
    </div>
@endfor
