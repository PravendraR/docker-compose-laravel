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
        Schema::create('tbl_sim_types', function (Blueprint $table) {
            $table->increments('id'); // auto incrimented int unsigned
            $table->String('code',50);
            $table->String('Description',250)->nullable();
            $table->boolean('IsActive');
            $table->boolean('IsDeleted');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sim_types');
    }
};
