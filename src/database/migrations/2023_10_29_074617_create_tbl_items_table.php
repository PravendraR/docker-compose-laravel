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
        Schema::create('tbl_items', function (Blueprint $table) {
            $table->id();
            $table->String('Name',100);
            $table->String('Description',450)->nullable();
            $table->float('Price',8,2)->nullable();
            $table->unsignedInteger('UomId')->nullable();
            $table->dateTime('CreatedDate');
            $table->unsignedInteger('CreatedBy');
            $table->dateTime('UpdateDate')->nullable();
            $table->unsignedInteger('UpdatedBy')->nullable();
            $table->boolean('IsActive');
            $table->boolean('IsDeleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_items');
    }
};
