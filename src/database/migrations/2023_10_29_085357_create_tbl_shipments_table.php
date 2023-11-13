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
        Schema::create('tbl_shipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('OrderId');
            $table->string('TrackingNumber', 70);
            $table->string('Carrier', 70); 
            $table->unsignedInteger('ShipmentStatusId'); 
           
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
        Schema::dropIfExists('tbl_shipments');
    }
};
