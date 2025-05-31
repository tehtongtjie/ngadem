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
        Schema::create('teknisi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign Key ke users
            $table->string('area_layanan')->nullable();
            $table->string('spesialisasi')->nullable();
            $table->decimal('rating', 2, 1)->default(0.0);
            $table->integer('jumlah_ulasan')->default(0);
            $table->text('deskripsi_singkat')->nullable();
            $table->string('foto_profil')->nullable();
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teknisi_details');
    }
};