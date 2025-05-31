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
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Pengguna yang memesan
            $table->foreignId('teknisi_id')->nullable()->constrained('users')->onDelete('set null'); // Teknisi yang ditugaskan (nullable)
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->dateTime('tanggal_pesanan')->useCurrent();
            $table->date('tanggal_service_diharapkan');
            $table->time('jam_service_diharapkan');
            $table->text('alamat_service');
            $table->text('deskripsi_masalah')->nullable();
            $table->enum('status_order', ['pending', 'diterima', 'dalam_proses', 'selesai', 'dibatalkan'])->default('pending');
            $table->decimal('total_harga', 10, 2)->default(0.00);
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