<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTelepon extends Migration
{

    public function up()
    {
        Schema::create('telepon', function (Blueprint $table) {
            $table->integer('id_siswa')->unsigned()->primary('id_siswa');
            $table->string('nomor_telepon')->unique;
            $table->timestamps();

                $table->foreign('id_siswa')
                ->references('id')->on('siswa')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::drop('telepon');
    }
}