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
        Schema::create('tbl_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserId',20);
            $table->unsignedBigInteger('EnrollmentId',20);
            $table->String('FirstName',30);
            $table->String('LastName',30);
            $table->String('Username',50);
            $table->String('EmailAddress',100)->nullable();
            $table->date('Birthdate')->nullable();
            $table->String('SsnNo',15)->nullable();
            $table->String('TribalId',50)->nullable();
            $table->String('DriversLicenseId',50)->nullable();
            $table->String('MilitaryId',50)->nullable();
            $table->String('PassportNo',50)->nullable();
            $table->String('TaxPayerCode',100)->nullable();
            $table->String('OtherGovernmentId',100)->nullable();
            $table->String('ServiceAddress1',150)->nullable();
            $table->String('ServiceAddress2',150)->nullable();
            $table->String('ServiceAddressUnit1',40)->nullable();
            $table->String('ServiceAddressUnit2',20)->nullable();
            $table->String('City',50)->nullable();
            $table->String('State',50)->nullable();
            $table->String('PostalCode',10)->nullable();
            $table->boolean('IsTemporaryAddress');
            $table->unsignedBigInteger('PlanId',20);
            $table->String('SuffixName',50)->nullable();
            $table->boolean('CanSendSsn');
            $table->boolean('IsMigrated');
            $table->dateTime('CreatedDate');
            $table->unsignedInteger('CreatedBy');
            $table->dateTime('UpdatedDate');
            $table->unsignedInteger('UpdatedBy');
            $table->boolean('IsActive');
            $table->boolean('IsDeleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_customers');
    }
};
