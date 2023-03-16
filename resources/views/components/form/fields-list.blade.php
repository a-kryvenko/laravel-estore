@props([
    'fields'
])

@foreach($fields as $field)
    <x-form.input-wrap>
        @switch($field['type'])
            @case(\App\Enums\Catalog\PropertyType::TEXT)
                <x-form.textarea
                    :label="$field['label']"
                    :name="$field['name']"
                    :value="$field['value']"
                />
                @break
            @case(\App\Enums\Catalog\PropertyType::ENUM)
                <x-form.select name="{{ $field['name'] }}" label="{{ $field['label'] }}">
                    @foreach($field['options'] as $option)
                        <option value="{{ $option['value'] }}" {{ $option['checked'] ? 'checked' : '' }}>{{ $option['title'] }}</option>
                    @endforeach
                </x-form.select>
                @break
            @default
                <x-form.input-text
                    :label="$field['label']"
                    :name="$field['name']"
                    :value="$field['value']"
                    :placeholder="''"
                />
                @break
        @endswitch
    </x-form.input-wrap>
@endforeach
