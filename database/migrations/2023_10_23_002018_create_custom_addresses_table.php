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
        Schema::create('custom_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id'); // Add the request_id column
            $table->string('address');
            $table->timestamps();
    
            $table->foreign('request_id')->references('id')->on('request_records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_addresses');
    }
};
