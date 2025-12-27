<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTrainerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'gender' => ['required', new Enum(Gender::class)],
            'email' => 'required|email|unique:trainers,email',
            'phone' => 'nullable|string|min:10|max:11',
        ];
    }
            public function messages(): array
    {
        return [
            'name.required'  => 'The Name is Required',
            'email.required' => 'The Email is Required',
            'gender.required' => 'The Gender is Required',
            'email.email'    => 'Enter Valid Email',
            'email.unique'   => 'This Email Already Exsist',
            'phone.min'      => 'Enter Valid Phone'
        ];
    }
}
