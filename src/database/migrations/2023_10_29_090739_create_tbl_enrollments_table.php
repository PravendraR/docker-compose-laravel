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
        Schema::create('tbl_enrollments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('IsConsented');
            $table->string('ConsentorPhoneNumber', 20);
            $table->boolean('IsNladPortFreeze');
            $table->boolean('IsTpivDeceased');
            $table->string('TaxId', 30); 
            $table->string('AlternateContactName', 30); 
            $table->tinyInteger('NladNv'); 
            $table->string('NvEligibilityCheckStatus', 50); 
            $table->string('NladNvCronRunCount'); 
            $table->string('NladTribalStatus', 50); 
            $table->string('TransferExceptionCode', 5);  
            $table->boolean('IsAcpQualified');
            $table->dateTime('AcpQualifyDate');
            $table->string('AcpConsentSource', 100); 
            $table->string('InitialChosenEnrollType', 50); 
            $table->string('EnrollmentType', 50); 
            $table->boolean('IsAcpDuplicate');
            $table->unsignedInteger('SimId');
            $table->unsignedInteger('PlanId');
            $table->tinyInteger('EnrollmentstatusId');
            $table->dateTime('ActivationDate');
            $table->boolean('IsActive');
            $table->boolean('IsDeleted');
            $table->dateTime('CreatedDate');
            $table->unsignedInteger('CreatedBy');
            $table->dateTime('UpdateDate')->nullable();
            $table->unsignedInteger('UpdatedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_enrollments');
    }
};
