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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->integer('tenaga_medis');
            $table->integer('persentase_ketersediaan_obat_dan_alkes');
            $table->integer('indeks_kebersihan');
            $table->integer('rata_rata_biaya');
            $table->string('akreditasi');
            $table->text('other_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
