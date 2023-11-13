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
        Schema::create('tbl_uoms', function (Blueprint $table) {
            $table->increments('id'); // auto incrimented int unsigned
            $table->String('code',50)->nullable();
            $table->String('Description',250)->nullable();
            $table->tinyInteger('BaseQty')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_uoms');
    }
};
