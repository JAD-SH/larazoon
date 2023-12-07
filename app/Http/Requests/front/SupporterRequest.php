<?php

namespace App\Http\Requests\front;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class SupporterRequest extends FormRequest
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
        return [
            'email' => 'required|string|email',
            'support_value' => 'required|integer',
            'support_by' => ['required', Rule::in(['patreon','paypal'])],
        ];
    }
    public function messages()
    {
        return [
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'email'=> 'ادخلت بريد الكتروني غير صالح',
            'integer'=> 'قيم الدعم يجب ان تكون رقمية',
        ];
    }
}
