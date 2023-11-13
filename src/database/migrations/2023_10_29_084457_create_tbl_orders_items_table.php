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
        Schema::create('tbl_orders_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('OrderId');
            $table->bigInteger('ItemId');
            $table->unsignedInteger('Quantity'); 
            $table->decimal('UnitPrice'); 
            $table->decimal('TotalPrice'); 
            $table->boolean('IsActive');
            $table->boolean('IsDeleted');
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
        Schema::dropIfExists('tbl_orders_items');
    }
};
