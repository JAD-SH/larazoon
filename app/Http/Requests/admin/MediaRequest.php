<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'slug'=> 'required|string|max:200|unique:media,slug,'.$this->id,
            'media'=> 'required|mimes:jpg,jpeg,png,gif,ico,svg,mp4,webm,ogg,mp3',
        ];
    }
    public function messages()
    {
        return [
            'slug.unique'=> ' slug بالفعل تم استخدامه',
            'required'=> 'هذا الحقل مطلوب',
            'string'=> 'هذا الحقل لابد ان يكون نصّي',
            'slug.max'=> 'slug يجب ان لا يزيد عن 200 حرف',
            'image.mimes'=> 'امتداد media يجب ان يكون من النوع (jpg, jpeg, png, gif, ico, svg, mp4, webm, ogg, mp3)',
        ];
    }
}
