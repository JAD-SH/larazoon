<?php

namespace App\Http\Requests\front;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|mimes:jpg,jpeg,png|max:5240',
            'gender' => 'required|in:0,1',
            'description' => 'nullable|string|max:500',
            'facebook' => 'nullable|url|regex:/^https:\/\/(www\.)?facebook\.com/',
            'twitter' => 'nullable|url|regex:/^https:\/\/(www\.)?twitter\.com/',
            'instagram' => 'nullable|url|regex:/^https:\/\/(www\.)?instagram\.com/',
            'github' => 'nullable|url|regex:/^https:\/\/(www\.)?github\.com/',
            
        ];
    }

    public function messages()
    {
        return [
            'required'=> 'هذا الحقل مطلوب',
            'birth_date.date'=> 'يجب ادخال تاريخ',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'photo.mimes'=> 'امتداد الصورة يجب ان يكون من النوع (jpg , jpeg , png)',
            'photo.max'=> 'حجم الصورة كبير جدا .. الحجم المسموح به حتى 5Mb',
            'name.max'=> 'الاسم يجب ان لا يزيد عن 25 حرف',
            'description.max'=> 'الوصف يجب ان لا يزيد عن 500 حرف',
            'url' => 'هذا ليس رابط ... الرجاء ادخال رابط صالح',
            'facebook.regex' => 'برجاء ادخال رابط facebook صالح',
            'twitter.regex' => 'برجاء ادخال رابط twitter صالح',
            'instagram.regex' => 'برجاء ادخال رابط instagram صالح',
            'github.regex' => 'برجاء ادخال رابط github صالح',
            'gender.in' => 'جنس غير معروف للبشرية ',
        ];
    }
}
