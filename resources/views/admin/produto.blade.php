@extends('layouts.dashboard')
@section('content')
<!-- component -->
<div class="antialiased sans-serif bg-gray-200 h-full dark:border-primary-darker dark:bg-darker h-full">

<style>
[x-cloak] {
    display: none;
}
</style>
<div class="container mx-auto py-6 px-4"  x-cloak>
<h1 class="text-3xl py-1 border-b mb-10 dark:text-light">Lista de Produtos</h1>
<a href="{{route('produtos.create')}}" class="bg-blue-500 hover:bg-blue-400 mr-3 text-white font-bold py-2 px-4 my-3 border-b-4 border-blue-700 hover:border-blue-500 rounded">
  Criar Novo
</a>
<div class="mt-3">
<livewire:actions-demo-table hideable="select" sort="id,nome_produto|asc" exportable/>
</div>


<livewire:restore-all model="App\Models\Produto" />
</div>
</div>
@endsection