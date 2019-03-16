@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 pb-4 pb-md-0">
            @component('components.card')
                @slot('header')
                    Clientes
                @endslot

                <div class="text-center py-3 m-0">
                    <strong class="h1 font-weight-bold">{{ $clients }}</strong>
                    <p class='mb-0 mt-3 h5'>Clientes</p>
                </div>
            @endcomponent
        </div>
        <div class="col-md-4 pb-4 pb-md-0">
            @component('components.card')
                @slot('header')
                    Produtos
                @endslot

                <div class="text-center py-3 m-0">
                    <strong class="h1 font-weight-bold">10</strong>
                    <p class='mb-0 mt-3 h5'>Produtos</p>
                </div>
            @endcomponent
        </div>
        <div class="col-md-4 pb-4 pb-md-0">
            @component('components.card')
                @slot('header')
                    Pedidos
                @endslot

                <div class="text-center py-3 m-0">
                    <strong class="h1 font-weight-bold">10</strong>
                    <p class='mb-0 mt-3 h5'>Pedidos</p>
                </div>
            @endcomponent
        </div>
    </div>
</div>
@endsection