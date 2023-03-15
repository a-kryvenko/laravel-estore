<?php

namespace App\Http\Requests\Estore\Admin\Catalog;

use App\Enums\Catalog\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdatePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'active' => $this->request->has('active'),
            'filterable' => $this->request->has('filterable'),
            'multiple' => $this->request->has('multiple'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'active' => 'required|boolean',
            'sort' => 'nullable|integer',
            'name' => 'required',
            'slug' => 'required',
            'filterable' => 'boolean',
            'multiple' => 'boolean',
            'view_format' => 'nullable|string',
            'enums.*.id' => 'nullable|integer|exclude_without:enums.*.name|exclude_without:enums.*.slug',
            'enums.*.sort' => 'nullable|integer|exclude_without:enums.*.name|exclude_without:enums.*.slug',
            'enums.*.name' => 'exclude_without:enums.*.slug|distinct:ignore_case|string',
            'enums.*.slug' => 'exclude_without:enums.*.name|distinct:ignore_case|string'
        ];
    }
}
