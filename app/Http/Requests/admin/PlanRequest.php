<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           
            'title'=> 'required|string|max:10|unique:plans,title,'.$this->id,
            'description'=> 'required|string|max:500',

        ];
    }
    public function messages()
    {
        return [
            'unique'=>'خطة التعلم هذه بالفعل موجودة',
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'title.max'=> 'اسم الخطة يجب ان لا يزيد عن 10 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
        ];
    }
}
