<x-admin-layout>
    <x-slot:pageTitle>
        Create new section
    </x-slot:pageTitle>

    <div class="p-4">
        <form action="{{ route('admin.catalog.sections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div>
                <x-form.fields-list :fields="$fields"/>
            </div>

            <x-admin.catalog.sections-dropdown
                :name="'parent_section_id'"
                :label="'Parent section'"
                :currentSectionId="0"
                :selected="[old('parent_section_id')]"
            />

            <div class="mt-4">
                <input type="submit" name="submit" value="Save" class="bg-blue-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
                <input type="submit" name="apply" value="Apply" class="ml-2 bg-blue-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
            </div>
        </form>
    </div>
</x-admin-layout>
