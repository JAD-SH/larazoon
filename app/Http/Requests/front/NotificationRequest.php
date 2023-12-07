<?php

namespace App\Http\Requests\front;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'title'=> 'required|string|max:50|min:10',
            'message' => 'required|string|max:1000',
            'type' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'title.max'=> 'هذا الحقل يجب ان لا يزيد عن 50 حرف',
            'title.min'=> 'هذا الحقل يجب ان لا يقل عن 10 حرف',
            'message.max'=> 'هذا الحقل يجب ان لا يزيد عن 1000 حرف',
        ];
    }
}
