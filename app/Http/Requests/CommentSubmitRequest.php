<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentSubmitRequest extends FormRequest
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
            'comments' => 'required|string|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'comment'=> 'You have to write something to comment',
        ];
    }
}
