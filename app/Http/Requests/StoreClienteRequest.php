<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'nombre' => [
                'required', 
                'string', 
                'max:100', 
                'regex:/^[a-zA-Z\sñÑáéíóúÁÉÍÓÚ]+$/u'
            ],
            'email' => 'nullable|email|unique:clientes,email',
            'telefono' => 'nullable|digits:10',
        ];
    }

    public function messages()
    {
        return [
            
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
        ];
    }
}
