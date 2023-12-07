<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class NotificationReplyRequest extends FormRequest
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
            'message' => 'required|string|max:1000',
            'code' => 'string|max:1000|nullable',
            'notification_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'max'=> 'هذا الحقل يجب ان لا يزيد عن 1000 حرف',
        ];
    }
}
