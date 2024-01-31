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
        Schema::create('hutangs', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('owner_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('pembelian_id')->constrained()->cascadeOnDelete();
            $table->string('nomor');
            $table->date('tanggal');
            $table->integer('retur')->nullable();
            $table->integer('bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hutangs');
    }
};
