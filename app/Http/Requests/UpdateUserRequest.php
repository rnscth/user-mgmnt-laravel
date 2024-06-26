<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $method = $this->method();

        if($method == 'PUT'){
            return [
                'name' => ['required'],
                'email' => ['required','email'],
                'enabled' => ['required'],
                'password' => ['required'],
                'isAdmin' => ['required'],

            ];
        } else {
            return [
                'name' => ['sometimes','required'],
                'email' => ['sometimes','required','email'],
                'enabled' => ['sometimes','required'],
                'password' => ['sometimes','required'],
                'isAdmin' => ['sometimes','required'],

            ];
        }
    }
}
