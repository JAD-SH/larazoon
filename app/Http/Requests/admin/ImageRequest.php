<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'image'=> 'required|mimes:jpg,jpeg,png',
            'slug'=> 'required|string|max:200|unique:images,slug,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'slug.unique'=> ' slug بالفعل تم استخدامه',
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'slug.max'=> 'slug يجب ان لا يزيد عن 200 حرف',
            'image.mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',
        ];
    }
}
