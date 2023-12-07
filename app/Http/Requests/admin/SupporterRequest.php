<?php

namespace App\Http\Requests\admin;

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
             'support_value' => 'required|integer',
         ];
    }
    public function messages()
    {
        return [
            'required'=> 'هذا الحقل مطلوب',
            'integer'=> 'قيم الدعم يجب ان تكون رقمية',
        ];
    }
}
