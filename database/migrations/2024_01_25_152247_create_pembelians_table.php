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
            $table->bigInteger('input_by')->constrained()->cascadeOnDelete()->nullable();
            $table->string('nomor');
            $table->date('tanggal');
            $table->bigInteger('supplier_id')->constrained()->cascadeOnDelete()->nullable();
            $table->bigInteger('akun_id')->constrained()->cascadeOnDelete()->nullable();
            $table->bigInteger('po_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('keterangan');
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
