<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        return Auth::id() == $this->user()->id;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shop_name' => ['required', 'string', 'max:255'],
            'shop_theme' => ['nullable', 'string', 'max:255'],
            'biography' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'shop_name.required' => 'Le nom de la boutique est obligatoire.',
            'shop_name.string' => 'Le nom de la boutique doit être une chaîne de caractères.',
            'shop_name.max' => 'Le nom de la boutique ne doit pas dépasser 255 caractères.',
            'shop_theme.string' => 'Le thème de la boutique doit être une chaîne de caractères.',
            'shop_theme.max' => 'Le thème de la boutique ne doit pas dépasser 255 caractères.',
            'biography.string' => 'La biographie doit être une chaîne de caractères.',
            'biography.max' => 'La biographie ne doit pas dépasser 5000 caractères.',
        ];
    }
}
