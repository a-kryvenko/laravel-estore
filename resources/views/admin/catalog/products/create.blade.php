<x-admin-layout>
    <x-slot:pageTitle>
        Create new product
    </x-slot:pageTitle>

    <div class="p-4">
        <form action="{{ route('admin.catalog.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div>
                <x-form.fields-list :fields="$fields"/>
            </div>

            <x-admin.catalog.sections-dropdown
                :name="'sections'"
                :label="'sections'"
                :currentSectionId="'-1'"
                :multiple="true"
                :selected="old('sections', $sections, [0])"
            />

            <h3>Properties</h3>

            <div>
                <x-form.fields-list :fields="$properties"/>
            </div>

            <div class="mt-4">
                <input type="submit" name="submit" value="Save" class="bg-blue-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
                <input type="submit" name="apply" value="Apply" class="ml-2 bg-blue-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
            </div>
        </form>
    </div>
</x-admin-layout>
