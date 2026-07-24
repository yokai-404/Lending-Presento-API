<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Определяет, имеет ли пользователь право выполнять запрос.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'min:8',
                'max:30',
            ],

            'message' => [
                'required',
                'string',
                'min:10',
                'max:5000',
            ],
        ];
    }

    /**
     * Пользовательские сообщения об ошибках.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно.',
            'name.min' => 'Имя должно содержать минимум 2 символа.',
            'name.max' => 'Имя не должно превышать 100 символов.',

            'email.required' => 'Поле "Email" обязательно.',
            'email.email' => 'Введите корректный email.',

            'phone.required' => 'Поле "Телефон" обязательно.',
            'phone.min' => 'Телефон слишком короткий.',
            'phone.max' => 'Телефон слишком длинный.',

            'message.required' => 'Поле "Комментарий" обязательно.',
            'message.min' => 'Комментарий должен содержать минимум 10 символов.',
            'message.max' => 'Комментарий слишком длинный.',
        ];
    }

    /**
     * Подготавливаем данные до валидации.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->name),
            'email' => trim(strtolower((string) $this->email)),
            'phone' => trim((string) $this->phone),
            'message' => trim((string) $this->message),
        ]);
    }
}
