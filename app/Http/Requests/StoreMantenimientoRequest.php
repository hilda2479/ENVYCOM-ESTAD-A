<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMantenimientoRequest extends FormRequest
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
            'fecha_servicio' => 'required|date',
            'descripcion_servicio' => 'nullable|string|max:255',
            'costo' => 'nullable|numeric|min:0',
            'insumos_utilizados' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'descripcion_servicio.regex' => 'La descripción contiene caracteres no permitidos. Use solo letras, números y puntuación básica.',
            'costo.numeric' => 'El costo debe ser un número.',
            'equipo_id.exists' => 'El equipo seleccionado no es válido.',
        ];
    }
}
