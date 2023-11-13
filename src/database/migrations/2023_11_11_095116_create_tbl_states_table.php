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
        Schema::create('tbl_states', function (Blueprint $table) {
            $table->id();
            $table->string('StateName',30);
            $table->string('StateCode',30);
            $table->unsignedBigInteger('CountryID');
            $table->foreign('CountryID')
            ->references('id') // state id
            ->on('tbl_countries')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_states');
    }
};
