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
        Schema::create('stars', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('starrable_type');//Может относиться к артиклям и плагинам
            $table->string('starrable_id');//Идентификатор артикля или статьи
            $table->timestamps();

            $table->index(['starrable_type', 'starrable_id']); //Индекс по типу и идентификатору
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stars');
    }
};
