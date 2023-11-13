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
            $table->id();
            $table->String('FirstName',30);
            $table->String('LastName',50);
            $table->date('Birthdate')->nullable();
            $table->String('SsnNo',15)->nullable();
            $table->unsignedInteger('TribalId')->nullable();
            $table->String('DriversLicenseId',100)->nullable();
            $table->String('MilitaryId',50)->nullable();
            $table->String('PassportNo',50)->nullable();
            $table->String('TaxPayerCode',100)->nullable();
            $table->String('OtherGovernmentId',100)->nullable();
            $table->String('SuffixName',50)->nullable();
            $table->dateTime('CreatedDate');
            $table->unsignedInteger('CreatedBy');
            $table->dateTime('UpdateDate')->nullable();
            $table->unsignedInteger('UpdatedBy')->nullable();
            $table->boolean('IsActive');
            $table->boolean('IsDeleted');
            $table->unsignedInteger('CustomerId');
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
