<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHobi extends Migration
{
    public function up()
    {
        Schema::create('hobi', function (Blueprint $table) {
            $table->increments('id');
            $table->string ('nama_hobi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('hobi');
    }
}
