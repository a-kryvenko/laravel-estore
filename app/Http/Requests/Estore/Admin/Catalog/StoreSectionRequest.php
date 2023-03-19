<?php

namespace App\Http\Requests\Estore\Admin\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
            'active' => $this->request->has('active')
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
            'active' => 'boolean',
            'sort' => 'nullable|integer',
            'name' => 'required|string',
            'slug' => 'required|string',
            'parent_section_id' => 'nullable|integer',
            'description' => 'nullable|string',
        ];
    }
}
