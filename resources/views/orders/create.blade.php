@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="card-title">Criar Pedido</h5>
                    <hr>
                    <form id="products" action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="" class="mb-0 font-weight-bold">Comprador</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-user }}"></i>
                                        </div>
                                    </span>
                                    <select name="user_id" class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" required>
                                        @if (old('user_id') == null)
                                            <option value="" hidden selected>Selecione</option>
                                        @endif

                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ (old('user_id') == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('user_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="mb-0 font-weight-bold">Status</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-bookmark }}"></i>
                                        </div>
                                    </span>
                                    <select name="status" class="form-control" required>
                                        <option value="open" {{ (old('status') == 'open') ? 'selected' : '' }}>Em aberto</option>
                                        <option value="paid" {{ (old('status') == 'paid') ? 'selected' : '' }}>Pago</option>
                                        <option value="canceled" {{ (old('status') == 'canceled') ? 'selected' : '' }}>Cancelado</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="mb-0 font-weight-bold">Desconto</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-prepend">
                                        <div class="input-group-text bg-transparent">
                                            <i class="fas fa-dollar-sign }}"></i>
                                        </div>
                                    </span>
                                    <input type="number" name="discount" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" placeholder="Desconto" step="0.01" value="{{ old('discount') }}" min="0" required>
                                    @if ($errors->has('discount'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('discount') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="table-responsive mb-2">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">Produto</th>
                                                <th scope="col" class="text-center">Quantidade</th>
                                                <th scope="col" class="text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="row-body">
                                            @php
                                                $all  = old('product', []);
                                                $last = count($all);

                                                if ($last == 0) {
                                                    $last = 1;
                                                }
                                            @endphp
                                            @forelse ($all as $row => $current)
                                                <tr id="row-{{ $row }}">
                                                    <td>
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-prepend">
                                                                <div class="input-group-text bg-white">
                                                                    <i class="fas fa-tag }}"></i>
                                                                </div>
                                                            </span>
                                                            <select name="product[{{ $row }}][id]" class="form-control {{ $errors->has('product.' . $row . '.id') ? 'is-invalid' : '' }}">
                                                                @if ($current['id'] === null)
                                                                    <option value="" hidden selected>Selecione</option>
                                                                @endif

                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}" {{ ($product->id == $current['id']) ? 'selected' : '' }}>{{ $product->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('product.' . $row . '.id'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('product.' . $row . '.id') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-prepend">
                                                                <div class="input-group-text bg-white">
                                                                    <i class="fas fa-sort }}"></i>
                                                                </div>
                                                            </span>
                                                            <input type="number" name="product[{{ $row }}][amount]" value="{{ $current['amount'] }}" class="form-control {{ $errors->has('product.' . $row . '.amount') ? 'is-invalid' : '' }}" min="1" />
                                                            @if ($errors->has('product.' . $row . '.amount'))
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('product.' . $row . '.amount') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="add" class="btn btn-primary btn-sm action">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                        <a href="del" class="btn btn-danger btn-sm action" data-target="{{ $row }}">
                                                            <i class="fas fa-minus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr id="row-0">
                                                    <td class="text-center">
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-prepend">
                                                                <div class="input-group-text bg-white">
                                                                    <i class="fas fa-tag }}"></i>
                                                                </div>
                                                            </span>
                                                            <select name="product[0][id]" class="form-control">
                                                                <option value="" hidden selected>Selecione</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-prepend">
                                                                <div class="input-group-text bg-white">
                                                                    <i class="fas fa-sort }}"></i>
                                                                </div>
                                                            </span>
                                                            <input type="number" name="product[0][amount]" value="1" class="form-control" min="1" />
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="add" class="btn btn-primary btn-sm action">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                        <a href="del" class="btn btn-danger btn-sm action" data-target="0">
                                                            <i class="fas fa-minus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-xl-2 offset-sm-3 offset-md-4 offset-xl-5 text-center mt-2">
                                <button type="submit" class="btn btn-primary btn-block">Criar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('row')
    <tr>
        <td class="text-center">
            <div class="input-group mb-2">
                <span class="input-group-prepend">
                    <div class="input-group-text bg-white">
                        <i class="fas fa-tag }}"></i>
                    </div>
                </span>
                <select name="" class="form-control">
                    <option value="" hidden selected>Selecione</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
        </td>
        <td class="text-center">
            <div class="input-group mb-2">
                <span class="input-group-prepend">
                    <div class="input-group-text bg-white">
                        <i class="fas fa-sort }}"></i>
                    </div>
                </span>
                <input type="number" name="" value="1" class="form-control" min="1" />
            </div>
        </td>
        <td class="text-center">
            <a href="add" class="btn btn-primary btn-sm action">
                <i class="fas fa-plus"></i>
            </a>
            <a href="del" class="btn btn-danger btn-sm action">
                <i class="fas fa-minus"></i>
            </a>
        </td>
    </tr>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var last = {{ $last }};
            var row  = $($.parseHTML(`@yield('row')`));

            $('#products').on('click', '.action', function(e) {
                e.preventDefault();

                var action = $(this).attr('href');

                if (action == 'del') {
                    var target = $(this).data('target');
                    $('#row-' + target).remove();

                    if ($('#row-body').children().length == 0) {
                        last = 0;

                        var newRow = row.clone()
                                        .attr('id', 'row-' + last);

                        newRow.find('a[href="del"]')
                              .attr('data-target', last);

                        newRow.find('select')
                              .attr('name', 'product['+ last +'][id]');

                        newRow.find('input')
                              .attr('name', 'product['+ last +'][amount]');

                        $('#row-body').append(newRow);

                        last++;
                    }
                } else {
                    var newRow = row.clone()
                                    .attr('id', 'row-' + last);

                    newRow.find('a[href="del"]')
                          .attr('data-target', last);

                    newRow.find('select')
                          .attr('name', 'product['+ last +'][id]');

                    newRow.find('input')
                          .attr('name', 'product['+ last +'][amount]');

                    $('#row-body').append(newRow);

                    last++;
                }
            });
        });
    </script>
@endpush