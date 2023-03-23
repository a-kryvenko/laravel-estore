<x-admin-layout>
    <x-slot:pageTitle>
        Create new property
    </x-slot:pageTitle>

    <div class="p-4">
        <form action="{{ route('admin.catalog.properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="propertyTabsTitle" data-tabs-toggle="#propertyTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="propertyTabTitle" data-tabs-target="#propertyTab" type="button" role="tab" aria-controls="property" aria-selected="false">Property</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="hidden inline-block p-4 border-b-2 rounded-t-lg" id="enumsTabTitle" data-tabs-target="#enumsTab" type="button" role="tab" aria-controls="enums" aria-selected="false">Enums</button>
                    </li>
                </ul>
            </div>

            <div id="propertyTabContent">
                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="propertyTab" data-role="tabpanel" role="tabpanel" aria-labelledby="property-tab">
                    <x-form.input-wrap>
                        <x-form.input-checkbox
                            :label="'Active'"
                            :name="'active'"
                            :checked="old('active')"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.select name="type" label="Property type">
                            @foreach(\App\Enums\Catalog\PropertyType::cases() as $type)
                                <option value="{{ $type->value }}">{{ $type->name }}</option>
                            @endforeach
                        </x-form.select>
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-text
                            :label="'Sort'"
                            :name="'sort'"
                            :value="old('sort')"
                            :placeholder="'100'"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-text
                            :label="'Name'"
                            :name="'name'"
                            :value="old('name')"
                            :placeholder="'name'"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-text
                            :label="'Slug'"
                            :name="'slug'"
                            :value="old('slug')"
                            :placeholder="'slug'"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-checkbox
                            :label="'Filterable'"
                            :name="'filterable'"
                            :checked="old('filterable')"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-checkbox
                            :label="'Multiple'"
                            :name="'multiple'"
                            :checked="old('multiple')"
                        />
                    </x-form.input-wrap>

                    <x-form.input-wrap>
                        <x-form.input-text
                            :label="'View format'"
                            :name="'view_format'"
                            :value="old('view_format')"
                            :placeholder="'{.6f}'"
                        />
                    </x-form.input-wrap>
                </div>
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
                            @for($i = 0; $i < 6; $i ++)
                                <tr>
                                    <td>
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
            </div>

            <div class="mt-4">
                <input type="submit" name="submit" value="Save" class="bg-blue-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
                <input type="submit" name="apply" value="Apply" class="ml-2 bg-blue-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
            </div>
        </form>
        <script>
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

            function propertyTypeChangedHandler(e)
            {
                let select = e.target;
                let tabTitle = document.getElementById('enumsTabTitle');

                if (select.value === 'E') {
                    tabTitle.classList.remove('hidden');
                } else {
                    tabTitle.classList.add('hidden');
                }
            }


            document.getElementById('propertyTabTitle').addEventListener('click', setActiveTab);
            document.getElementById('enumsTabTitle').addEventListener('click', setActiveTab);

            document.getElementById('type').addEventListener('change', propertyTypeChangedHandler);

        </script>
    </div>
</x-admin-layout>
