<?php

namespace App\Http\Requests;
use App\Enums\Gender as EnumsGender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreMemberRequest extends FormRequest
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
            'email' => 'required|email|unique:members,email',
            'phone' => 'nullable|string|min:10|max:11',
            'gender' => ['required', new Enum(EnumsGender::class)],
            'photo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];
    }
        public function messages(): array
    {
        return [
            'name.required'  => 'The Name is Required',
            'email.required' => 'The Email is Required',
            'email.email'    => 'Enter Valid Email',
            'email.unique'   => 'This Email Already Exsist',
            'phone.min'      => 'Enter Valid Phone',
            'photo.image'    => 'Enter Valid Image',
            'photo.mimes'    => 'jpeg, png, jpg, gif, webp => Only'
        ];
    }
}
