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
        Schema::create('tbl_beneficiaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('EnrollmentID');
            $table->string('FirstName', 30);
            $table->string('MiddleName', 20);
            $table->string('LastName', 30);
            $table->string('Suffix', 10);
            $table->date('DOB');
            $table->string('SSN', 15)->nullable();
            $table->string('Email', 30);
            $table->string('TribalID', 15)->nullable();
            $table->string('AlternateID', 20)->nullable();
            $table->string('DrivingLicenceId', 30)->nullable();
            $table->string('MilitaryId', 20)->nullable();
            $table->string('PassportId', 20)->nullable();
            $table->string('TaxpayerCode', 20)->nullable();
            $table->string('OtherGovernmentId', 30)->nullable();
            $table->enum('isActive',['Yes','No'])->default('Yes');
            $table->enum('isDeleted',['Yes','No'])->default('No');
            $table->dateTime('CreatedDate');
            $table->integer('CreatedBy');
            $table->dateTime('UpdatedDate');
            $table->integer('UpdatedBy');
            $table->foreign('EnrollmentID')
            ->references('id') // enrollment id
            ->on('tbl_enrollments')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_beneficiaries');
    }
};
