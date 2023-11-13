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
        Schema::create('tbl_sims', function (Blueprint $table) {
            $table->increments('id'); // auto incrimented int unsigned
            $table->String('code',50);
            $table->integer('Number');
            $table->boolean('IsActive');
            $table->boolean('IsDeleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sims');
    }
};
