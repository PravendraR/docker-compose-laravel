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
        Schema::create('tbl_user_status', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('StatusCode', 20);
            $table->string('Status', 15);
            $table->enum('isActive',['Yes','No']);
            $table->timestamps();
            $table->integer('createdBy');
            $table->integer('updatedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user_status');
    }
};
