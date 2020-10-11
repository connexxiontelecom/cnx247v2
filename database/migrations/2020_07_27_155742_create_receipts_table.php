<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('issued_by')->nullable();
            $table->integer('receipt_no');
            $table->tinyInteger('tax_inclusive')->nullable(); //1=yes; 0=no
            $table->dateTime('issue_date');
            $table->dateTime('due_date');
            $table->double('total');
            $table->double('sub_total');
            $table->double('tax_rate')->nullable();
            $table->double('discount_rate')->nullable();
            $table->double('tax_value')->default(0)->nullable();
            $table->double('discount_value')->default(0)->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('receipts');
    }
}
