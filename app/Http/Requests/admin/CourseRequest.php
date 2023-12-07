<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
           
            'title'=> 'required|string|max:25|unique:courses,title,'.$this->id,
            'slug'=> 'required|unique:courses,slug,'.$this->id,
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'color'=> 'required',
            'description'=> 'required|string|max:500',

            ];
    }
    public function messages()
    {
        return [
            'unique'=>' هذا الكورس بالفعل موجود',
            'slug.unique'=>'ال slug هذا بالفعل تم استخدامه . الرجاء استخدام slug اخر فريد',
            'required'=> 'هذا الحقل مطلوب',
            'required_without'=> 'هذا الحقل مطلوب',
            'integer'=> 'القيم المدخلة غير صحيحية',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'photo.mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',
            'title.max'=> 'اسم الكورس يجب ان لا يزيد عن 25 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
            ];
    }
}
