@props([
    'name' => '',
    'label' => '',
    'value' => ''
])
@isset($label)
    <x-form.input-label
        :name="$name"
        :label="$label"
    />
@endisset
@foreach($values as $value)
    <div class="mb-2">
        <x-form.textarea
            :name="$name . '[]'"
            :value="$value"
        />
    </div>
@endforeach
@for($i = 0; $i < 4; $i ++)
    <div class="mb-2">
        <x-form.textarea
            :name="$name . '[]'"
            :value=""
        />
    </div>
@endfor


