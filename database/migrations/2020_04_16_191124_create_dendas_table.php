<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksis_id');
            $table->foreign('transaksis_id')->references('id')->on('transaksis')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('hari_telat');
            $table->string('denda');
            $table->date('date_paid');
            $table->integer('status')
                ->length(1)
                ->default(1)
                ->nullable()
                ->comment('0=non-active;1=active;');
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
        Schema::dropIfExists('dendas');
    }
}
