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
        Schema::create('tbl_company', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('CompanyId', 20);
            $table->string('CompanyName', 30);
            $table->string('CompanyDesc', 100);
            $table->enum('IsActive',['Active','Deactive','Deleted','Inactive','ActPending','Pending'])->default('ActPending');
            $table->timestamps();
            $table->integer('CreatedBy');
            $table->integer('UpdatedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_company');
    }
};
