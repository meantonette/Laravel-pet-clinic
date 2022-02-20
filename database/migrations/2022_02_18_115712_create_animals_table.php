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
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('animals_id');
            $table->string(column: 'animal_name');
            $table->integer(column: 'age');
            $table->string(column: 'gender');
            $table->string(column: 'type');
            $table->string(column: 'images');
            $table->unsignedInteger(column: 'rescuer_id');
            $table->timestamps();
            $table->foreign('rescuer_id')->references('rescuer_id')->on('rescuers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
};
