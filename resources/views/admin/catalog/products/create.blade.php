<x-admin-layout>
    <div class="p-4">
        <form action="{{ route('admin.catalog.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="">
                <span>available</span>
                <input type="checkbox" name="available" placeholder="available" value="1" checked="{{ old('available') }}">
            </label>
            <select name="status_id" id="status_id">
                @foreach(\App\Enums\Catalog\ProductStatus::cases() as $status)
                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                @endforeach
            </select>

            <input type="text" name="sort" placeholder="sort" value="{{ old('sort') }}">
            <input type="text" name="sku" placeholder="sku" value="{{ old('sku') }}">
            <input type="text" name="name" placeholder="name" value="{{ old('name') }}">
            <input type="text" name="slug" placeholder="slug" value="{{ old('slug') }}">
            <input type="text" name="purchasing_price" placeholder="purchasing_price" value="{{ old('purchasing_price') }}">
            <input type="text" name="base_price" placeholder="base_price" value="{{ old('base_price') }}">
            <input type="text" name="discount_price" placeholder="discount_price" value="{{ old('discount_price') }}">
            <input type="text" name="width" placeholder="width" value="{{ old('width') }}">
            <input type="text" name="height" placeholder="height" value="{{ old('height') }}">
            <input type="text" name="length" placeholder="length" value="{{ old('length') }}">
            <input type="text" name="weight" placeholder="weight" value="{{ old('weight') }}">
            <input type="text" name="package" placeholder="package" value="{{ old('package') }}">

            <textarea name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea>

            <div>
                <input type="submit" name="submit" value="Save" class="bg-blue-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
            </div>
        </form>
    </div>
</x-admin-layout>
