<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class DownloaderRequest extends FormRequest
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
            'slug'=> 'required|string|max:200|unique:downloaders,slug,'.$this->id,
            'description'=> 'required|string|max:500',
            'file'=> 'required|mimes:zip,rar',
        ];
    }
    public function messages()
    {
        return [
            'slug.unique'=> ' slug بالفعل تم استخدامه',
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'slug.max'=> 'slug يجب ان لا يزيد عن 200 حرف',
            'file.mimes'=> 'امتداد الملف يجب ان يكون من النوع (zip, rar)',
        ];
    }
}
