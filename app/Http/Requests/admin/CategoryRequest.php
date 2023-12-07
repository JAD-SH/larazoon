<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title'=> 'required|string|max:75|unique:categories,title,'.$this->id,
            'slug'=> 'required|string|max:75|unique:categories,slug,'.$this->id,
            'content'=> 'required',
            'description'=> 'required|string|max:500',
            'photo' => 'mimes:jpg,jpeg,png',
        ];
    }
    public function messages()
    {
        return [
            'photo.mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',
            'unique'=> 'اسم العنصر بالفعل تم استخدامه',
            'slug.unique'=>'ال slug هذا بالفعل تم استخدامه . الرجاء استخدام slug اخر فريد',
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'title.max'=> 'اسم العنصر يجب ان لا يزيد عن 75 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
        ];
    }
}
