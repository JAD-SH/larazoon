<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class TryitRequest extends FormRequest
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
            'slug'=> 'required_without:id|string|max:200|unique:try_it_codes,slug,'.$this->id,
            'code'=> 'required|string|max:2000',
            'type' => 'required|string',
            'code1'=> 'required_with:type1|nullable|string|max:2000',
            'type1' => 'required_with:code1|nullable|string',
            'code2'=> 'required_with:type2|nullable|string|max:2000',
            'type2' => 'required_with:code2|nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'slug.unique'=> ' slug بالفعل تم استخدامه',
            'required'=> 'هذا الحقل مطلوب',
            'required_without'=> 'هذا الحقل مطلوب',
            'required_with'=> 'اصبح هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'slug.max'=> 'slug يجب ان لا يزيد عن 200 حرف',
            'max'=> 'الكود يجب ان لا يزيد عن 2000 حرف',
        ];
    }
}
