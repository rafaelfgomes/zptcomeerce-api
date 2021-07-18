<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $rules = [
            'name' => [ 'nullable', 'string' ],
            'description' => [ 'nullable', 'string' ],
            'image' => [ 'nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg' ],
            'price' => [ 'nullable', 'string' ],
            'quantity' => [ 'nullable', 'integer', 'gt:-1' ],
            'active' => [ 'nullable' ]
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'nome do produto',
            'description' => 'descrição do produto',
            'image' => 'imagem do produto',
            'price' => 'preço do produto',
            'quantity' => 'quantidade do produto'
        ];
    }

    public function messages()
    {
        $string = [
            'name.string' => 'Campo :attribute não é texto',
            'description.string' => 'Campo :attribute não é texto',
            'price.string' => 'Campo :attribute não é texto',
            'image.string' => 'Campo :attribute não é texto'
        ];

        $integer = [
            'quantity.integer' => 'Campo :attribute é numérico'
        ];

        $greaterThan = [
            'quantity.gt' => 'Campo :attribute deve ser maior que :gt',
            'price.gt' => 'Campo :attribute deve ser maior que 0'
        ];

        return array_merge($string, $integer, $greaterThan);
    }
}
