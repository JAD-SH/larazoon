<?php

namespace App\Http\Requests\front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\QuestionLibrary;

class QuestionRequest extends FormRequest
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
            'questionlibraries'=> 'required',
            'title'=> 'required|string|max:50|min:10',
            'description'=> 'required|string|max:10000|min:20',
            'questionlibraries.*'=> ['required',Rule::in(QuestionLibrary::select('id')->pluck('id'))],
        ];
    }
    public function messages()
    {
        return [
            'integer'=> 'القيم المدخلة غير صحيحية',
            'questionlibraries.*.in'=> 'مكتبة السؤال التي اخترتها غير صالحة',
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'title.max'=> 'عنوان السؤال يجب ان لا يزيد عن 50 حرف',
            'title.min'=> 'عنوان السؤال يجب ان لا يفل عن 10 احرف',
            'description.max'=> 'محتوى السؤال يجب ان لا يزيد عن 10000 حرف',
            'description.min'=> 'محتوى السؤال يجب ان لا يفل عن 20 حرف',
        ];
    }
}
