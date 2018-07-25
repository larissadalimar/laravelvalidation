<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data');
            $table->float('valor');
            $table->integer('idCliente')->unsigned()->nullable();
            $table->integer('idProduto')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('compras', function (Blueprint $table) {
          $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('set null');
          $table->foreign('idProduto')->references('id')->on('produtos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
