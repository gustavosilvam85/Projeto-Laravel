<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explorador;

class ExploradorController extends Controller
{
    public function index(Explorador $explorador){
        $explorador = $explorador->all();
        return response()->json (['Explorador' => $explorador]);
    }

    public function showInventario(string|int $id){ 
        $explorador = Explorador::with('Inventario')->findOrFail($id); //tenta achar o explorador com o id do explorador
        return response()->json (['Explorador' => $explorador,]);//Se achar retorna um json com os dados do explorador
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'Nome' => 'required|string|max:255',
            'Idade' => 'required|integer|min:0',
            'Latitude' => 'required|string',
            'Longitude' => 'required|string',
        ]);
    
        $explorador = Explorador::create([
            'Nome' => $validatedData['Nome'],
            'Idade' => $validatedData['Idade'],
            'Latitude' => $validatedData['Latitude'],
            'Longitude' => $validatedData['Longitude'],
        ]);
        return response()->json(['Explorador' => $explorador], 201);
    }
    

    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'Latitude'=> 'sometimes|string',
            'Longitude'=> 'sometimes|string',
        ]);

        $explorador = Explorador::findOrFail($id);

        $explorador->update([
            'Latitude' => $validatedData['Latitude'],
            'Longitude' => $validatedData['Longitude'], 
        ]);
        $explorador->save();

        return response()->json(['Explorador' => $explorador], 201);
    }

    public function delete(string|int $id){
        $explorador = Explorador::findOrFail($id);
        $explorador->delete();
        return response()->json("Deletado com sucesso");
    }
}
