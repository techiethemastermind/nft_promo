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
        Schema::create('ethereum_wallets', function (Blueprint $table) {
            $table->id();
            $table->string('address', 100);
            $table->integer('transactionsCount');
            $table->string('confirmed_balance_amount', 100);
            $table->string('confirmed_balance_unit');
            $table->string('received_amount', 100);
            $table->string('received_unit');
            $table->string('spent_amount', 100);
            $table->string('spent_unit');
            $table->integer('incomeTransactions');
            $table->integer('outgoingTransactions');
            $table->integer('rank');
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
        Schema::dropIfExists('ethereum_wallets');
    }
};
