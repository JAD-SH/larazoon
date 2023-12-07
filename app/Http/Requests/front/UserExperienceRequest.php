<?php

namespace App\Http\Requests\front;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class UserExperienceRequest extends FormRequest
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
            'experience' => 'required|string|max:2000',
            'reaction' => ['required' , Rule::in(['1', '2', '3', '4']),]
        ];
    }
    public function messages()
    {
        return [
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'experience.max'=> 'هذا الحقل يجب ان لا يزيد عن 2000 حرف',
            'reaction'=> 'ادخلت قيمة خاطئة',
        ];
    }
}
