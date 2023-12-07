<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BookLibraryRequest extends FormRequest
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
           
            'title'=> 'required|string|max:15|unique:book_libraries,title,'.$this->id,
            'slug'=> 'required|string|max:75|unique:book_libraries,slug,'.$this->id,
            'description'=> 'required|string|max:500',
            
        ];
    }
    public function messages()
    {
        return [
            'unique'=>'مكتبة الكتب هذه بالفعل موجودة',
            'slug.unique'=>'ال slug هذا بالفعل تم استخدامه . الرجاء استخدام slug اخر فريد',
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'title.max'=> 'اسم المكتبة يجب ان لا يزيد عن 15 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
        ];
    }
}
