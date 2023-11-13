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
        Schema::create('tbl_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->String('Name',100);
            $table->String('code',5);
            $table->String('Description',250)->nullable;
            $table->unsignedInteger('PlanTypeId');
            $table->decimal('Price',8,2);
            $table->boolean('IsActive');
            $table->boolean('IsDeleted');
            $table->dateTime('CreatedDate');
            $table->unsignedInteger('CreatedBy');
            $table->dateTime('UpdatedDate');
            $table->unsignedInteger('UpdatedBy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_plans');
    }
};
