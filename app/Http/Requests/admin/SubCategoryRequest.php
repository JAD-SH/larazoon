<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'slug'=> 'required|string|max:75|unique:sub_categories,slug,'.$this->id,
            'title' => 'required|string|max:20',
            'icon' => 'required|string|max:50',
            'color' => 'required',
            'description' => 'required|string|max:500',

        ];
    }
    public function messages()
    {
        return [
            'slug.unique'=> 'ال slug هذا بالفعل تم استخدامه . الرجاء استخدام slug اخر فريد',
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'title.max'=> 'عنوان القسم الفرعي يجب ان لا يزيد عن 20 حرف',
            'icon.max'=> 'هذا الحقل يجب ان لا يزيد عن 50 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
            ];
    }
}
