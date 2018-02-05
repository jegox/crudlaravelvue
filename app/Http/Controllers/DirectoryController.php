<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Directory;

class DirectoryController extends Controller
{
    /**
     * metodo que ejecuta devuelve todos los contactos
     * 
     */
    public function index()
    {
        $dir = Directory::all();
        return response()->json(['dir' => $dir ]); //devuelvo un objeto json con los resultados obtenidos de la bd
    }

    /**
     * metodo para almacenar los datos que vienen del formulario
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string'
        ]);

        $dir = new Directory();

        $dir->fullname = $request->input('fullname');
        $dir->phone = $request->input('phone');
        $dir->email = $request->input('email');
        $dir->address = $request->input('address');
        $dir->save();

        return response()->json(['res' => 'Contacto creado correctamente']); //devuelvo un resultado de exito
    }

    /**
     * metodo para actulizar un registro en la bd
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fullname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string'
        ]);

        $dir = Directory::find($id);

        $dir->fullname = $request->input('fullname');
        $dir->phone = $request->input('phone');
        $dir->email = $request->input('email');
        $dir->address = $request->input('address');
        $dir->save();

        return response()->json(['res' => 'Contacto actualizado correctamente']); //devuelvo un resultado de exito
    }

    /**
     * Metodo que "elimina" un registro de la bd
     */
    public function destroy($id)
    {
        $dir = Directory::find($id);
        $dir->delete();
        return response()->json(['res' => 'Contacto eliminado']); //devuelvo un resultado de exito
    }
}
