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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',40);
            $table->string('lastname',40);
            // $table->string('type_of_car',40);
            // $table->string('car_number',40);
            // $table->float('fair');
            $table->string('email',40)->nullable();
            $table->string('phone');
            $table->string('password',200);
            // $table->string('photo');
            // $table->string('address');
            // $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('drivers');
    }
};
