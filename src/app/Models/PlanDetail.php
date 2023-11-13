<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class PlanDetail extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const CREATED_AT = 'CreatedDate';
    const UPDATED_AT = 'UpdatedDate';
    
    protected $table = 'tbl_plan_details';
    protected $fillable = [
        'id',
        'PlanId',
        'EmergencyBroadbandBenefitFee',
        'AllowedService',
        'MaxInvoicesAllowed',
        'WCCTAmount',
        'WCCTAdditionalAmount',
        'MonthlyPaymentAmount',
        'CreditLimit',
        'AutoPayEnabled',
        'IsPrepaid',
        'HasLifeline',
        'IsTribal',
        'IsDataPlan',
        'BilledAmount',
        'IncludesFreePhone',
        'IsBasePlan',
        'IsOldPlan',
        'MinutesDeduction',
        'DataDeduction',
        'UpgradeMinutsDeduction',
        'UpgradeDataDeduction',
        'UpperPlanId',
        'IsLTE',
        'ServiceType',
        'CAServiceType',
        'EBBServiceType',
        'PortGroup',
        'GracePeriodDays',
        'PlanToMigrateOnExpiry',
        'ExpirationType',
        'ExpirationDays',
        'PrepaidAccountStatusDuringGrace',
        'PrepaidAccountStatusDuringExpiry',
        'ActivationFeeDiscountAvailable',
        'LifelineRateGroup',
        'CarrierPlanCode',
        'CarrierPlanCodeLTE',
        'ChangeableCarrierPlanCode',
        'CarrrierPackageId',
        'AutoPayFee',
        'IsBYODCompatible',
        'EnrollmentStatusId',
        'IsFamilyPlan',
        'FamilyPlanConfig',
        'IsProratedPlan',
        'ProratedPlanConfig',
        'AdvanceBillingMonths',
        'DowngradeToPlanID',
        'PromotionalOfferValidityDays',
        'PostpaidConfig',
        'TaxConfigurationAvailable',
        'TaxConfigDetails',
        'IsUnlimitedPlan',
        'UnlimitedPlanConfigDetails',
        'AllowedTopUpOptionID',
        'AdvancePurchaseDiscount',
        'OfferType',
        'CustomerNotificationRequired',
        'NextPlanCode',
        'ChangePlanAfterDays',
        'AutoPayDiscountAvailable',
        'AutoPayOptionDetails',
        'AutoPayBillingMonth',
        'LifelineServiceStatus',
        'CreatedDate',
        'CreatedBy',
        'UpdatedDate',
        'UpdatedBy',
    ];
}
