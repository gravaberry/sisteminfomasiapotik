<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_obats', function (Blueprint $table) {
            $table->id();
            $table->string('masuk');
            $table->string('keluar');
            $table->string('jual');
            $table->string('beli');
            $table->string('expired');
            $table->string('stok');
            $table->string('keterangan');
            $table->unsignedBigInteger('idObat');
            $table->foreign('idObat')->references('id')->on('obats')->onDelete('cascade');
            $table->unsignedBigInteger('admins');
            $table->foreign('admins')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('stok_obats');
    }
}
