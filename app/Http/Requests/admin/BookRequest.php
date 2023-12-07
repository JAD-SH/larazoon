<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'=> 'required|string|max:75',
            'slug'=> 'required|string|max:75|unique:books,slug,'.$this->id,
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'file' => 'required_without:id|mimes:pdf',
            'language'=> 'required|string|max:25',
            'author'=> 'required|string|max:25',
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
            'photo.mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',
            'file.mimes'=> 'الكتاب يجب ان يكون من النوع ( pdf )',
            'title.max'=> 'اسم الكتاب يجب ان لا يزيد عن 75 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
        ];
    }
}
