<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Empleado;

//Listar los empleados
Route::get('empleados', function () {
    $empleados = Empleado::get();
    return $empleados;
});
//Obtener datos de un empleado
Route::get('empleados/{id}', function ($id) {
    $empleado = Empleado::findOrFail($id);
    return $empleado;
});

//Ruta para crear empleados
Route::post('empleados', function (Request $request) {
    $request->validate([
        'nombres' => 'required|max:50',
        'apellido' => 'required|max:50',
        'cedula' => 'required|max:20',
        'email' => 'required|max:50|email|unique:empleados',
        'lugar_nacimiento' => 'required|max:50',
        'sexo' => 'required|max:50',
        'estado_civil' => 'required|max:50',
        'telefono' => 'required|numeric'
    ]);

    $empleado = new Empleado;
    $empleado->nombres = $request->input('nombres');
    $empleado->apellido = $request->input('apellido');
    $empleado->cedula = $request->input('cedula');
    $empleado->email = $request->input('email');
    $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
    $empleado->sexo = $request->input('sexo');
    $empleado->estado_civil = $request->input('estado_civil');
    $empleado->telefono = $request->input('telefono');
    $empleado->save();
    return "Empleado Creado";
});


//Ruta para actualizar un empleado
Route::put('empleados/{id}', function (Request $request, $id) {
    $request->validate([
        'nombres' => 'required|max:50',
        'apellido' => 'required|max:50',
        'cedula' => 'required|max:20',
        'email' => 'required|max:50|email|unique:empleados,email,' . $id,
        'lugar_nacimiento' => 'required|max:50',
        'sexo' => 'required|max:50',
        'estado_civil' => 'required|max:50',
        'telefono' => 'required|numeric'
    ]);
    $empleado = Empleado::findOrFail($id);
    $empleado->nombres = $request->input('nombres');
    $empleado->apellido = $request->input('apellido');
    $empleado->cedula = $request->input('cedula');
    $empleado->email = $request->input('email');
    $empleado->lugar_nacimiento = $request->input('lugar_nacimiento');
    $empleado->sexo = $request->input('sexo');
    $empleado->estado_civil = $request->input('estado_civil');
    $empleado->telefono = $request->input('telefono');
    $empleado->save();
    return "Empleado actualizado";
});

//Ruta para eliminar empleado
Route::delete('empleados/{id}', function ($id) {
    $empleado = Empleado::findOrFail($id);
    $empleado->delete();
    return "Empleado eliminado exitosamente";
});
