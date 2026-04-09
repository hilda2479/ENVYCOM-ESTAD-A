<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
            'nombre_cliente' => 'required|string|max:100',
            'telefono' => 'required|string|max:10',
            'correo' => 'required|email|unique:clientes,correo,' . $this->route('cliente')->id,
            'sector' => 'required|in:Educación,Gobierno,Particular'
        ];
    }

    public function messages()
    {
        return [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'telefono.digits' => 'El teléfono debe tener 10 dígitos.',
            'correo.unique' => 'Este correo ya pertenece a otro cliente.'
        ];
    }
}
