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
            'nombre_equipo' => 'required|string|max:50',
            'marca' => 'required|string|max:30',
            'modelo' => 'required|string|max:30',
            'numero_serie' => 'required|string|max:50|unique:equipos,numero_serie',
            'cliente_id' => 'required|exists:clientes,id',
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nombre_equipo.required' => 'El nombre del equipo es obligatorio.',
            'nombre_equipo.string' => 'El nombre del equipo debe ser una cadena de texto.',
            'nombre_equipo.max' => 'El nombre del equipo no puede exceder los 50 caracteres.',
            'marca.required' => 'La marca es obligatoria.',
            'marca.string' => 'La marca debe ser una cadena de texto.',
            'marca.max' => 'La marca no puede exceder los 30 caracteres.',
            'modelo.required' => 'El modelo es obligatorio.',
            'modelo.string' => 'El modelo debe ser una cadena de texto.',
            'modelo.max' => 'El modelo no puede exceder los 30 caracteres.',
            'numero_serie.required' => 'El número de serie es obligatorio.',
            'numero_serie.string' => 'El número de serie debe ser una cadena de texto.',
            'numero_serie.max' => 'El número de serie no puede exceder los 50 caracteres.',
            'numero_serie.unique' => 'El número de serie ya existe en la base de datos.',
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.exists' => 'El cliente seleccionado no existe en la base de datos.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres.',
        ];
    }
}
