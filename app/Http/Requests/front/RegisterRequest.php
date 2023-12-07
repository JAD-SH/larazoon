<?php

namespace App\Http\Requests\front;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:25',
            'email' => 'required|string|email|min:8|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed|max:50',
            'description' => 'nullable|string|max:500',

            'birth_date' => 'nullable|date',
            'photo' => 'nullable|mimes:jpg,jpeg,png|max:5240',
            'interest' => 'required|max:25',
            
        ];
    }

    public function messages()
    {
        return [
            'required'=> 'هذا الحقل مطلوب',
            'photo.max'=> 'حجم الصورة كبير جدا .. الحجم المسموح به حتى 5Mb',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'photo.mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',
            'name.max'=> 'الاسم يجب ان لا يزيد عن 25 حرف',
            'email.max'=> 'البريد الالكتروني يجب ان لا يزيد عن 50 حرف',
            'password.max'=> 'كلمة المرور يجب ان لا يزيد عن 50 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
            'name.min'=> 'هذا الحقل يجب ان لا يقل عن 3 احرف',
            'min'=> 'هذا الحقل يجب ان لا يقل عن 8 احرف',
            'unique'=> 'هذا البريد الالكتروني موجود سابقا',
            'confirmed'=> 'كلمة المرور غير مطابقة',
            'email'=> 'يجب ادخال بريد الكتروني صالح (مثال example@gmail.com)',
        ];
    }
}
