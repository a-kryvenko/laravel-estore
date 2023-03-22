<?php

namespace App\Http\Requests\Estore\Admin\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|string',
            'sort' => 'nullable|integer',
            'sku' => 'required|string',
            'name' => 'required|string',
            'slug' => 'required|string',
            'canonical_section' => 'nullable|integer',
            'purchasing_price' => 'required|numeric',
            'base_price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'length' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'package' => 'nullable|string',
            'description' => 'nullable|string',
            'properties.*' => 'nullable'
        ];
    }
}
