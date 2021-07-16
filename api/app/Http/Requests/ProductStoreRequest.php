<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'name' => [ 'required', 'string' ],
            'description' => [ 'required', 'string' ],
            'image' => [ 'required', 'image', 'mimes:jpg,png,jpeg,gif,svg' ],
            'price' => [ 'required', 'numeric', 'gt:0.0' ],
            'quantity' => [ 'required', 'integer', 'gt:-1' ]
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
        $required = [
            'name.required' => 'Campo :attribute é obrigatório',
            'description.required' => 'Campo :attribute é obrigatório',
            'image.required' => 'Campo :attribute é obrigatório',
            'price.required' => 'Campo :attribute é obrigatório',
            'quantity.required' => 'Campo :attribute é obrigatório'
        ];

        $string = [
            'name.string' => 'Campo :attribute não é texto',
            'description.string' => 'Campo :attribute não é texto',
            'image.string' => 'Campo :attribute não é texto'
        ];

        $numeric = [
            'price.numeric' => 'Campo :attribute é numérico'
        ];

        $integer = [
            'quantity.integer' => 'Campo :attribute é numérico'
        ];

        $greaterThan = [
            'quantity.gt' => 'Campo :attribute deve ser maior que :gt',
            'price.gt' => 'Campo :attribute deve ser maior que :gt'
        ];

        return array_merge($required, $string, $numeric, $integer, $greaterThan);
    }
}
