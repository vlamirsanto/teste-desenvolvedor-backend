<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use Tests\TestCase;

class IndexTest extends TestCase
{
    protected $user;
    protected $client;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = factory(User::class)->create();
    }

    /**
     * Teste básico que simula quando o usuário visita a página home.
     *
     * @return void
     */
    public function testHome()
    {
        $this->actingAs($this->user)
            ->get(route('dashboard.index.home'));

        $this->assertAuthenticated();
    }
}
