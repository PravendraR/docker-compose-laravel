<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('CustomerId');
            $table->decimal('TotalAmount', 10, 2);
            $table->unsignedInteger('PaymentStatusId'); 
            $table->unsignedInteger('OrderStatusId'); 
            $table->dateTime('CreatedDate');
            $table->unsignedInteger('CreatedBy');
            $table->dateTime('UpdateDate')->nullable();
            $table->unsignedInteger('UpdatedBy')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_orders');
    }
};
