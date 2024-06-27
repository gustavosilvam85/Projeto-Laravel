<?php

namespace App\Http\Controllers;

use App\Models\Explorador;
use App\Models\Itens;
use Illuminate\Http\Request;

class ItensController extends Controller
{
    public function show(string|int $id){ 
        $itens = Itens::findOrFail($id); //tenta achar o itens com o id do itens$itens
        return response()->json (['Itens' => $itens]);//Se achar retorna um json com os dados do itens$itens
    }
    
    public function create(Request $request,$id){
        $validatedData = $request->validate([
            'NomeItem' => 'required|string|max:255',
            'Valor' => 'required|numeric|min:0.0',
            'Latitude'=> 'required|string',
            'Longitude'=> 'required|string',
        ]);

        $exploradorExiste = Explorador::where('id',$id)->exists();

        if (!$exploradorExiste) {
            return response()->json(['error' => 'Explorador não encontrado'], 404);
        }

        $itens = Itens::create([
            'id_explorador'=>$id,
            'NomeItem' => $validatedData['NomeItem'],
            'Valor' => $validatedData['Valor'],
            'Latitude' => $validatedData['Latitude'],
            'Longitude' => $validatedData['Longitude'],
        ]);

        return response()->json(['Explorador' => $itens], 201);
    }

    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'NomeItem' => 'sometimes|string|max:255',
            'Valor' => 'sometimes|decimal|min:0',
            'Latitude'=> 'sometimes|decimal|min:0',
            'Longetude'=> 'sometimes|decimal|min:0',
        ]);

        $itens = Itens::findOrFail($id);

        $itens->update([
            'NomeItem' => $validatedData['NomeItem'],
            'Valor' => $validatedData['Valor'],
            'Latitude' => $validatedData['Latitude'],
            'Longetude' => $validatedData['Longetude'],
        ]);

        $itens->save();
        return response()->json(['Explorador' => $itens], 201);
    }

    public function delete(string|int $id){
        $itens = Itens::findOrFail($id);
        $itens->delete();
    }   

}
