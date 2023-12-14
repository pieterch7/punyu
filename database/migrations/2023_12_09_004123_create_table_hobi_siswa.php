<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHobiSiswa extends Migration
{
    public function up()
    {
        Schema::create('hobi_siswa', function (Blueprint $table) {
            $table->integer('id_siswa')->unsigned()->index();
            $table->integer('id_hobi')->unsigned()->index();
            $table->timestamps();

            //set primary key
            $table->primary(['id_siswa','id_hobi']);

            //set fk hobi_siswa --- siswa
            $table->foreign('id_siswa')
                    ->references('id')
                    ->on('siswa')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }
    public function down()
    {
        Schema::drop('hobi_siswa');
    }
}
