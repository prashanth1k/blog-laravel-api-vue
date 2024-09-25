<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'user_id' => ['integer'],
            'published_at' => ['nullable', 'date'],
            'slug' => ['required', 'string', 'max:255'],
            'imageUrl' => ['string', 'max:255'],
            'status' => ['string', 'max:255'],
            'tags' => ['array'],
            'tags.*' => ['string'],
            'categories' => ['array'],
            'categories.*' => ['string'],
        ];
    }
}
