<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ServiceRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'details' => ['nullable', 'string', 'max:20000'],
            'image' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'gallery' => ['nullable', 'array', 'max:'.Service::MAX_IMAGES],
            'gallery.*' => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
            'status' => ['required', 'in:active,inactive,draft,archived'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $service = $this->route('service');
                $kept = $service
                    ? $service->images()->whereNotIn('id', $this->input('remove_images', []))->count()
                    : 0;
                $adding = count($this->file('gallery', []));

                if ($kept + $adding > Service::MAX_IMAGES) {
                    $validator->errors()->add(
                        'gallery',
                        'A service can have up to '.Service::MAX_IMAGES." pictures. It has {$kept} saved and you are adding {$adding}."
                    );
                }
            },
        ];
    }
}
