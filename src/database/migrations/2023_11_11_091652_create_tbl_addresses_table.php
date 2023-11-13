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
        Schema::create('tbl_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('EnrollmentID');
            $table->string('ServiceAddress1', 50)->nullable();
            $table->string('ServiceAddress2', 50)->nullable();
            $table->integer('CityID');
            $table->integer('StateID');
            $table->integer('CountryID');
            $table->string('MailServiceAddress1', 50)->nullable();
            $table->string('MailServiceAddress2', 50)->nullable();
            $table->integer('MailCityID');
            $table->integer('MailStateID');
            $table->integer('MailCountryID');
            $table->enum('isMailAddrSame', ['Yes','No'])->default('No');
            $table->foreign('CityID')
            ->references('id') // role id
            ->on('tbl_cities')
            ->onDelete('cascade');
            $table->foreign('StateID')
            ->references('id') // role id
            ->on('tbl_states')
            ->onDelete('cascade');
            $table->foreign('ZipID')
            ->references('id') // role id
            ->on('tbl_zip_codes')
            ->onDelete('cascade');
            $table->foreign('CountryID')
            ->references('id') // role id
            ->on('tbl_countries')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_addresses');
    }
};
