<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleLibraryRequest extends FormRequest
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
           
            'title'=> 'required|string|max:15|unique:article_libraries,title,'.$this->id,
            'slug'=> 'required|unique:article_libraries,slug,'.$this->id,
            'description'=> 'required|string|max:500',
            
        ];
    }
    public function messages()
    {
        return [
            'unique'=>'مكتبة المقالات هذه بالفعل موجودة',
            'required'=> 'هذا الحقل مطلوب',
            'slug.unique'=> 'ال slug هذا بالفعل تم استخدامه . الرجاء استخدام slug اخر فريد',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'title.max'=> 'اسم المكتبة يجب ان لا يزيد عن 15 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
        ];
    }
}
