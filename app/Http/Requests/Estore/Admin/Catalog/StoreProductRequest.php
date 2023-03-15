<?php

namespace App\Http\Requests\Estore\Admin\Catalog;

use App\Enums\User\UserPermission;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //return $this->user()->can(UserPermission::EDIT_CATALOG->name);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'status_id' => 'required|integer',
            'available' => 'required|boolean',
            'sort' => 'required|integer',
            'sku' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'canonical_section' => 'nullable|integer',
            'purchasing_price' => 'required|numeric',
            'base_price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'length' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'package' => 'nullable|integer',
            'description' => 'nullable|string',
        ];
    }
}
