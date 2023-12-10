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
        Schema::create('bibits', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('kolam_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('supplier_id')->constrained()->cascadeOnDelete()->nullable();
            $table->bigInteger('total');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bibits');
    }
};
