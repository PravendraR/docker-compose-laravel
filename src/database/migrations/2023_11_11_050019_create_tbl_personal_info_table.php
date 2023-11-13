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
        Schema::create('tbl_personal_info', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('EnrollmentID');
            $table->string('FirstName', 30);
            $table->string('MiddleName', 20);
            $table->string('LastName', 30);
            $table->string('Suffix', 10);
            $table->date('DOB');
            $table->string('SSN', 15)->nullable();
            $table->string('Email', 30);
            $table->string('PrimaryPhone', 15)->nullable();
            $table->string('SecondaryPhone', 15)->nullable();
            $table->string('DrivingLicenceId', 30)->nullable();
            $table->string('MilitaryId', 20)->nullable();
            $table->string('PassportId', 20)->nullable();
            $table->string('TaxpayerId', 20)->nullable();
            $table->string('OtherGovernmentId', 30)->nullable();
            $table->string('SSNType', 50)->nullable();
            $table->dateTime('CreatedDate');
            $table->integer('CreatedBy');
            $table->dateTime('UpdatedDate');
            $table->integer('UpdatedBy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_personal_info');
    }
};
