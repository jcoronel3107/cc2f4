<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('numero_pedido')->unique();
            $table->decimal('total', 10, 2);
            $table->string('estado')->default('pendiente'); // pendiente, pagado, enviado, entregado, cancelado
            $table->string('metodo_pago')->nullable();
            $table->text('direccion_envio');
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};