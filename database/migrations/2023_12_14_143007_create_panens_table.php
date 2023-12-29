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
        Schema::create('panens', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('owner_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('kolam_id')->constrained()->cascadeOnDelete();
            // $table->bigInteger('satuan_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('supplier_id')->constrained()->cascadeOnDelete();
            $table->string('grade');
            $table->string('size');
            $table->string('jenis_panen');
            $table->string('harga');
            $table->string('volume');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panens');
    }
};
