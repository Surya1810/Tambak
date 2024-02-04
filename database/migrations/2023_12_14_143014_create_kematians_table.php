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
        Schema::create('kematians', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('tambak_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('kolam_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->string('umur');
            $table->string('total');
            $table->string('size');
            $table->string('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kematians');
    }
};
