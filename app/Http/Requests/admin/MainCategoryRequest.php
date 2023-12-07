<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            
            
            'title'=> 'required|string|max:10',
            'icon' => 'required|string|max:50',
            'Light_photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'dark_photo' => 'mimes:jpg,jpeg,png',
            'color'=> 'required',
            'description'=> 'required|string|max:500',
            
        ];
    }
    public function messages()
    {
        return [
            'required'=> 'هذا الحقل مطلوب',
            'required_without'=> 'هذا الحقل مطلوب',
            'in'=> 'القيم المدخلة غير صحيحية',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'icon.max'=> 'هذا الحقل يجب ان لا يزيد عن 50 حرف',
            'mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',
            'title.max'=> 'اسم القسم يجب ان لا يزيد عن 10 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
            ];
    }
}
