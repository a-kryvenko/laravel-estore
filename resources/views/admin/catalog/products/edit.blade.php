<x-admin-layout>
    <div class="p-4">
        <form action="{{ route('admin.catalog.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <x-form.fields-list :fields="$fields"/>
            </div>

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
