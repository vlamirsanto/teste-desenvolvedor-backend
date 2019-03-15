@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                @component('components.card')    
                    <div class="row align-items-center">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <h3 class="mb-0">{{ isset($client) ? 'Cadastrar' : 'Atualizar' }} Cliente</h3>
                        </div>

                        <div class="col-sm-6 text-sm-right">
                            <a class="btn btn-primary" href="{{ route('clients.index') }}">Listar Clientes</a>
                        </div>
                    </div>
                @endcomponent      
            </div>

            <div class="col-12">
                @component('components.card')    
                    <form action="{{ ! isset($client) ? route('clients.index') : route('clients.update', $client) }}" method="post">
                        @csrf

                        @isset($client)
                            @method('PUT')
                        @endisset

                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.form.input', [
                                        'id' => 'name',
                                        'name' => 'name',
                                        'label' => 'Nome',
                                        'placeholder' => 'Digite o nome',
                                        'value' => $client->user->name ?? ''
                                    ])
                                    @endcomponent
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.form.input', [
                                        'id' => 'cpf',
                                        'name' => 'cpf',
                                        'label' => 'CPF',
                                        'placeholder' => 'Digite o CPF',
                                        'value' => $client->user->cpf ?? ''
                                    ])
                                    @endcomponent
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    @component('components.form.input', [
                                        'id' => 'email',
                                        'name' => 'email',
                                        'type' => 'email',
                                        'label' => 'E-mail',
                                        'placeholder' => 'Digite o e-mail',
                                        'value' => $client->user->email ?? ''
                                    ])
                                    @endcomponent
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.form.input', [
                                        'id' => 'password',
                                        'name' => 'password',
                                        'type' => 'password',
                                        'label' => 'Senha',
                                        'placeholder' => 'Digite a senha',
                                    ])
                                    @endcomponent
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.form.input', [
                                        'id' => 'password_confirmation',
                                        'name' => 'password_confirmation',
                                        'type' => 'password',
                                        'label' => 'Confirmar Senha',
                                        'placeholder' => 'Digite novamente a senha',
                                    ])
                                    @endcomponent
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group text-right">
                                    @component('components.form.submit')
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    </form>
                @endcomponent      
            </div>
        </div>
    </div>
@endsection