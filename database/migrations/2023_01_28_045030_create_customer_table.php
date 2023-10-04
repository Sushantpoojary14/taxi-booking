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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',40);
            $table->string('phone',40);
            $table->string('location',40)->nullable();
            $table->string('coordinate',40)->nullable();
            $table->string('distance',40)->nullable();
            $table->string('time_taken',40)->nullable();
            $table->longText('url')->nullable();
            $table->integer('relation_id');
            $table->integer('days');
            $table->string('customer_token',100)->nullable();
            $table->string('invoice_id',100)->nullable();
            $table->string('amount',40)->nullable();
            $table->string('total_amount',40)->nullable();
            $table->string('night_charges',40)->default('0');
            $table->string('payment_mode',40);
            $table->string('razorpay_payment_id',200)->nullable();
            $table->string('booking_time');
            $table->string('booking_date');
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
        Schema::dropIfExists('customer');
    }
};
