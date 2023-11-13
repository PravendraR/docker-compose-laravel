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
        Schema::create('tbl_zip_codes', function (Blueprint $table) {
            $table->id();
            $table->string('ZipCode',30);
            $table->unsignedBigInteger('CityID');
            $table->foreign('CityID')
            ->references('id') // state id
            ->on('tbl_cities')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_zip_codes');
    }
};
