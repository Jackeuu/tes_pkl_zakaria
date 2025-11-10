<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdetail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi');
            $table->string('idb');
            $table->integer('qty');
            $table->integer('harga_jual');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdetail_transaksi');
    }
};
