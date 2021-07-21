<?php

namespace App\Http\Requests;

use App\Rules\ValidPrice;
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
            'price' => [ 'required', 'string', new ValidPrice() ],
            'quantity' => [ 'nullable', 'integer' ]
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
            'price.required' => 'Campo :attribute é obrigatório'
        ];

        $string = [
            'name.string' => 'Campo :attribute não é texto',
            'description.string' => 'Campo :attribute não é texto',
            'price.string' => 'Campo :attribute não é texto'
        ];

        $image = [
            'image.mimes' => 'Campo :attribute não é do tipo jpg,png,jpeg,gif ou svg'
        ];

        $integer = [
            'quantity.integer' => 'Campo :attribute não é numérico'
        ];

        return array_merge($required, $string, $image, $integer);
    }
}
