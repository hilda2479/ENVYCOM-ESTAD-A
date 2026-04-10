<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipoRequest extends FormRequest
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
            //
            'tipo_equipo' => 'required|string|max:30',
            'marca'       => 'required|string|max:15',
            'modelo'      => 'required|string|max:10',
            'folio'       => 'nullable|string|max:20',
            'SKU'         => 'nullable|string|max:50',
            'cliente_id'  => 'required|exists:clientes,id',
            'proximo_mantenimiento' => 'nullable|date',
            'estatus'     => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'tipo_equipo.regex' => 'El tipo de equipo contiene caracteres no permitidos. Use solo letras, números y espacios.',
            'marca.regex' => 'La marca contiene caracteres no permitidos. Use solo letras, números y espacios.',
            'modelo.regex' => 'El modelo contiene caracteres no permitidos. Use solo letras, números y espacios.',
        ];
    }
}
