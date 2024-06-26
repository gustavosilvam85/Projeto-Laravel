<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(Inventario $inventario){
        $inventario = $inventario->all();
        return responde()->json (['Inventario' => $inventario]);
    }

    public function show(string|int $id){ 
        $inventario = Inventario::findOrFail($id); //tenta achar o inventario com o id do explorador
        return responde()->json (['Inventario' => $inventario]);//Se achar retorna um json com os dados do explorador
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'Nome' => 'required|string|max:255',
            'Valor' => 'required|decimal|min:0',
            'Latitude'=> 'required|decimal|min:0',
            'Longetude'=> 'required|decimal|min:0',
        ]);

        $explorador = Explorador::create([
            'Nome' => $validatedData['Nome'],
            'Valor' => $validatedData['Valor'],
            'Latitude' => $validatedData['Latitude'],
            'Longetude' => $validatedData['Longetude'],
        ]);
    }

    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'Nome' => 'sometimes|string|max:255',
            'Valor' => 'sometimes|decimal|min:0',
            'Latitude'=> 'sometimes|decimal|min:0',
            'Longetude'=> 'sometimes|decimal|min:0',
        ]);

        $inventario = Inventario::findOrFail($id);

        $inventario->update([
            'Nome' => $validatedData['Nome'],
            'Valor' => $validatedData['Valor'],
            'Latitude' => $validatedData['Latitude'],
            'Longetude' => $validatedData['Longetude'],
        ]);

        $inventario->save();
    }

    public function delete(string|int $id){
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();
    }   

}