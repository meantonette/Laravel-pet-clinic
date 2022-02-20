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
        Schema::create('adopters', function (Blueprint $table) {
            $table->increments('adopter_id');
            $table->string(column: 'first_name');
            $table->string(column: 'last_name');
            $table->string(column: 'phone_number');
            $table->string(column: 'images');
            $table->unsignedInteger(column: 'animals_id');
            $table->timestamps();
            $table->foreign('animals_id')->references('animals_id')->on('animals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adopters');
    }
};
