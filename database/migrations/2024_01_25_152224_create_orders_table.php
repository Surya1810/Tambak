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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('tambak_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('supplier_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('barang_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('input_by')->constrained()->cascadeOnDelete();
            $table->string('nomor');
            $table->date('tanggal');
            $table->string('keterangan');
            $table->string('harga');
            $table->string('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
