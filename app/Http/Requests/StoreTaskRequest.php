<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:30',
            'description' => 'required|min:5|max:50'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Поле 'Название' обязательное к заполнению",
            'title.min' => "Поле 'Название' должно содаржать минимум 5 символов",
            'title.max' => "Поле 'Название' не должно превышать 30 символов",
            'description.min' => "Поле 'Описание' должно содаржать минимум 5 символов",
            'description.max' => "Поле 'Описание' не должно превышать 50 символов"
        ];
    }
}
