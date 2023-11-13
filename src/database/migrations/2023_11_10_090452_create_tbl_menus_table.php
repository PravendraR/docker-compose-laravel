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
        Schema::create('tbl_menus', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('parentId')->nullable();
            $table->string('Descripton', 50);
            $table->string('urlRoute', 50)->nullable();
            $table->string('params', 100)->nullable();
            $table->enum('isActive',['Yes','No'])->default('Yes');
            $table->string('navIconClass', 50)->nullable();
            $table->enum('hideMenu',[0,1,2])->default(0);
            $table->unsignedSmallInteger('sortOrder')->default(0);
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
        Schema::dropIfExists('tbl_menus');
    }
};
