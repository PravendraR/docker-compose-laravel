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
        Schema::create('tbl_plan_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('PlanId');
            $table->decimal('EmergencyBroadbandBenefitFee', 10, 2);
            $table->string('AllowedService', 100); 
            $table->integer('MaxInvoicesAllowed');
            $table->decimal('WCCTAmount', 10,2);
            $table->decimal('WCCTAdditionalAmount', 10, 2); 
            $table->decimal('MonthlyPaymentAmount', 10, 2); 
            $table->decimal('CreditLimit', 10, 2); 
            $table->boolean('AutoPayEnabled')->default(0);
            $table->boolean('IsPrepaid')->default(0);
            $table->boolean('HasLifeline')->default(0);
            $table->boolean('IsTribal')->default(0);
            $table->boolean('IsDataPlan')->default(0);
            $table->decimal('BilledAmount', 10, 2); 
            $table->boolean('IncludesFreePhone')->default(0);
            $table->boolean('IsBasePlan')->default(0);
            $table->boolean('IsOldPlan')->default(0);
            $table->decimal('MinutesDeduction', 10, 2); 
            $table->decimal('DataDeduction', 10, 2); 
            $table->decimal('UpgradeMinutsDeduction', 10, 2); 
            $table->decimal('UpgradeDataDeduction', 10, 2); 
            $table->integer('UpperPlanId'); 
            $table->boolean('IsLTE')->default(0); 
            $table->string('ServiceType', 50); 
            $table->string('CAServiceType', 50);  
            $table->string('EBBServiceType', 50);  
            $table->integer('PortGroup');  
            $table->smallInteger('GracePeriodDays');  
            $table->smallInteger('PlanToMigrateOnExpiry');  
            $table->string('ExpirationType', 20); 
            $table->smallInteger('ExpirationDays');  
            $table->string('PrepaidAccountStatusDuringGrace', 50);  
            $table->string('PrepaidAccountStatusDuringExpiry', 50);  
            $table->boolean('ActivationFeeDiscountAvailable');
            $table->string('LifelineRateGroup', 250);  
            $table->string('CarrierPlanCode', 100);  
            $table->string('CarrierPlanCodeLTE', 64);  
            $table->boolean('ChangeableCarrierPlanCode')->default(0);
            $table->string('CarrrierPackageId', 50); 
            $table->decimal('AutoPayFee', 10, 2); 
            $table->boolean('IsBYODCompatible')->default(0);
            $table->boolean('EnrollmentStatusId');
            $table->boolean('IsFamilyPlan')->default(0);
            $table->string('FamilyPlanConfig', 50); 
            $table->boolean('IsProratedPlan')->default(0);
            $table->string('ProratedPlanConfig', 50); 
            $table->tinyInteger('AdvanceBillingMonths');
            $table->tinyInteger('DowngradeToPlanID');
            $table->tinyInteger('PromotionalOfferValidityDays');
            $table->string('PostpaidConfig', 50); 
            $table->boolean('TaxConfigurationAvailable')->default(0);
            $table->string('TaxConfigDetails', 50); 
            $table->boolean('IsUnlimitedPlan')->default(0);
            $table->string('UnlimitedPlanConfigDetails', 50); 
            $table->integer('AllowedTopUpOptionID');
            $table->decimal('AdvancePurchaseDiscount', 10, 2); 
            $table->string('OfferType', 50); 
            $table->boolean('CustomerNotificationRequired')->default(0);
            $table->string('NextPlanCode', 50); 
            $table->integer('ChangePlanAfterDays');
            $table->boolean('AutoPayDiscountAvailable')->default(0);
            $table->string('AutoPayOptionDetails', 50); 
            $table->integer('AutoPayBillingMonth');
            $table->string('LifelineServiceStatus', 50); 
            $table->dateTime('CreatedDateTime');
            $table->integer('CreatedBy');
            $table->dateTime('UpdatedDate');
            $table->integer('UpdatedBy');
            $table->foreign('PlanId')->references('id')->on('tbl_plans');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_plan_details');
    }
};
