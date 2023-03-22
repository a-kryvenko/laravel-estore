@props([
    'name' => '',
    'label' => '',
    'values' => [],
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
@foreach($values as $value)
    <div class="mb-2">
        <x-form.input-file
            :name="$name . '[]'"
            :value="$value"
        />
    </div>
@endforeach
@for($i = 0; $i < 4; $i ++)
    <div class="mb-2">
        <x-form.input-file
            :name="$name . '[]'"
            :value="''"
        />
    </div>
@endfor
