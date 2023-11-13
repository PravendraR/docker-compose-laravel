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
        Schema::create('tbl_cities', function (Blueprint $table) {
            $table->id();
            $table->string('CityName',50);
            $table->string('CityCode',5);
            $table->unsignedBigInteger('StateID');
            $table->foreign('StateID')
            ->references('id') // city id
            ->on('tbl_states')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cities');
    }
};
