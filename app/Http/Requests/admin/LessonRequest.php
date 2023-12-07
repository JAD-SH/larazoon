<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            //'title'=> 'required|string|max:50|unique:lessons,title,'.$this->id,
            'title'=> 'required|string|max:50',
            'content'=> 'required',
            'slug'=> 'required|unique:lessons,slug,'.$this->id,
            'about'=> 'required_with:lesson_id|string|max:50',
            'photo' => 'mimes:jpg,jpeg,png',
            'description'=> 'required|string|max:500',
        ];
    }
    public function messages()
    {
        return [
            'photo.mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',
            'slug.unique'=> 'ال slug هذا بالفعل تم استخدامه . الرجاء استخدام slug اخر فريد',
            'required'=> 'هذا الحقل مطلوب',
            'required_with'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'title.max'=> 'اسم الدرس يجب ان لا يزيد عن 50 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
        ];
    }
}
