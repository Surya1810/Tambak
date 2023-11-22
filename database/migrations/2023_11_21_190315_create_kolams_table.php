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
        Schema::create('kolams', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('tambak_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('panjang');
            $table->string('lebar');
            $table->string('luas');
            $table->string('kedalaman');
            $table->string('anco');
            $table->string('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kolams');
    }
};
