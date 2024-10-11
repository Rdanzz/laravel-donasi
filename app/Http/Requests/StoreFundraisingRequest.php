<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFundraisingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['fundraiser']);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           
            'category_id' => ['required', 'integer'],
            'target_amount' => ['required', 'integer'],
            'about' => ['required', 'string', 'max:65535'], 'name' => ['required', 'string', 'max:255'],
            'thumbnail' => ['required', 'image', 'mimes:jpg,png,jpeg'],
        ];
    }
}
