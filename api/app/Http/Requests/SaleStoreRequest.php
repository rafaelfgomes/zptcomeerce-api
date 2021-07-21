<?php

namespace App\Http\Requests;

use App\Rules\ValidPrice;
use Illuminate\Foundation\Http\FormRequest;

class SaleStoreRequest extends FormRequest
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
            'quantity' => [ 'required', 'integer' ],
            'amount' => [ 'required', 'string', new ValidPrice() ],
            'product_id' => [ 'required', 'integer' ]
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'quantity' => 'quantidade da venda',
            'amount' => 'valor da venda',
            'product_id' => 'produto'
        ];
    }

    public function messages()
    {
        $required = [
            'quantity.required' => 'Campo :attribute é obrigatório',
            'amount.required' => 'Campo :attribute é obrigatório',
            'product_id.required' => 'Campo :attribute é obrigatório',
        ];

        $string = [
            'amount.string' => 'Campo :attribute não é texto'
        ];

        $integer = [
            'quantity.integer' => 'Campo :attribute não é numérico',
            'product_id.integer' => 'Campo :attribute não é numérico'
        ];

        return array_merge($required, $string, $integer);
    }
}
