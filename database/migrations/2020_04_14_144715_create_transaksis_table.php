<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswas_id');
            $table->foreign('mahasiswas_id')->references('id')->on('mahasiswas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->unsignedBigInteger('bukus_id');
            $table->foreign('bukus_id')->references('id')->on('bukus')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->date('date_from');
            $table->date('date_until')->nullable();
            $table->integer('status')
                ->length(1)
                ->default(1)
                ->nullable()
                ->comment('0=belum kembali;1=sudah kembali;');
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
        Schema::dropIfExists('transaksis');
    }
}
