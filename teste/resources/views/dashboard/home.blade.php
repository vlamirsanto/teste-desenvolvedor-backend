@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                @session
                @endsession
            </div>
        </div>

        @filter(['pages' => $pages])
        @endfilter

        <div class="row">
            <div class="col-12">
                <table class="table bg-dotlib table-responsive-sm mt-2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($clients as $client)
                        <tr>
                            <th scope="row">{{ $client->id }}</th>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row">*</th>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <p class="font-weight-bold">Total: <span class="text-light">{{ $pages->total }}</span></p>
            </div>
            <div class="col-md-10">
                @paginate(['pages' => $pages, 'params' => $params])
                @endpaginate
            </div>
        </div>
    </div>
@endsection
