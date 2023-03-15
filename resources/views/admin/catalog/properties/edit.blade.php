<x-admin-layout>
    <div class="p-4">
        <form action="{{ route('admin.catalog.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="propertyTabsTitle" data-tabs-toggle="#propertyTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="propertyTabTitle" data-tabs-target="#propertyTab" type="button" role="tab" aria-controls="property" aria-selected="false">Property</button>
                    </li>
                    @if ($property->type == \App\Enums\Catalog\PropertyType::ENUM)
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="enumsTabTitle" data-tabs-target="#enumsTab" type="button" role="tab" aria-controls="enums" aria-selected="false">Enums</button>
                        </li>
                    @endif
                </ul>
            </div>

            <div id="propertyTabContent">
                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="propertyTab" data-role="tabpanel" role="tabpanel" aria-labelledby="property-tab">
                    <x-form.input-wrap>
                        <x-form.input-checkbox
                            :label="'Active'"
                            :name="'active'"
                            :checked="$property->active"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-text
                            :label="'Sort'"
                            :name="'sort'"
                            :value="$property->sort"
                            :placeholder="'100'"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-text
                            :label="'Name'"
                            :name="'name'"
                            :value="$property->name"
                            :placeholder="'name'"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-text
                            :label="'Slug'"
                            :name="'slug'"
                            :value="$property->slug"
                            :placeholder="'slug'"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-checkbox
                            :label="'Filterable'"
                            :name="'filterable'"
                            :checked="$property->filterable"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-checkbox
                            :label="'Multiple'"
                            :name="'multiple'"
                            :checked="$property->multiple"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-text
                            :label="'View format'"
                            :name="'view_format'"
                            :value="$property->view_format"
                            :placeholder="'{.6f}'"
                        />
                    </x-form.input-wrap>
                </div>

                @if ($property->type == \App\Enums\Catalog\PropertyType::ENUM)
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="enumsTab" data-role="tabpanel" role="tabpanel" aria-labelledby="enums-tab">
                        <table>
                            <thead>
                            <tr>
                                <th>sort</th>
                                <th>name</th>
                                <th>slug</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($property->propertyEnums as $enum)
                                <tr>
                                    <td>
                                        <input type="hidden" name="enums[{{ $enum->id }}][id]" value="{{ $enum->id }}" />
                                        <x-form.input-text
                                            :name="'enums['.$enum->id.'][sort]'"
                                            :value="$enum->sort"
                                            :placeholder="'100'"
                                        />
                                    </td>
                                    <td>
                                        <x-form.input-text
                                            :name="'enums['.$enum->id.'][name]'"
                                            :value="$enum->name"
                                            :placeholder="''"
                                        />
                                    </td>
                                    <td>
                                        <x-form.input-text
                                            :name="'enums['.$enum->id.'][slug]'"
                                            :value="$enum->slug"
                                            :placeholder="''"
                                        />
                                    </td>
                                </tr>
                            @endforeach
                            @for($i = 0; $i < 4; $i ++)
                                <tr>
                                    <td>
                                        <input type="hidden" name="enums[n{{ $i }}][id]" value="" />
                                        <x-form.input-text
                                            :name="'enums[n'.$i.'][sort]'"
                                            :value="old('enums[n'.$i.'][sort]')"
                                            :placeholder="'100'"
                                        />
                                    </td>
                                    <td>
                                        <x-form.input-text
                                            :name="'enums[n'.$i.'][name]'"
                                            :value="old('enums[n'.$i.'][name]')"
                                            :placeholder="''"
                                        />
                                    </td>
                                    <td>
                                        <x-form.input-text
                                            :name="'enums[n'.$i.'][slug]'"
                                            :value="old('enums[n'.$i.'][slug]')"
                                            :placeholder="''"
                                        />
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="mt-4">
                <input type="submit" name="submit" value="Save" class="bg-blue-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
                <input type="submit" name="apply" value="Apply" class="ml-2 bg-blue-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
            </div>
        </form>
        <script>
            @if ($property->type == \App\Enums\Catalog\PropertyType::ENUM)
                function setActiveTab(e)
                {
                    let buttons = document.querySelectorAll('#propertyTabsTitle button');
                    for (let i = 0; i < buttons.length; i++) {
                        buttons[i].classList.remove('active');
                    }

                    let tabs = document.querySelectorAll('#propertyTabContent [data-role="tabpanel"]');
                    for (let i = 0; i < tabs.length; i++) {
                        tabs[i].classList.add('hidden');
                    }

                    let title = e.target;
                    title.classList.add('active');
                    let tab = document.querySelector(title.dataset.tabsTarget);
                    tab.classList.remove('hidden');
                }

                document.getElementById('propertyTabTitle').addEventListener('click', setActiveTab);
                document.getElementById('enumsTabTitle').addEventListener('click', setActiveTab);

            @endif

        </script>
    </div>
</x-admin-layout>
