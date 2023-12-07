<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
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
            'site_name'=> 'required|string|max:15',
            'ar_site_name'=> 'required|string|max:15',
            'site_description'=> 'required|string|max:500',
            'site_photo' => 'mimes:jpg,jpeg,png',
            'site_logo' => 'mimes:png',
            //'site_sm_logo' => 'mimes:png',
            'user_profile_background' => 'mimes:jpg,jpeg,png',            
        ];
    }


    
    public function messages()
    {
        return [
            'site_name.max'=> 'اسم الموقع يجب ان لا يزيد عن 15 حرف',
            'ar_site_name.max'=> 'اسم الموقع يجب ان لا يزيد عن 15 حرف',
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'icon.max'=> 'هذا الحقل يجب ان لا يزيد عن 50 حرف',
            'site_photo.mimes'=> 'امتداد صورة الموقع يجب ان يكون من النوع (jpg , jpeg , png)',
            'site_logo.mimes'=> 'امتداد لوجو الموقع يجب ان يكون من النوع (jpg , jpeg , png)',
            //'site_sm_logo.mimes'=> 'امتداد لوجو الموقع يجب ان يكون من النوع (jpg , jpeg , png)',
            'user_profile_background.mimes'=> 'امتداد صورة خلفية الملف الشخصي للمستخدمين يجب ان يكون من النوع (jpg , jpeg , png)',
            'site_description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
        ];
    }
}
