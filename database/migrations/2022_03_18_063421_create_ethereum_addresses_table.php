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
        Schema::create('ethereum_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('tagName')->nullable();
            $table->string('balance')->nullable();
            $table->string('percent')->nullable();
            $table->integer('txCount')->nullable();
            $table->integer('rank')->nullable();
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
        Schema::dropIfExists('ethereum_addresses');
    }
};
