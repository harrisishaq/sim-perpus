<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku')->unique();
            $table->string('nama_buku', 75);
            $table->unsignedBigInteger('penerbits_id');
            $table->foreign('penerbits_id')->references('id')->on('penerbits')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('stok_tersedia', 3);
            $table->string('stok_terpinjam', 3);
            $table->integer('status')
                ->length(1)
                ->default(1)
                ->nullable()
                ->comment('0=Tidak Tersedia;1=Tersedia');
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
        Schema::dropIfExists('bukus');
    }
}
