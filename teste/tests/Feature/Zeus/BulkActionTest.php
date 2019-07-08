<?php

namespace Tests\Feature\Zeus;

use App\Models\Client;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BulkActionTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $client;
    protected $product;
    protected $purchase;
    protected $data;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = factory(User::class)->create();
        $this->client = factory(Client::class)->create();
        $this->product = factory(Product::class)->create();
        $this->purchase = factory(Purchase::class)->create();
    }

    /**
     * Um teste básico de exclusão em massa de clientes
     *
     * @return void
     */
    public function testDestroyClient()
    {
        $this->data = [
            'ids' => [$this->client->id],
            'model' => 'Client'
        ];

        $this->post(
            route('bulk_action.destroy'),
            $this->data,
            ['Authorization' => 'Zeus '.$this->user->api_token]
        )->assertStatus(204);
    }

    /**
     * Um teste básico de exclusão em massa de produtos
     *
     * @return void
     */
    public function testDestroyProduct()
    {
        $this->data = [
            'ids' => [$this->product->id],
            'model' => 'Product'
        ];

        $this->post(
            route('bulk_action.destroy'),
            $this->data,
            ['Authorization' => 'Zeus '.$this->user->api_token]
        )->assertStatus(204);
    }

    /**
     * Um teste básico de exclusão em massa de pedidos de compra
     *
     * @return void
     */
    public function testDestroyPurchase()
    {
        $this->data = [
            'ids' => [$this->purchase->id],
            'model' => 'Purchase'
        ];

        $this->post(
            route('bulk_action.destroy'),
            $this->data,
            ['Authorization' => 'Zeus '.$this->user->api_token]
        )->assertStatus(204);
    }
}
