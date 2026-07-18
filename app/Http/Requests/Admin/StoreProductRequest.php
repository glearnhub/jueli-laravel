<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:product_categories,id'],
            'product_name' => ['required', 'string', 'max:255'],
            'product_description' => ['nullable', 'string'],
            'product_picture' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'price' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'status' => ['required', 'in:active,inactive,draft,archived'],
            'is_featured' => ['sometimes', 'boolean'],
        ];
    }
}
