<?php

namespace Tests\Feature\Dashboard;

use App\Models\Client;
use App\Models\User;
use Tests\TestCase;

class ClientTest extends TestCase
{
    protected $user;
    protected $client;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = factory(User::class)->create();
        $this->client = factory(Client::class)->create();
    }

    /**
     * Teste básico que simula quando o usuário visita a página de listagem de clientes.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard.clients.index'));

        $this->assertAuthenticated();
    }

    /**
     * Teste básico que simula quando o usuário visita o formulário de cadastro/edição de clientes.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard.clients.create'));

        $this->assertAuthenticated();
    }

    /**
     * Teste básico que simula quando o usuário visita o formulário de cadastro/edição de um determinado cliente.
     *
     * @return void
     */
    public function testEdit()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard.clients.edit', $this->client->id));

        $this->assertAuthenticated();
    }

    /**
     * Teste básico que simula quando o usuário visita a tela de visualização de um determinado cliente.
     *
     * @return void
     */
    public function testShow()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard.clients.show', $this->client->id));

        $this->assertAuthenticated();
    }
}
