<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class QuestionLibraryRequest extends FormRequest
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
           
            'title'=> 'required|string|max:15|unique:question_libraries,title,'.$this->id,
            'slug'=> 'required|unique:question_libraries,slug,'.$this->id,
            'description'=> 'required|string|max:500',
            
        ];
    }
    public function messages()
    {
        return [
            'unique'=>'مكتبة الاسئلة هذه بالفعل موجودة',
            'slug.unique'=>'ال slug هذا بالفعل تم استخدامه . الرجاء استخدام slug اخر فريد',
            'required'=> 'هذا الحقل مطلوب',
            'required_without'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'photo.mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',
            'title.max'=> 'اسم المكتبة يجب ان لا يزيد عن 15 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
        ];
    }
}
