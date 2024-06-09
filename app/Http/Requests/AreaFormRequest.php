<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaFormRequest extends FormRequest
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
            'name' => ['required' , 'array'],
            'name.*'=> ['string' , 'min:3' , 'max:25'],
            'city_id' => ['required' , 'integer' , 'exists:cities,id']
        ];
    }

    public function messages()
    {
        return [
            'city_id.required' => __('validation.city_id_validation'),
            'city_id.integer' => __('validation.city_id_integer_validation')
        ];
    }
}
