<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => ['required' , 'string' , 'alpha' , 'min:5' , 'max:25'],
            'email' => ['required' , 'email' , 'unique:users,email' , 'ends_with:.com'],
            'password' => ['required' , 'string' , 'min:8'],
            'password_confirm' => ['required_with:password' , 'same:password' , 'exclude_if:password," "' , 'required'],
            'profile_image' => ['required' , 'image' , 'mimes:jpg,png,svg' , 'dimensions:min_width=100,min_height=100' , 'min:1' , 'max:200']
        ];
    }
}
