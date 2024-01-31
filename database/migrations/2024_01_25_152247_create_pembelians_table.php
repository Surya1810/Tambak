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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('owner_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('input_by')->constrained()->cascadeOnDelete();
            $table->bigInteger('order_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('akun_id')->constrained()->cascadeOnDelete();
            $table->string('nomor');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
