<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Pedido;

class ProdutoController extends Controller
{
    public function getAll()
    {
        $builder = Produto::query();

        if (request('sortBy') !== null) 
        {
            $direction = request('descending') === 'false' ? 'asc' : 'desc';
            $builder = $builder->orderBy(request('sortBy'), $direction);
        }

        $data = null;
        $total = 0;
        $qtdPages = intval(request('rowsPerPage'));

        if ($qtdPages > 0)
        {
            $paginator = $builder->paginate($qtdPages);
            $data = $paginator->getCollection();
            $total = $paginator->total();
        }
        else
        {
            $data = $builder->get();
            $total = $data->count();
        }

        return response()->json([
            'status' => 'ok',
            'result' => [
                'data' => $data,
                'total' => $total
                ]
        ]);
    }

    public function get(Produto $produto)
    {
        return response()->json([
            'status' => 'ok',
            'result' => $produto
        ]);        
    }

    public function delete(Produto $produto)
    {
        $qtdPedidos = Pedido::where('ProdutoId', $produto->id)->get()->count();
        if ($qtdPedidos > 0)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'O produto ' . $produto->Nome . ' não pode ser deletado, pois está presente em algum pedido!',
                'result' => $produto
            ]);
        }

        $produto->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'O produto ' . $produto->Nome . ' foi deletado com sucesso!',
            'result' => $produto
        ]);
    }

    public function update(Produto $produto)
    {
        $validator = validator(request()->all(),
            [
                'CodBarras' => 'nao_vazio',
                'ValorUnitario' => 'nao_vazio|numeric'
            ],
            [
                'CodBarras.nao_vazio' => 'O Código de Barras do produto não pode ser deixado em braco',
                'ValorUnitario.nao_vazio' => 'O Valor do produto não pode ser deixado em branco',
                'numeric' => 'O Valor do produto deve ser um número'
            ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'result' => $validator->errors()
            ]);
        }

        $produto->update(request()->all());
        return response()->json([
            'status' => 'ok',
            'message' => 'O produto ' . $produto->Nome . ' foi editado com sucesso!',
            'result' => $produto
        ]);
    }

    public function createNew()
    {
        $validator = validator(request()->all(),
            [
                'CodBarras' => 'required',
                'ValorUnitario' => 'required|numeric'
            ],
            [
                'CodBarras.required' => 'O Código de Barras do produto é obrigatório',
                'ValorUnitario.required' => 'O Valor do produto é obrigatório',
                'numeric' => 'O Valor do produto deve ser um número'
            ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'result' => $validator->errors()
            ]);
        }

        $newProduto = Produto::create(request()->all());

        return response()->json([
            'status' => 'ok',
            'message' => 'O produto ' . $newProduto->Nome . ' foi criado com sucesso!',
            'result' => $newProduto
        ]);
    }

    public function deleteMultiple() 
    {
        $response = [];

        foreach (request('ids') as $id)
        {
            $produto = Produto::find(intval($id));

            if ($produto)
            {
                $qtdPedidos = Pedido::where('ProdutoId', $produto->id)->get()->count();
                if ($qtdPedidos > 0)
                {
                    $response[$id] = 'O produto ' . $produto->Nome . ' não pode ser deletado, pois está presente em algum pedido!';
                }
                else
                {
                    $produto->delete();
                    $response[$id] = 'O produto ' . $produto->Nome . ' foi deletado com sucesso!';
                }
            }
            else
            {
                $response[$id] = "Não existe um produto com id " . $id . ".";
            }
        }
        return response()->json([
            'status' => 'ok',
            'result' => $response
        ]);
    }
}
