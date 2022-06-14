<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDebitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_debits', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('customer_id');
            $table -> unsignedBigInteger('order_id');
            $table -> string('cash_amt') -> nullable();
            $table -> string('debit_amt') -> nullable();
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
        Schema::dropIfExists('customer_debits');
    }
}
