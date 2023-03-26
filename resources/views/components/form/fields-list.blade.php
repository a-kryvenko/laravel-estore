@php use App\Enums\Catalog\PropertyType; @endphp
@props([
    'fields'
])

@foreach($fields as $field)
    <x-form.input-wrap>
        @if(isset($field['multiple']) && $field['multiple'])
            @switch($field['type'])
                @case(PropertyType::FILE)
                    <div>
                        <x-form.files-drag-and-drop
                            :label="$field['label']"
                            :name="$field['name']"
                            :values="$field['values']"
                        />
                    </div>
                    @break
                @case(PropertyType::TEXT)
                    <x-form.multiple-textarea
                        :label="$field['label']"
                        :name="$field['name']"
                        :value="$field['value']"
                    />
                    @break
                @case(PropertyType::ENUM)
                    <x-form.select
                        :name="$field['name']"
                        :label="$field['label']"
                        :multiple="true"
                    >
                        @foreach($field['options'] as $option)
                            <option
                                value="{{ $option['value'] }}" {{ $option['selected'] ? 'selected' : '' }}>{{ $option['title'] }}</option>
                        @endforeach
                    </x-form.select>
                    @break
                @case(PropertyType::BOOLEAN)
                    <x-form.input-checkbox
                        :label="$field['label']"
                        :name="$field['name']"
                        :checked="$field['value']"
                    />
                    @break
                @default
                    <x-form.multiple-input-text
                        :label="$field['label']"
                        :name="$field['name']"
                        :values="$field['values']"
                        :placeholder="''"
                    />
                    @break
            @endswitch
        @else
            @switch($field['type'])
                @case(PropertyType::FILE)
                    <x-form.input-file
                        :label="$field['label']"
                        :name="$field['name']"
                        :value="''"
                    />
                    @break
                @case(PropertyType::TEXT)
                    <x-form.textarea
                        :label="$field['label']"
                        :name="$field['name']"
                        :value="$field['value']"
                    />
                    @break
                @case(PropertyType::ENUM)
                    <x-form.select name="{{ $field['name'] }}" label="{{ $field['label'] }}">
                        @foreach($field['options'] as $option)
                            <option
                                value="{{ $option['value'] }}" {{ $option['selected'] ? 'selected' : '' }}>{{ $option['title'] }}</option>
                        @endforeach
                    </x-form.select>
                    @break
                @case(PropertyType::BOOLEAN)
                    <x-form.input-checkbox
                        :label="$field['label']"
                        :name="$field['name']"
                        :checked="$field['value']"
                    />
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
        @endif
    </x-form.input-wrap>
@endforeach
