<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExploradorController extends Controller
{
    public function index(Explorador $explorador){
        $explorador = $explorador->all();
        return responde()->json (['Explorador' => $explorador]);
    }

    public function show(string|int $id){ 
        $explorador = Explorador::findOrFail($id); //tenta achar o explorador com o id do explorador
        return responde()->json (['Explorador' => $explorador]);//Se achar retorna um json com os dados do explorador
    }
    
    public function create(Request $request){
        $validatedData = $request->validate([
            'Nome' => 'required|string|max:255',
            'Idade' => 'required|Integer|min:0',
            'Latitude'=> 'required|decimal|min:0',
            'Longetude'=> 'required|decimal|min:0',
        ]);

        $explorador = Explorador::create([
            'Nome' => $validatedData['Nome'],
            'Idade' => $validatedData['Idade'],
            'Latitude' => $validatedData['Latitude'],
            'Longetude' => $validatedData['Longetude'],
        ]);
    }

    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'Nome' => 'sometimes|string|max:255',
            'Idade' => 'sometimes|Integer|min:0',
            'Latitude'=> 'sometimes|decimal|min:0',
            'Longetude'=> 'sometimes|decimal|min:0',
        ]);

        $explorador = Explorador::findOrFail($id);

        $explorador->update([
            'Nome' => $validatedData['Nome'],
            'Idade' => $validatedData['Idade'],
            'Latitude' => $validatedData['Latitude'],
            'Longetude' => $validatedData['Longetude'],
        ]);

        $explorador->save();
    }

    public function delete(string|int $id){
        $explorador = Explorador::findOrFail($id);
        $explorador->delete();
    }
}
