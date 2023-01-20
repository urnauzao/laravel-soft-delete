<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

# php artisan test --filter=ClientePopulateTest
class ClientePopulateTest extends TestCase
{
    # php artisan test --filter=ClientePopulateTest::test_main
    public function test_main()
    {
        $total_registros = 500;
        $clientes_antes = Cliente::count();
        Cliente::factory($total_registros)->create();
        $clientes_depois = Cliente::count();
        $this->assertEquals(
            $clientes_depois,
            $clientes_antes+$total_registros,
            "Não foi criado a quantidade de clientes esperada"
        );
    }
    
    # php artisan test --filter=ClientePopulateTest::test_delete_model
    public function test_delete_model(){
        $cliente = Cliente::query()->inRandomOrder()->first();
        $cliente_id = $cliente->id;
        $cliente->delete();
        $this->assertSoftDeleted('clientes', ['id' => $cliente_id]);
        $cliente = Cliente::withTrashed()->find($cliente_id);
        $this->assertTrue($cliente->trashed());
        dump("id do cliente deletado: ".$cliente_id);
    }

    # php artisan test --filter=ClientePopulateTest::test_restore_deleted_model
    public function test_restore_deleted_model(){
        $cliente_deleted = Cliente::withTrashed()
        ->where('deleted_at', '<>', null)
        ->first();
        $cliente_deleted->restore();
        $this->assertFalse( $cliente_deleted->trashed() );
    }

     # php artisan test --filter=ClientePopulateTest::test_remove_deleted_model
    public function test_remove_deleted_model(){
        $cliente_deleted = Cliente::onlyTrashed()
        ->first();
        $cliente_deleted->deleted_at = null;
        $cliente_deleted->idade += 100;
        $cliente_deleted->save();
        dump($cliente_deleted->id);
        $this->assertFalse( $cliente_deleted->trashed() );
    }

    # php artisan test --filter=ClientePopulateTest::test_force_deleted_model
    public function test_force_deleted_model(){
        $cliente_deleted = Cliente::onlyTrashed()
        ->first();
        $cliente_id = $cliente_deleted->id;
        dump($cliente_id );
        $cliente_deleted->forceDelete();
        $cliente_deleted = Cliente::onlyTrashed()->find($cliente_id );
        $this->assertNull( $cliente_deleted );
    }

    
}
