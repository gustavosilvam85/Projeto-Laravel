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

    public function tradeItens(Request $request){
        // Validação da requisição
        $data = $request->validate([
            'itens_explorador_origem' => 'required|array',
            'itens_explorador_destino' => 'required|array',
            'id_explorador_origem' => 'required|integer|exists:explorador,id',
            'id_explorador_destino' => 'required|integer|exists:explorador,id',
        ]);

        $itensOrigem = $data['itens_explorador_origem'];
        $itensDestino = $data['itens_explorador_destino'];

        $exploradorOrigem = Explorador::find($data['id_explorador_origem']);
        $exploradorDestino = Explorador::find($data['id_explorador_destino']);

        // Calcular o valor total dos itens
        $valorOrigem = Itens::whereIn('id', $itensOrigem)->sum('valor');
        $valorDestino = Itens::whereIn('id', $itensDestino)->sum('valor');

        // Verificar se os valores são equivalentes
        if ($valorOrigem !== $valorDestino) {
            return response()->json(['error' => 'Valores dos itens não são equivalentes'], 400);
        }

        // Realizar a troca
        Itens::whereIn('id', $itensOrigem)->update(['id_explorador' => $exploradorDestino->id]);
        Itens::whereIn('id', $itensDestino)->update(['id_explorador' => $exploradorOrigem->id]);

        return response()->json(['success' => 'Itens trocados com sucesso']);
        
    }
}