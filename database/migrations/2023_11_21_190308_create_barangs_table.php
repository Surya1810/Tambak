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
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('tambak_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('supplier_id')->constrained()->cascadeOnDelete()->nullable();
            $table->bigInteger('kategori_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('satuan_id')->constrained()->cascadeOnDelete();
            $table->string('code');
            $table->string('name');
            $table->string('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
