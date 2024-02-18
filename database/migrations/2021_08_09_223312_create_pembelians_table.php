<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('faktur',30);
            $table->decimal('harga',9,2);
            $table->string('item',30);
            $table->integer('qty');
            $table->decimal('totalkotor',9,2);
            $table->decimal('diskonBeli',9,2);
            $table->decimal('totalbersih',9,2);
            $table->date('tanggal');
            $table->text('keterangan',150);
            $table->decimal('pajakBeli',9,2);
            $table->unsignedBigInteger('admin');
            $table->foreign('admin')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('supplier');
            $table->foreign('supplier')->references('id')->on('supliers')->onDelete('cascade');
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
        Schema::dropIfExists('pembelians');
    }
}
