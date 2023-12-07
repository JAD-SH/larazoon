<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            //'title'=> 'required|string|max:75|unique:articles,title,'.$this->id,
            'slug'=> 'required|string|max:75|unique:articles,slug,'.$this->id,
            'title'=> 'required|string|max:75',
            'content'=> 'required',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'description'=> 'required|string|max:500',
        ];
    }
    public function messages()
    {
        return [
            'slug.unique'=>'ال slug هذا بالفعل تم استخدامه . الرجاء استخدام slug اخر فريد',
            'required'=> 'هذا الحقل مطلوب',
            'required_without'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'title.max'=> 'اسم المقال يجب ان لا يزيد عن 75 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
            'photo.mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',

        ];
    }
}
