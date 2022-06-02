<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ContactMessageRequest extends FormRequest
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
    #[ArrayShape(['name' => "string", 'email' => "string", 'country' => "string", 'website' => "string", 'app' => "string", 'appInfo' => "string", 'message' => "string"])] public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'email|required',
            'country' => 'required',
            'website' => 'required',
            'app' => 'required',
            'appInfo' => 'required',
            'message' => 'required'
        ];
    }
}
