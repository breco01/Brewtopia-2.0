<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $isAuthed = auth()->check();

        return [
            'name' => [$isAuthed ? 'nullable' : 'required', 'string', 'max:255'],
            'email' => [$isAuthed ? 'nullable' : 'required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'min:3', 'max:255'],
            'message' => ['required', 'string', 'min:20', 'max:2000'],
        ];
    }
}
