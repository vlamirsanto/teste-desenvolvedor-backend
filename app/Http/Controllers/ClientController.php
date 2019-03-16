<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Auth::user()
            ->clients()
            ->orderBy('name')
            ->get();
        
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateRequest $request, Client $client)
    {
        $authUser = Auth::user();

        DB::transaction(function () use ($request, $client, $authUser) {
            $client->user()
                ->associate($authUser)
                ->fill($request->all())
                ->save();
        });

        return redirect()
            ->route('clients.create')
            ->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.manage', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClientUpdateRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        DB::transaction(function () use ($request, $client) {
            $client->update($request->all());
        });

        return redirect()
            ->route('clients.edit', $client->id)
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        DB::transaction(function () use ($client) {
            $client->delete();
        });

        return redirect()
            ->route('clients.index')
            ->with('success', 'Cliente removido com sucesso!');
    }
}