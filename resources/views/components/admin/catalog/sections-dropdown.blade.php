@props([
    'name' => '',
    'label' => '',
    'selected' => [],
    'multiple' => false
])

<x-form.select :label="$label" :name="$name" :multiple="$multiple">
    @foreach($options as $id => $title)
        <option
            value="{{ $id }}"
            {{ in_array($id, $selected) ? 'selected' : ''}}
        >
            {!! $title !!}
        </option>
    @endforeach
</x-form.select>
