<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Produto;
use App\Http\Requests\CriarProduto;

class MinhaController extends Controller
{
    public function getProduto($id) {

      $produto = Produto::findorfail($id);

      return response()->json([$produto]);

    }


    public function criarProduto(CriarProduto $request) {

      $novoProduto = new Produto;

      $novoProduto->nome = $request->nome;
      $novoProduto->tipo = $request->tipo;
      $novoProduto->preco = $request->preco;
      $novoProduto->quantidade = $request->quantidade;
      $validator = Validator::make($request->all(), [
            'nome' => 'required|alpha',
            'tipo' => 'alpha',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0'
        ]);
      if ($validator->fails()) {
          return response()->json($validator->errors());
      }

      $novoProduto->save();

    }

    public function atualizarProduto(Request $request, $id) {

      $produto = Produto::findorfail($id);

      if($request->nome){
        $produto->nome = $request->nome;
      }
      if($request->tipo){
        $produto->tipo = $request->tipo;
      }
      if($request->preco){
        $produto->preco = $request->preco;
      }
      if($request->quantidade){
        $produto->quantidade = $request->quantidade;
      }

      /*$validator = Validator::make($request->all(), [
            'nome' => 'required|alpha',
            'tipo' => 'alpha',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0'
        ]);
      if ($validator->fails()) {
          return response()->json($validator->errors());
      }*/

      $produto->save();
    }

    public function deletarProduto($id){

      Produto::destroy($id);

    }
}
