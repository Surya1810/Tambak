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
        Schema::create('piutangs', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('tambak_id')->constrained()->cascadeOnDelete()->nullable();
            $table->bigInteger('customer_id')->constrained()->cascadeOnDelete()->nullable();
            $table->bigInteger('akun_id')->constrained()->cascadeOnDelete()->nullable();
            $table->string('nomor');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->integer('retur')->nullable();
            $table->integer('bayar')->nullable();
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piutangs');
    }
};
